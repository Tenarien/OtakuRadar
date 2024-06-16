import './bootstrap';



var toggleOpen = document.getElementById('toggleOpen');
var toggleClose = document.getElementById('toggleClose');
var collapseMenu = document.getElementById('collapseMenu');
var mobileSearchButton = document.getElementById('mobileSearchButton');
var mobileSearchBar = document.getElementById('mobileSearchBar');
var main = document.getElementById('main');
var logo = document.getElementById('logo');

function handleClick() {
    var isMenuVisible = collapseMenu.style.display === 'block';
    collapseMenu.style.display = isMenuVisible ? 'none' : 'block';
    if (isMenuVisible) {
        main.classList.remove('blur-lg');
        logo.classList.remove('blur-lg');
    } else {
        main.classList.add('blur-lg');
        logo.classList.add('blur-lg');
    }
}

toggleOpen.addEventListener('click', function (event) {
    event.stopPropagation();
    handleClick();
});
toggleClose.addEventListener('click', function (event) {
    event.stopPropagation();
    handleClick();
});

document.addEventListener('click', function (event) {
    var target = event.target;
    if (collapseMenu.style.display === 'block' &&
        !collapseMenu.contains(target) &&
        target !== toggleOpen &&
        target !== toggleClose) {
        collapseMenu.style.display = 'none';
        main.classList.remove('blur-lg');
        logo.classList.remove('blur-lg');
    }
});

window.addEventListener('resize', function () {
    if (window.innerWidth >= 1024) {
        collapseMenu.style.display = 'none';
    }
});

document.addEventListener('DOMContentLoaded', function () {
    mobileSearchButton.addEventListener('click', function (event) {
        event.stopPropagation();
        mobileSearchBar.classList.toggle('hidden');
    });

    document.addEventListener('click', function (event) {
        var target = event.target;
        if (!mobileSearchBar.contains(target) && target !== mobileSearchButton) {
            mobileSearchBar.classList.add('hidden');
        }
    });
});

document.addEventListener('DOMContentLoaded', adjustMainContentMargin);
window.addEventListener('resize', adjustMainContentMargin);

function adjustMainContentMargin() {
    var header = document.querySelector('header');
    var main = document.querySelector('main');

    if (header && main) {
        var headerHeight = header.offsetHeight;
        main.style.marginTop = `${headerHeight}px`;
    }
}

