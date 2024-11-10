// Add your custom JS here.

/* Function to add styles after page load */
// outputting empty <style> tags at the moment...
// jQuery(function($){
//     var navListItems = document.querySelectorAll('ul.nav-list li');
// console.log('here'+navListItems);
//     navListItems.forEach((item, index) => {
//         var style = document.createElement('style');
//         document.head.appendChild(style);
//         style.sheet.insertRule(`ul.nav-list li:nth-child(${index + 1}) { view-transition-name: navLink-${index + 1}; }`, 0);
//     });
// },9999
// );


AOS.init({
    duration: 800,
    once: true,
    easing: 'ease-in',
});

const lightbox = GLightbox();

document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-link');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    const navbar = document.getElementById('navholder');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (navbarCollapse.classList.contains('show')) {
                // Check if the menu is open and close it
                navbarCollapse.classList.remove('show');
                navbar.classList.add('hidden');
            }
        });
    });
  
    // hide beyond height of navbar (--h-top)
    let lastScrollPosition = 0;
    // const navbar = document.getElementById('wrapper-navbar');
    // const navbarHeight = navbar.clientHeight; // Get the height of the navbar
    const navbarHeight = 0; // Get the height of the navbar
    
    window.addEventListener('scroll', function() {
        const currentScroll = window.scrollY || document.documentElement.scrollTop;
    
        if (currentScroll > navbarHeight) {
            if (currentScroll > lastScrollPosition) {
                // Down scroll
                navbar.classList.add('hidden');
            } else {
                // Up scroll
                navbar.classList.remove('hidden');
            }
        }
    
        lastScrollPosition = currentScroll <= 0 ? 0 : currentScroll;
    });
  
});

document.getElementById('backToTop').addEventListener('click', function(e) {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

document.addEventListener("DOMContentLoaded", function() {
    const dropdowns = document.querySelectorAll('#offcanvasNavbar .dropdown');
    let isMobile = window.innerWidth < 992;

    function toggleAccordionBehaviour(enableAccordion) {
        dropdowns.forEach(dropdown => {
            const toggle = dropdown.querySelector('.dropdown-toggle');
            const menu = dropdown.querySelector('.dropdown-menu');

            if (enableAccordion) {
                // Remove Bootstrap's dropdown toggle behaviour for mobile accordion
                toggle.removeAttribute('data-bs-toggle');

                // Apply accordion behaviour
                toggle.addEventListener('click', function accordionClick(e) {
                    e.preventDefault();

                    // Close any open dropdowns
                    dropdowns.forEach(d => {
                        const openMenu = d.querySelector('.dropdown-menu');
                        if (d !== dropdown) {
                            d.classList.remove('show');
                            openMenu.classList.remove('show');
                            openMenu.style.maxHeight = null;
                            openMenu.style.visibility = 'hidden';
                        }
                    });

                    // Toggle the clicked dropdown with smooth accordion effect
                    dropdown.classList.toggle('show');
                    menu.classList.toggle('show');

                    if (menu.classList.contains('show')) {
                        menu.style.maxHeight = menu.scrollHeight + "px";
                        menu.style.visibility = 'visible';
                    } else {
                        menu.style.maxHeight = null;
                        menu.style.visibility = 'hidden';
                    }
                });
            } else {
                // Re-enable Bootstrap's dropdown toggle behaviour for desktop
                toggle.setAttribute('data-bs-toggle', 'dropdown');

                // Remove custom accordion event listeners
                toggle.replaceWith(toggle.cloneNode(true)); // Reset the toggle by cloning
            }
        });
    }

    // Initial setup based on viewport
    toggleAccordionBehaviour(isMobile);

    // Listen for window resize to switch behaviours dynamically
    window.addEventListener('resize', function() {
        const currentlyMobile = window.innerWidth < 992;

        if (currentlyMobile !== isMobile) {
            isMobile = currentlyMobile;
            toggleAccordionBehaviour(isMobile);
        }
    });
});

// jQuery(function($){
//     var btn = $('#to-top');

//     $(window).scroll(function () {
//       if ($(window).scrollTop() > 300) {
//         btn.addClass('show');
//       } else {
//         btn.removeClass('show');
//       }
//     });

//     btn.on('click', function (e) {
//       e.preventDefault();
//       $('html, body').animate({ scrollTop: 0 }, '300');
//     });
// },9999);

