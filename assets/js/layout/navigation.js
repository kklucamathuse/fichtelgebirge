const navigationSubNav = function() {
    const subNavTogglers = document.querySelectorAll('#header-main-nav-container #header-main-nav ul.menu li.children .sub-nav-toggler');

    subNavTogglers.forEach(subNavToggler => {
        const subNavItem = subNavToggler.nextElementSibling;

        console.log(subNavToggler.parentElement)

        subNavToggler.addEventListener('click', function() {
            this.parentElement.classList.toggle('open');
            this.classList.toggle('open');
        });
    });
}

export { navigationSubNav };