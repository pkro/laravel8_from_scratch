(function () {
    "use strict";
    // make whole post clickable
    document.querySelectorAll('[data-link]').forEach(linkElement => {
        linkElement.addEventListener('click', el => {
            const tag = el.target.tagName.toLowerCase();
            // I still want the individual buttons for category etc. inside to work independently
            if(['a', 'button'].indexOf(tag) === -1)  {
                window.location.href = el.currentTarget.dataset.link
            }
        });
    });
    /*const mainContent = document.querySelector('.mainContent');
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

    }));*/
})();
