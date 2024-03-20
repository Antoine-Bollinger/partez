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

This kit is intended to help developpers to quickly create a simple PHP app.

This project is published on **[Packagist](https://packagist.org/packages/abollinger/partez)** so you can create a new project based on it.

![Home](/public/images/preview.jpg)

<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#getting-started">Getting started</a>
      <ul>
        <li><a href="#requirements">Requirements</a></li>
        <li><a href="#steps">Steps</a></li>
      </ul>
    </li>
    <li><a href="#how-it-works">How it works</a></li>
      <ul>
        <li><a href="/#configuration">Configuration</a></li>
        <li><a href="#the-router">The router</a></li>
        <li><a href="#the-pages">The pages</a></li>
        <li><a href="#the-public-folder">The public folder</a></li>
        <li><a href="#the-api">The API</a></li>
      </ul>
    <li><a href="#build-with">Build with</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>

## Getting started

### Requirements

All you need is [Composer](https://getcomposer.org/) to create the project run the server (in developpement mode).

### Steps

1. First create a new folder for your project and open a terminal in it

2. Run the following command. This will create all the necessaries files and install the dependencies of the project:

```bash
composer create-project abollinger/partez .
```

3. Then you will have to create a ```.env``` file at the root of your project. This is supposed to be done automatically but if it is not, you can use the ```.env.example``` to see what the .env can contain at this moment.

4. Finally run this simple command:

```bash
composer serve
``` 

and then open your browser at <a href="http://localhost:1234">localhost:1234</a> to see the result (the port may change according to the other ports already in use on your machine. Please check the log in the console).

## How it works

### Configuration

1. You may want to customized the HTML head of you app. Please go the ```src/view/layout.html.twig``` file and make the change you need.

2. Regarding the router configuration, it is described below.

### The router

Routes are automatically derived from Controller files contained in the ```src/Controller``` folder.
For this to work, each Controller must be block-commented in the following way:

```php
/**
 * @Route("/", name="Home", auth=false)
 */
```

The first element, ```"/"``` is the URI through which the page will be accessible. It's mandatory. 
The second element, ```name="Home"```is the name of the page. It is also mandatory.
Finally, the third element allow you to restrict access to the page to logged in users, througt the ```$this->session->isLoggedAndAuthorized(true)```.

### The pages

Pages are rendered by the controller in the ```src/Controller``` path. This controller must be an extension of the main controller define in ```Abstract/Controller.php```.
In the page's controller you must define the ```init()``` method that will call the ```renderView("page.html.twig")``` method which render the twig template.

The twig templates are localized in the ```src/view``` at the root of the project. Basic twig layout is defined as ```src/view/layout.html.twig``` and each page's twig template extends this layout.

### The public folder

The ```public``` directory contains the index.php entry point, basics js, css and images folder. Please feel free to customized this part.

### The API

A basic API is available in the ```api/``` folder. This API is powered by a database running on MySQL.

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
│   ├── Controller/
│   │   └── [Controllers, typo is <Name>Controller.php]
│   ├── Model/
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
│   ├── Router/ (Contains main Router logic)
│   └── view/ (Contain Twig templates for your app)
└── .env
```

<!--CONTRIBUTING -->

## Contributing

Any contributions you could make will be amazingly appreciated! Please follow this steps to submit your ideas:

- Fork the project
- Create your feature branch widh ```git checkout -b features/Myfeature```
- Commit your work ```git commit -m "✨ Introducing Myfeature!"```
- Push ```git push origin features/Myfeature```
- Open a Pull Request

We'll make a review of your work and merge it to the master branch if everything's OK.
Do not hesitate, every little contribution is a great way to make this starter kit getting bigger!

<!-- CONTACT -->

## Contact

If you have any question about this package, how to install, to use or to improve, feel free to contact me:

Antoine Bollinger - [LinkedIn](https://www.linkedin.com/in/antoinebollinger/) - [antoine.bollinger@gmail.com](mailto:antoine.bollinger@gmail.com)

You can talk to me in 🇫🇷, 🇧🇷 or 🇬🇧.