<!-- PROJECT LOGO -->
<br />
<p align="center">
  <h3 align="center">PHP Starter kit</h3>

  <p align="center">
    A simple PHP starter kit with router & twig
  </p>
</p>

<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary>Table of Contents</summary>
  <ul>
    <li><a href="#about-the-project">About The Project</a></li>
    <li><a href="#getting-started">Getting started</a></li>
    <li><a href="#add-pages">Add pages</a></li>
    <li><a href="#build-with">Build with</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#contact">Contact 📧</a></li>
  </ul>
</details>

<!-- ABOUT THE PROJECT -->

## About The Project

This kit is meant to help developpers to quickly create a basic PHP app with router.

This project is published on Packagist so you can use it via composer.

## Getting started

Create a new project with: 

```bash
composer create-project abollinger/starter-php .
```

Then simply run the PHP server web with:
```
php -S localhost:8000
``` 

and then open your browser at <a href="http://localhost:8000">localhost:8000</a> to see the result.

## Add pages

You can add pages following this steps:

- First add element in the ```src/Router/routes.yaml```. Use the existing pages as model.
- Then you will have to create the Controller and the View in their respectives folders. Please use the existing files as model.

## Build with

- This kit is (of course) mainly build in **[PHP](https://www.php.net/)**, using as much as possible the **MVC pattern**. We use the **[Twig](https://twig.symfony.com/)** template engine to generate the pages. 
- Style is powered by **[TailwindCSS](https://tailwindcss.com/)**, using the simple CDN link.

The structure is: 

```bash
.
├── config/
│   ├── Bootstrap.class.php
│   └── Helpers.class.php
├── public/
│   ├── css/
│   ├── images/
│   └── js/
├── src/
│   ├── Controller/
│   │   ├── [pages]
│   │   └── Controller.class.php
│   ├── Model/
│   │   ├── views/
│   │   │   └── [views]
│   │   └── layout.twig
│   └── Controller/
│       ├── Router.class.php
│       └── routes.yaml
└── index.php
```

<!--CONTRIBUTING -->

## Contributing

There is many ways for you to contribute to this project. 

Please feel free to check the opened issues and if you can help, you're welcome! 

<!-- CONTACT -->

## Contact 📧

Antoine Bollinger - [LinkedIn](https://www.linkedin.com/in/antoinebollinger/) - antoine.bollinger@gmail.com
