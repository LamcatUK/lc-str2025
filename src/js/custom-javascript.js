// Add your custom JS here.
AOS.init({
  duration: 800,
  once: true,
  easing: "ease-in",
});
/*
document.addEventListener('DOMContentLoaded', function() {

    const topNav = document.querySelector('header');
    // Top Navigation Scroll Behaviour
    let lastScrollTop = 0;
    window.addEventListener('scroll', () => {
        const currentScrollTop = window.scrollY || document.documentElement.scrollTop;

        if (currentScrollTop > lastScrollTop) {
            topNav.classList.add('hidden');
        } else {
            topNav.classList.remove('hidden');
        }

        lastScrollTop = Math.max(currentScrollTop, 0); // Prevent negative scroll
    });
    
});
*/
