<p align="center">
    <p align="center"><img src="/public/partez.png" height="40" alt="Logo partez"/></p>
    <br/>
    <p align="center">A simple & fast PHP starter kit for web app.</p>
    <p align="center">
        <a href="https://github.com/Antoine-Bollinger/partez/issues">🐛 Report Bug</a>
    </p>
</p>

[![Total Downloads](https://img.shields.io/packagist/dt/abollinger/partez)](https://packagist.org/packages/abollinger/partez)
[![Latest Stable Version](https://img.shields.io/packagist/v/abollinger/partez)](https://packagist.org/packages/abollinger/partez)
[![License](https://img.shields.io/packagist/l/abollinger/partez)](https://packagist.org/packages/abollinger/partez)

`partez` is a PHP starter kit designed to help developers quickly set up and manage a PHP web application.

![Home](/public/images/preview.webp)

<ol>
    <li><a href="#getting-started">Getting Started</a>
        <ul>
            <li><a href="#requirements">Requirements</a></li>
            <li><a href="#quick-start">Quick Start</a></li>
        </ul>
    </li>
    <li><a href="#docker-details">Docker Details</a>
        <ul>
            <li><a href="#services">Services</a></li>
            <li><a href="#volumes">Volumes</a></li>
            <li><a href="#rebuilding-or-restarting">Rebuilding or Restarting</a></li>
        </ul>
    </li>
    <li><a href="#how-it-works">How It Works</a>
        <ul>
            <li><a href="#configuration">Configuration</a></li>
            <li><a href="#the-router">The Router</a></li>
            <li><a href="#the-pages">The Pages</a></li>
            <li><a href="#the-public-folder">The Public Folder</a></li>
            <li><a href="#the-api">The API</a></li>
        </ul>
    </li>
    <li><a href="#javascript-development-with-esbuild">JavaScript Development with esbuild</a>
        <ul>
            <li><a href="#setup">Setup</a></li>
            <li><a href="#watch-compile">Watch & Compile</a></li>
        </ul>
    </li>
    <li><a href="#built-with">Built With</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#contact">Contact</a></li>
</ol>


## Getting started

### Requirements

- [Docker](https://www.docker.com)
- [Docker Compose](https://docs.docker.com/compose/)

### Quick Start

1. **Clone the Repository** (if you haven't already):

```bash
git clone https://github.com/Antoine-Bollinger/partez.git --branch master-docker --single-branch
cd partez
```
2. **Set up Environnement Variables**: Copy the example `.env` file and adjust as need:

```bash
cp .env.example .env
```
Update these key variables in `.env` to configure your MySQL container and exposed port:

```bash
APP_PORT=8080
D_NAME=partez_db
D_USER=partez_user
D_PWD=secretpassword
```

3. **Start the Project with Docker**:

```bash
docker-compose up -d --build
```
This will: 
- Start a PHP 8.2 Apache container for the app
- Start a MySQL 8.0 database container
- Install Composer dependencies
- Run `bricolo` migrations
- Serve the app on <a href="http://localhost:1234">localhost:1234</a> 

If the port is already in use, change APP_PORT in your .env file.


## Docker Details

Your app is now containerized and reproductible:


### Services

- **Web**: Run PHP 8.2 with Apache. Exposes port `${APP_PORT}` and runs `composer install`, `bricolo migrate`and Apache.
- **DB**: MySQL 8.0, with database/user/password defined in your `.env`.


### Volumes

- `vendor_data`: Prevents local vendor folder from overwriting Docker-installed dependencies.
- `db_data`: Persists your database state.


## Rebuilding or Restarting

To rebuild: 

```bash
docker-compose up --build
```
To stop:

```bash
docker-compose down
```
To stop and remove containers/volumes:

```bash
docker-compose down -v
```


## How it works


### Configuration

1. **HTML Customization**: Modify the HTML layout in `src/views/Layout.twig` to adjust the document head.

2. **Routing**: Routes are automatically derived from controllers in `src/Controllers` using specific annotations (see below).


### The Router

Define routes in src/Controllers files using PHP annotations:

```php
/**
 * @Route("/", name="Home", auth=false)
 */
```

- URI (`"/"`) is mandatory.
- Name (`name="Home"`) specifies the route's name.
- Authentification (`auth=false`) restricts the access if set to `true`  (default is `false`).


### The Pages

Controllers in `src/Controllers` extend the main controller (`Abstract/Controller.php`). The `init()` method call `renderPage("Page.twig")` to render the Twig template. Each page extends the main layout in `src/views/Layout.twig`.


### The Public Folder 

The public directory houses `index.php`, as well as `js`, `css` and `images` folders, which can be customized freely.


### The API

A basic API is available in `api/` and runs on a MySQL database.


## JavaScript Development with esbuild

This project uses [`esbuild`](https://esbuild.github.io/) for TypeScript compilation and JavaScript bundling.


### Setup

Install dependencies (automatically done in Docker build):

```bash
npm install
```


### Watch & Compile

```bash
npm run watch
```

This bundles and minifies `assets/js/main.ts` into `public/js/bundle.js` and watches for changes.


## Build with

- **PHP** (MVC pattern)
- **Twig** for templating
- **Bootstrap v5.2** (via CDN)
- **MySQL 8.0**


## Contributing

We welcome contributions! Here’s how to contribute:

- **Fork** the project.
- **Create your feature branch**: `git checkout -b features/Myfeature`.
- **Commit your changes**: `git commit -m "✨ Introducing Myfeature!"`.
- **Push to Github**: `git push origin features/Myfeature`.
- **Open a Pull Request**.


## Contact

If you have any questions, feel free to reach out:

Antoine Bollinger - [LinkedIn](https://www.linkedin.com/in/antoinebollinger/) - [antoine.bollinger@gmail.com](mailto:antoine.bollinger@gmail.com)

You can talk to me in 🇫🇷, 🇧🇷 or 🇬🇧.