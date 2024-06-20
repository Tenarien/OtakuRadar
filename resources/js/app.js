import './bootstrap';

document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() =>{
        const flashMsg = document.getElementById('flash-msg');

        if(flashMsg) {
            flashMsg.classList.add('opacity-0');

            setTimeout(() => {
                flashMsg.classList.add('hidden');
            }, 900);
        }
    }, 5000);
})

document.addEventListener("DOMContentLoaded", () => {
    const sunIcon = document.getElementById('main-sun-icon');
    const moonIcon = document.getElementById('main-moon-icon');
    const darkModeIcons = document.getElementById('dark-mode-icons');

    if (localStorage.getItem('darkMode') === 'enabled') {
        document.documentElement.classList.add('dark');
        darkModeIcons.classList.add('lg:block');
        sunIcon.style.display = 'none';
        moonIcon.style.display = 'inline';
    } else {
        darkModeIcons.classList.add('lg:block');
        sunIcon.style.display = 'inline';
        moonIcon.style.display = 'none';
    }

    function toggleDarkMode() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('darkMode', 'disabled');
            sunIcon.style.display = 'inline';
            moonIcon.style.display = 'none';
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('darkMode', 'enabled');
            sunIcon.style.display = 'none';
            moonIcon.style.display = 'inline';
        }
    }

    sunIcon.addEventListener('click', toggleDarkMode);
    moonIcon.addEventListener('click', toggleDarkMode);
});

// Mobile menu
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
        mobileSearchButton.classList.add('hidden');
        main.classList.add('blur-lg');
        logo.classList.add('blur-lg');
    }
}


const darkModeIcons = document.getElementById('dark-mode-icons');
const darkModeIconsMobile = document.getElementById('dark-mode-icons-mobile');
const darkModeIconsDesktop = document.getElementById('dark-mode-icons-desktop');
function moveDarkModeIconMobile() {
    const sunIcon = document.getElementById('main-sun-icon');
    if(darkModeIcons && darkModeIconsMobile) {
        sunIcon.classList.add('invert')
        darkModeIconsMobile.appendChild(darkModeIcons);
        darkModeIcons.classList.remove('hidden');
    }
}

function moveDarkModeIconDesktop() {
    if (darkModeIcons && darkModeIconsDesktop) {
        darkModeIconsDesktop.appendChild(darkModeIcons);
        darkModeIcons.classList.remove('hidden');
    }
}

toggleOpen.addEventListener('click', function (event) {
    event.stopPropagation();
    mobileSearchButton.classList.remove('hidden');
    mobileSearchBar.classList.add('hidden')
    moveDarkModeIconMobile();
    handleClick();
});
toggleClose.addEventListener('click', function (event) {
    event.stopPropagation();
    moveDarkModeIconMobile();
    handleClick();
});

document.addEventListener('click', function (event) {
    var target = event.target;
    if (collapseMenu.style.display === 'block' &&
        !collapseMenu.contains(target) &&
        target !== toggleOpen &&
        target !== toggleClose) {
        collapseMenu.style.display = 'none';
        mobileSearchButton.classList.remove('hidden');
        main.classList.remove('blur-lg');
        logo.classList.remove('blur-lg');
    }
});

window.addEventListener('resize', function () {
    if (window.innerWidth >= 1024) {
        moveDarkModeIconDesktop()
        collapseMenu.style.display = 'none';
        mobileSearchButton.classList.remove('hidden');
        main.classList.remove('blur-lg');
        logo.classList.remove('blur-lg');
        mobileSearchBar.classList.add('hidden');
    }
    if(window.innerWidth <= 1024) {
        moveDarkModeIconMobile()
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

// adjust header with main content
function adjustMainContentMargin() {
    var header = document.querySelector('header');
    var main = document.querySelector('main');

    if (header && main) {
        var headerHeight = header.offsetHeight;
        main.style.marginTop = `${headerHeight}px`;
    }
}


// Iframe script
document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('.iframe-link');
    const iframeContainer = document.getElementById('iframeContainer');
    const iframeBlur = document.getElementById('iframeBlur');
    const iframe = document.getElementById('iframe');
    const closeIframe = document.getElementById('closeIframe');
    const nextIframe = document.getElementById('nextLink');
    const previousIframe = document.getElementById('previousLink');

    let currentUrl = null;

    links.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const url = link.getAttribute('data-url');
            loadIframe(url);
            updateNavigation(link);
        });
    });

    nextIframe.addEventListener('click', function (event) {
        event.preventDefault();
        const nextUrl = nextIframe.getAttribute('data-next-url');
        if (nextUrl && nextUrl !== '#') {
            loadIframe(nextUrl);
            updateNavigation(getLinkByUrl(nextUrl));
        }
    });

    previousIframe.addEventListener('click', function (event) {
        event.preventDefault();
        const previousUrl = previousIframe.getAttribute('data-previous-url');
        if (previousUrl && previousUrl !== '#') {
            loadIframe(previousUrl);
            updateNavigation(getLinkByUrl(previousUrl));
        }
    });

    document.addEventListener('click', function (event) {
        if (!iframeContainer.contains(event.target) && !event.target.classList.contains('iframe-link')) {
            hideIframe();
        }
    });

    closeIframe.addEventListener('click', function (event) {
        event.stopPropagation();
        hideIframe();
    });

    function loadIframe(url) {
        currentUrl = url;
        iframeContainer.classList.remove('hidden');
        iframeBlur.classList.remove('hidden');
        setTimeout(() => {
            iframe.src = url;
            iframeContainer.classList.remove('opacity-0');
            iframeContainer.classList.add('opacity-100');
        }, 500);
        const link = document.querySelector(`[data-url="${url}"]`);
        const chapterId = link.getAttribute('data-chapter-id');
        sendPostRequest(chapterId);
    }

    function hideIframe() {
        iframeContainer.classList.add('opacity-0');
        iframeContainer.classList.remove('opacity-100');
        setTimeout(() => {
            iframeContainer.classList.add('hidden');
            iframeBlur.classList.add('hidden');
            iframe.src = '';
            currentUrl = null;
        }, 500);
    }

    function updateNavigation(currentLink) {
        const nextUrl = currentLink.getAttribute('data-next-url');
        const previousUrl = currentLink.getAttribute('data-previous-url');

        nextIframe.setAttribute('data-next-url', nextUrl);
        previousIframe.setAttribute('data-previous-url', previousUrl);

        toggleVisibility(nextIframe, nextUrl);
        toggleVisibility(previousIframe, previousUrl);
    }

    function toggleVisibility(element, url) {
        if (!url || url === '#') {
            element.classList.add('hidden');
        } else {
            element.classList.remove('hidden');
        }
    }

    function getLinkByUrl(url) {
        return Array.from(links).find(link => link.getAttribute('data-url') === url);
    }

    function sendPostRequest(chapterId) {
        const userId = document.getElementById('userId').value;
        if (!userId) {
            return;
        }
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch('http://localhost/dashboard/OtakuRadar/public/logview', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                user_id: userId,
                chapter_id: chapterId,
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const chapterLink = document.querySelector(`a[data-chapter-id="${chapterId}"]`);
                    if (chapterLink) {
                        chapterLink.classList.remove('text-gray-500 dark:text-gray-100');
                        chapterLink.classList.add('text-purple-500 dark:text-purple-400');

                        const newLabelSpan = chapterLink.querySelector('span#new');
                        if (newLabelSpan) {
                            newLabelSpan.remove();
                        }
                    }
                } else {
                    console.error('Failed to log view:', data);
                }
            })
            .catch(error => console.error('Error:', error));
    }

});





