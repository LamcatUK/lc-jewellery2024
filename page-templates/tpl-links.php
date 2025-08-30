<?php
/**
 *  Template Name: Links
 *
 *  @package lc-jewellery2024
 */

defined( 'ABSPATH' ) || exit;

get_header( 'nonav' );

?>
<style>
.links-page {
  min-height: 100svh;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
  background-color: var(--col-grey-200);
}

.links-image {
	  width: min( 310px, 95vw);
}

.links {
  width: 100%;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.btn {
  width: min( 400px, 95vw);
  margin-bottom: 1rem;
  margin-inline: auto;
  padding-block: 1rem;
  background-color: white;
}

.footer {
	width: 100%;
}
</style>
<div class="links-page d-flex flex-column align-items-center pt-4">
	<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/logo-full.svg' ); ?>" alt="" width="310" height="50" class="links-image">
	<div class="links py-5">
		<?php
		while ( have_rows( 'links' ) ) {
			the_row();
			$page_link = get_sub_field( 'link' );
			?>
			<a href="<?= esc_url( $page_link['url'] ); ?>" target="<?= esc_attr( $page_link['target'] ); ?>" class="btn btn-primary"><?= esc_html( $page_link['title'] ); ?></a>
			<?php
		}
		?>
	</div>
	<?php
	get_footer( 'nonav' );
	?>
</div>

