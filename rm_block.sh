#!/bin/bash

# Colors for output
RED='\033[0;31m'
YELLOW='\033[1;33m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

# Get all block files
blocks_dir="./blocks/"
block_files=($(ls -1 ${blocks_dir}*.php 2>/dev/null | sort))

if [ ${#block_files[@]} -eq 0 ]; then
  echo -e "${RED}No blocks found in ${blocks_dir}${NC}"
  exit 1
fi

# Display numbered list of blocks
echo ""
echo "Available blocks:"
echo "=================="
for i in "${!block_files[@]}"; do
  filename=$(basename "${block_files[$i]}" .php)
  printf "%2d) %s\n" $((i+1)) "$filename"
done
echo ""

# Prompt for selection
read -p "Enter block number to remove (or 'q' to quit): " selection

# Exit if quit
if [ "$selection" = "q" ] || [ "$selection" = "Q" ]; then
  echo "Cancelled."
  exit 0
fi

# Validate selection
if ! [[ "$selection" =~ ^[0-9]+$ ]] || [ "$selection" -lt 1 ] || [ "$selection" -gt ${#block_files[@]} ]; then
  echo -e "${RED}Invalid selection.${NC}"
  exit 1
fi

# Get selected block
selected_file="${block_files[$((selection-1))]}"
block_slug=$(basename "$selected_file" .php)
block_kebab=$(echo "$block_slug" | tr '_' '-')
block_name=$(echo "$block_slug" | sed 's/_/ /g' | awk '{for(i=1;i<=NF;i++) $i=toupper(substr($i,1,1)) tolower(substr($i,2));}1')

echo ""
echo -e "${YELLOW}Selected block: ${block_slug}${NC}"
echo ""

# Final confirmation
read -p "Are you sure you want to remove this block? [yN] " confirm

# Check confirmation
if [ "$confirm" != "y" ] && [ "$confirm" != "Y" ]; then
  echo "Cancelled."
  exit 0
fi

echo ""
echo "Removing block..."

# Define file paths
php_file="./blocks/${block_slug}.php"
scss_file="./src/sass/theme/blocks/_${block_slug}.scss"
blocks_scss="./src/sass/theme/blocks/_blocks.scss"
blocks_php="./inc/lc-blocks.php"

removed_count=0
not_found=()

# Remove PHP template
if [ -f "$php_file" ]; then
  rm "$php_file"
  echo "  ✓ Removed: $php_file"
  removed_count=$((removed_count+1))
else
  not_found+=("PHP template")
fi

# Remove SCSS file
if [ -f "$scss_file" ]; then
  rm "$scss_file"
  echo "  ✓ Removed: $scss_file"
  removed_count=$((removed_count+1))
else
  not_found+=("SCSS file")
fi

# Remove import from _blocks.scss
if [ -f "$blocks_scss" ] && grep -q "@import '${block_slug}';" "$blocks_scss"; then
  temp_file=$(mktemp)
  grep -v "@import '${block_slug}';" "$blocks_scss" > "$temp_file"
  mv "$temp_file" "$blocks_scss"
  chmod 664 "$blocks_scss"
  chgrp www-data "$blocks_scss" 2>/dev/null || true
  echo "  ✓ Removed import from: $blocks_scss"
  removed_count=$((removed_count+1))
else
  not_found+=("SCSS import")
fi

# Remove block registration from lc-blocks.php
if [ -f "$blocks_php" ]; then
  temp_file=$(mktemp)
  
  # Use sed to remove the block registration section
  # First find the line number where this block starts
  start_line=$(grep -n "'name'[[:space:]]*=>[[:space:]]*'${block_slug}'" "$blocks_php" | cut -d: -f1)
  
  if [ -n "$start_line" ]; then
    # Find the opening line (search backwards for acf_register_block_type)
    opening_line=$(awk -v target="$start_line" '
      /acf_register_block_type\(/ { opener = NR }
      NR == target && opener > 0 { print opener; exit }
    ' "$blocks_php")
    
    # Find the closing line (search forwards for the closing );)
    closing_line=$(awk -v start="$start_line" '
      NR >= start && /\);/ { print NR; exit }
    ' "$blocks_php")
    
    if [ -n "$opening_line" ] && [ -n "$closing_line" ]; then
      # Remove the block registration and up to 2 following blank lines
      awk -v start="$opening_line" -v end="$closing_line" '
        NR < start || NR > end {
          if (NR == end + 1 || NR == end + 2) {
            if (/^[[:space:]]*$/) next
          }
          print
        }
      ' "$blocks_php" > "$temp_file"
      
      mv "$temp_file" "$blocks_php"
      chmod 664 "$blocks_php"
      chgrp www-data "$blocks_php" 2>/dev/null || true
      echo "  ✓ Removed registration from: $blocks_php"
      removed_count=$((removed_count+1))
    else
      rm "$temp_file"
      not_found+=("Block registration (parse error)")
    fi
  else
    rm "$temp_file"
    not_found+=("Block registration")
  fi
else
  not_found+=("lc-blocks.php")
fi

# Find and remove ACF JSON file
# First try the standard naming convention
acf_json_file="./acf-json/group_${block_slug}.json"
acf_found=false

if [ -f "$acf_json_file" ]; then
  rm "$acf_json_file"
  echo "  ✓ Removed: $acf_json_file"
  removed_count=$((removed_count+1))
  acf_found=true
else
  # Search for ACF JSON file by checking location field in all JSON files
  for json_file in ./acf-json/group_*.json; do
    if [ -f "$json_file" ]; then
      # Check if this JSON file has a location matching our block
      if grep -q "\"value\".*:.*\"acf\\\\/${block_kebab}\"" "$json_file" || \
         grep -q "\"value\".*:.*\"acf/${block_kebab}\"" "$json_file"; then
        rm "$json_file"
        echo "  ✓ Removed: $json_file"
        removed_count=$((removed_count+1))
        acf_found=true
        break
      fi
    fi
  done
fi

if [ "$acf_found" = false ]; then
  not_found+=("ACF JSON")
fi

echo ""
if [ $removed_count -gt 0 ]; then
  echo -e "${GREEN}Block '${block_slug}' removed successfully! (${removed_count} files/references removed)${NC}"
  
  # Show what wasn't found, if anything
  if [ ${#not_found[@]} -gt 0 ]; then
    echo ""
    echo -e "${YELLOW}Not found (may not have existed):${NC}"
    for item in "${not_found[@]}"; do
      echo "  - $item"
    done
  fi
  
  echo ""
  echo "Remember to:"
  echo "  1. Sync ACF fields in WordPress admin (if needed)"
  echo "  2. Rebuild CSS if watch is not running"
else
  echo -e "${YELLOW}No files found to remove.${NC}"
  if [ ${#not_found[@]} -gt 0 ]; then
    echo ""
    echo "Missing components:"
    for item in "${not_found[@]}"; do
      echo "  - $item"
    done
  fi
fi
