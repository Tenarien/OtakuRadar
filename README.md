
# OtakuRadar

OtakuRadar was a simple idea of creating a centrilized website designed to provide manga enthusiasts with a simple solution for accessing manga from various sources.
The project aims to bring all your favourite manga into single, cohesive interface, simplifying your manga reading experience.

# Features
- Unified Manga Access: Browse and read manga from multiple sources in one place.
- Search Functionality: Quickly find specific manga titles.
- Personilized bookmarks: Create and manage your own collection of favourite manga.
- Latest Updates: Stay informed with the latest releases and updates from different sources.

# Installation
### Prerequisties
- PHP (8.0 or higher)
- Composer
- MySQL

### Steps
- Clone the Repository
`git clone https://github.com/Tenarien/OtakuRadar.git`
`cd OtakuRadar`
-  Install PHP Dependencies
`composer install`
-  Configure `.env` File
`cp .env.example .env`
### Update the `.env` file to match your environment settings
---------------------------
DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=otakuradar

DB_USERNAME=your_db_username

DB_PASSWORD=your_db_password

---------------------------
-  Generate the Application Key
`php artisan key:generate`
-  Run Database Migrations
`php artisan migrate`
-  Run the Application
### you need vite to run dev
`npm run dev`
-  Run scrape program
`php artisan scrape:mangas asuracomic`
Wait for scrape to finish,

# Usage
- Sign up or use as a guest: Create an account for more functionality or use as a guest.
- Explore: Use the search and browse to find manga.
- Add to bookmarks: Save your favourite manga to your library for easy access.
- Read Manga: Enjoy reading manga through a single website.

# Contributing
Contributions are welcome! This is one of my first personal projects, and while it’s not perfect, it’s usable. There are definitely areas for improvement or additional features to add.

# Planned Improvements
- Add a notification feature.
- Automate the scraping process.

# License
This project is license under the MIT License.

# Contact
For any questions or suggestions, feel free to open an issue or contact me.

# Images of the Application
### Main page
![Main Page](/docs/images/main-page.png?raw=true "Main Page")
### Bookmarks page
![Bookmarks](/docs/images/bookmark.png?raw=true "Bookmark")
### Log in page
![Log in](/docs/images/log-in.png?raw=true "Log in")
### Reading manga from main page
![Reading Manga](/docs/images/read-manga.png?raw=true "Read manga")
### Searching manga
![Search](/docs/images/search.png?raw=true "Search")
### Main Page in mobile
![Main Page in mobile](/docs/images/main-responsive.png?raw=true "Main Page")
### Mobile main menu
![Mobile Main Menu](/docs/images/mobile-menu.png?raw=true "Mobile menu")
### Bookmarks in mobile, also shows chapters you have read before
![Bookmarks mobile](/docs/images/log-view.png?raw=true "Mobile bookmarks")
### Mobile search
![Mobile Search](/docs/images/mobile-search.png?raw=true "Mobile search")
### Main Page in light mode
![Main Page light mode](/docs/images/main-page-light.png?raw=true "Log in")
