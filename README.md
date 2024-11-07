<p align="center">
    <p align="center"><img src="/public/partez.png" height="40"/></p>
    <br/>
    <p align="center">A simple & fast PHP starter kit for web app.</p>
    <p align="center">
        <a href="https://github.com/Antoine-Bollinger/partez/issues">🐛 Report Bug</a> | <a href="https://packagist.org/packages/abollinger/partez">See on Packagist 📦️</a>
    </p>
</p>

[![Total Downloads](https://img.shields.io/packagist/dt/abollinger/partez)](https://packagist.org/packages/abollinger/partez)
[![Latest Stable Version](https://img.shields.io/packagist/v/abollinger/partez)](https://packagist.org/packages/abollinger/partez)
[![License](https://img.shields.io/packagist/l/abollinger/partez)](https://packagist.org/packages/abollinger/partez)

Partez is a PHP starter kit designed to help developers quickly set up and manage a PHP web application. It includes robust backend support with streamlined front-end automation via `bricolo`, a JS package that compiles assets, serves your app, and provides live reloading for a smooth development workflow.

![Home](/public/images/preview.jpg)

<details open="open">
  <summary><b>Table of Contents</b></summary>
  <ol>
    <li><a href="#getting-started">Getting Started</a>
        <ul>
            <li><a href="#requirements">Requirements</a></li>
            <li><a href="#installation-and-setup">Installation and Setup</a></li>
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
    <li><a href="#bricolo-js-automation">Bricolo JS Automation</a></li>
        <ul>
            <li><a href="#bricolo-js-configuration">Configuration</a></li>
            <li><a href="#usage">Usage</a></li>
        </ul>
    </li>
    <li><a href="#built-with">Built With</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>

<!-- GETTING STARTED -->

## Getting started

### Requirements

- [Composer](https://getcomposer.org/) for backend dependency management.
- [Node.js](https://nodejs.org/) (v12 or higher) and npm for `bricolo` to enable asset compilation and live reloading.

### Installation and Setup

1. **Project Setup**: Create a new folder for your project and open a terminal in it.

2. **Install the PHP Framework**: Run this command to install Partez and its dependencies:

```bash
composer create-project abollinger/partez .
```

3. **Create a `.env` File**: If not automatically created, create a `.env` file at the project root. You can use .env.example as a reference.

4. **Automatic Front-End Setup with `bricolo`**: `bricolo` is automatically installed via npm as part of the post-create command in `composer.json`. This includes asset compilation and live reloading.

5. Run the Development Server: Start the server with the command below to view the app in your browser at <a href="http://localhost:1234">localhost:1234</a> (the port may change according to the other ports already in use on your machine. Please check the log in the console):

```bash
composer serve
``` 

<!-- HOW IT WORKS -->

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

<!-- BRICOLO JS AUTOMATION -->

## Bricolo JS Automation

The Partez PHP framework includes `bricolo` as an automation tool for front-end tasks, so you can focus on development without needing to handle asset compilation or live reloading setup yourself. `bricolo` is installed automatically during setup, and it's already configured with a bricoloconfig.json file that defines custom settings to integrate with this project.

You can find more information on the [npm](https://www.npmjs.com/package/bricolo) of the `bricolo` (js) package.

### Bricolo JS Configuration

`bricolo` is automatically installed within the project and configured with the file `bricoloconfig.json`:

```json
{
    "phpServer": {
        "port": 8080,
        "command": "composer serve p={port}"
    },
    "jsBuild": {
        "entry": "assets/js/main.ts",
        "output": "public/js/bundle.js"
    },
    "sassBuild": {
        "entry": "assets/css/main.scss",
        "output": "public/css/style.min.css"
    },
    "watch": {
        "directories": [
            "src/**/*.php",
            "src/**/*.yaml",
            "view/**/*.twig",
            "public/**/*.css",
            "public/**/*.js",
            "public/**/*.svg"
        ]
    },
    "server": {
        "port": 1234
    }
}
```

**Configuration Overview**

- **PHP Server**: The PHP server will run on port 8080 using the command `composer serve p={port}`.

- **Asset Compilation:**

    - **JavaScript**: Compiles assets/js/main.ts into a bundle at public/js/bundle.js.
    - **CSS**: Compiles assets/css/main.scss into a minified CSS file at public/css/style.min.css.


- **File Watching**:

    - `bricolo` monitors files in specified directories (`src/**/*.php`, `view/**/*.twig`, `public/**/*.css`, etc.) for changes, which will trigger asset compilation and live browser reload.


- **Live Reload Server**: The development server is set to run on port 1234 for hot reloading.

### Usage

After creating the project, you can simply start the bricolo automation and server:

```bash
npm run serve
```

Or, if you prefer, use the command directly:

```bash
npx bricolo serve
```

This command will:

1. Start the PHP server on port 8080.
2. Compile and watch for changes in JavaScript and Sass files.
3. Automatically reload the browser at <a href="http://localhost:1234">localhost:1234</a> whenever changes are detected in watched files.

<!-- BUILD WITH -->

## Build with

- This kit is build in **[PHP](https://www.php.net/)**, using as much as possible the **MVC pattern**. We use the **[Twig](https://twig.symfony.com/)** template engine to generate the pages. 
- Style is now powered by **[Bootstrap v5.2](https://getbootstrap.com/)**, using the simple CDN link.
- You can add JS scripts in the public folder or wherever you want, as mentioned earlier.

The basic structure is: 

```bash
.
├── api/
│   ├── Abstract/ (Basic logic of the api)
│   ├── Config/ (Configuration files)
│   ├── Controllers/
│   │   └── [Controllers, typo is <Name>Controller.php]
│   ├── Models/
│   │   └── [Models, typo is <Name>Model.php]
│   ├── Provider/ (Providers logic like Database or any other resources provider)
│   ├── Router/ (main router logic for the api)
│   ├── View/ (set up a standardized response for every API request)
│   └── Starter.php
├── public/
│   ├── css/
│   ├── images/
│   ├── js/
│   └── index.php
├── src/
│   ├── Abstract/ (Basic logic of the app)
│   ├── App/ (Starter of the app)
│   ├── Config/ (Some configuration files like Bootstrap or Session)
│   ├── Controller/
│   │   └── [Controllers, typo is <Name>Controller.php]
│   └── Router/ (Contains main Router logic)
├── view/ (Contain Twig templates for your app)
└── .env
```

<!--CONTRIBUTING -->

## Contributing

We welcome contributions! Here’s how to contribute:

- **Fork** the project.
- **Create your feature branch**: ```git checkout -b features/Myfeature```.
- **Commit your changes**: ```git commit -m "✨ Introducing Myfeature!"```.
- **Push to Github**: ```git push origin features/Myfeature```.
- **Open a Pull Request**.

<!-- CONTACT -->

## Contact

If you have any questions, feel free to reach out:

Antoine Bollinger - [LinkedIn](https://www.linkedin.com/in/antoinebollinger/) - [antoine.bollinger@gmail.com](mailto:antoine.bollinger@gmail.com)

You can talk to me in 🇫🇷, 🇧🇷 or 🇬🇧.