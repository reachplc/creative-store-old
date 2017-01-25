# Creative Store

## Description

A repository store of artwork to be used as a guide to the style
of artwork being requested.

## Project URLs

- [GitHub Readme](https://github.com/trinitymirror/creative-store.co.uk/blob/master/readme.md)
- [Continuous Integration](https://codeship.com/projects/57055/)
- [Local](http://creativestore.local/)
- [QA](http://beta.creativestore.trinitymirror.com/)
- [Production](http://creativestore.trinitymirror.com/)

## Dependencies

- PHP
  - [Composer](https://getcomposer.org/)
  - [WordPress](https://wordpress.org/)
    - [WooCommerce](https://woocommerce.com)
    - [BuddyPress](https://buddypress.org/)
- MySQL
- NodeJS
  - [Sass](https://github.com/sass/node-sass/)

## On-boarding – Getting Started

### Setup your development environment

This section assumes you have Git and "**A**pache **M**ySql **P**HP" (such as WAMP, [MAMP](https://www.mamp.info/en/mamp-pro/) or [VirtualBox](https://www.virtualbox.org/) and [Vagrant](https://www.vagrantup.com/)) set up. You may need to adjust as needed for your local development environment.

Clone this repository into your development area and change into its directory:

```
git clone https://github.com/trinitymirror/creative-store.git creative-store
cd creative-store

```
Copy the example.env file, rename it to .env and update any details to suit your local development environment.

```
cp ./example.env ./.env
```

Install the project's dependencies via Composer.

```
composer install
```

Import a pre-build database or run the WordPress installer.

### Testing Your Changes

Our test suite is run on every commit pushed to this repository.

### Updating WordPress and Plugins

Upgrading dependencies to a MAJOR or MINOR version will require manually updating the `require` and `require-dev` sections of the `composer.json` file and updating composer.

After testing the new version(s) commit the commit the `composer.json` file back the the repository for deployment.

### Making Your Changes

Make your changes locally on a new branch based off `origin/master`. Commit your changes to your new branch. Push your changes to this repository run our test suite.

### Deploying to our Staging Server

Once our tests are passed, create a pull request to merge into our `develop` branch. After approval and merging this will be deployed to our staging server.

### Deploying to our Live Server

If you are happy with your changes. Create a pull request to merge your original branch into `master` (not `develop`). On merge this will start the deployment process to our live server.

## Documentation

During the Alpha/Beta stages, due to constant changes, documentation will be mainly written in-line. With a dedicated section being created at the first major release.

### Folder Structure

```
├── composer.json
├── config
│   ├── application.php
│   └── environments
│       ├── development.php
│       ├── staging.php
│       └── production.php
├── html
│   ├── app
│   │   ├── plugins
│   │   ├── plugins-mu
│   │   ├── themes
│   │   └── languages
│   ├── media
│   ├── wp-config.php
│   ├── index.php
│   └── wp
├── scripts
└── vendor
```

- In order not to expose sensitive files in the webroot, we move what's required into a `html/` directory including the vendor's `wp/` source, and the `wp-content` source.
- `wp-content` has been named `app` to better reflect its contents. It contains application code and not just "static content". It also matches up with other frameworks such as Symfony and Rails.
- `wp-config.php` remains in the `html/` because it's required by WordPress, but it only acts as a loader. The actual configuration files have been moved to `config/` for better separation.
- `vendor/` is where the Composer managed dependencies are installed to.
- `wp/` is where the WordPress core lives. It's also managed by Composer but can't be put under `vendor` due to WP limitations.
- `uploads` has been named `media` and moved outside the `app` folder to better separate code and "static" content.
- `scripts/` hold the bash scripts used for setting up and running tasks on the environment.

## Report Issues

If you spot any issues please create a ticket via GitHub's Issue
Tracker. If the issue is security related please use the contact
information below.

## Contributing to this project

This project follow the WordPress Coding Standard for [PHP](https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/), [HTML](https://make.wordpress.org/core/handbook/best-practices/coding-standards/html/), [CSS](https://make.wordpress.org/core/handbook/best-practices/coding-standards/css/) and [JavaScript](https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/).

## Contact

Trinity Mirror Creative
[tmcreative@trinitymirror.com](tmcreative@trinitymirror.com)

## Copyright

Unless otherwise stated © Trinity Mirror. All rights reserved.
