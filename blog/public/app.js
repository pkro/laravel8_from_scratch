(function () {
    "use strict";
    return;
    const mainContent = document.querySelector('.mainContent');
    mainContent.classList.add('slideIn');
    // make main content slide out when clicking a link of navLink class
    const navLinks = document.querySelectorAll('.navLink');
    navLinks.forEach(navLink => navLink.addEventListener('click', event => {
        event.preventDefault();
        mainContent.classList.add('slideOut');
        mainContent.addEventListener('transitionend', () => {
            mainContent.classList.remove('slideOut');
            window.location.href = navLink.href;
        });

    }));
})();
