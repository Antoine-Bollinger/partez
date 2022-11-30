# PHP Starter kit

[![Total Downloads](https://img.shields.io/packagist/dt/abollinger/starter-php)](https://packagist.org/packages/abollinger/starter-php)
[![Latest Stable Version](https://img.shields.io/packagist/v/abollinger/starter-php)](https://packagist.org/packages/abollinger/starter-php)
[![License](https://img.shields.io/packagist/l/abollinger/starter-php)](https://packagist.org/packages/abollinger/starter-php)

This kit is meant to help developpers to quickly create a basic PHP app with router.
This project is published on **[Packagist](https://packagist.org/packages/abollinger/starter-php)** so you can use it via composer.

![Home](public/images/preview.jpg)

## Getting started

Create a new project with: 

```bash
composer create-project abollinger/starter-php . "1.0.*"
```

Then simply run the PHP server web with:
```bash
php -S localhost:8000
``` 

and then open your browser at <a href="http://localhost:8000">localhost:8000</a> to see the result.

## The router

In "automatic mode", the router scan for all Controller.php files in the Controller directory to set the routes for the app. 
There is also the options of defining this routes manually through a YAML files.

## The pages

Pages are hosted in the Controller path. Each page must contain at least a Controller extending the main FrontendController and render a Twig template.

You can add pages manually or use the Bricolo tool :
```bash
composer bricolo addpage <pagename>
```
This will automatically create the Controller file. If the router is still in automatic mode, the page will be automatically accessible.

## Build with

- This kit is (of course) mainly build in **[PHP](https://www.php.net/)**, using as much as possible the **MVC pattern**. We use the **[Twig](https://twig.symfony.com/)** template engine to generate the pages. 
- Style is now powered by **[Bootstrap v5.2](https://getbootstrap.com/)**, using the simple CDN link.
- You can add JS scripts in the public folder or wherever you want.

The basic structure is: 

```bash
.
├── config/
│   ├── Bootstrap.class.php
│   ├── Bricolo.class.php
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
│   │   ├── includes/
│   │   ├── templates/
│   │   ├── views/
│   │   │   └── [views]
│   │   └── layout.twig
│   └── Router/
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
