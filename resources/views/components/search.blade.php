<div class="relative">
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInputs = document.querySelectorAll('.searchInput');

        searchInputs.forEach(searchInput => {
            const searchResults = searchInput.parentElement.querySelector('.searchResults');


            const handleInput = function () {
                const query = searchInput.value.trim();

                if (query.length > 2) {
                    fetch(`http://localhost/dashboard/OtakuRadar/public/search?query=${encodeURIComponent(query)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok.');
                            }
                            return response.json();
                        })
                        .then(data => {
                            searchResults.innerHTML = '';

                            if (data.length > 0) {
                                searchResults.classList.remove('opacity-0', 'max-h-0', 'overflow-hidden');
                                searchResults.classList.add('opacity-100', 'max-h-screen');

                                data.forEach(manga => {
                                    const div = document.createElement('div');
                                    div.classList.add('p-2', 'border-b', 'flex', 'items-center', 'gap-4');
                                    div.innerHTML = `
                                <img class="rounded-md object-cover w-12 h-16" src="${manga.image}" alt="${manga.title}" loading="lazy">
                                <a href="http://localhost/dashboard/OtakuRadar/public/mangas/${manga.id}" class="hover:underline">${manga.title}</a>
                            `;
                                    searchResults.appendChild(div);
                                });
                            } else {
                                hideSearchResults(searchResults);
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                            hideSearchResults(searchResults);
                        });
                } else {
                    hideSearchResults(searchResults);
                }
            };


            searchInput.addEventListener('input', handleInput);


            searchInput.addEventListener('focus', function () {
                if (searchInput.value.trim().length > 2) {
                    searchResults.classList.remove('opacity-0', 'max-h-0', 'overflow-hidden');
                    searchResults.classList.add('opacity-100', 'max-h-screen');
                }
            });


            document.addEventListener('click', function (event) {
                if (!searchInput.contains(event.target) && !searchResults.contains(event.target)) {
                    hideSearchResults(searchResults);
                }
            });
        });

        function hideSearchResults(container) {
            container.classList.add('opacity-0', 'max-h-0', 'overflow-hidden');
            container.classList.remove('opacity-100', 'max-h-screen');
        }
    });
</script>
