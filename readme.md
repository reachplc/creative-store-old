# Creative Store

## Description

A repository store of artwork to be used as a guide to the style
of artwork being requested.

## Dependencies

- PHP
- MySQL
- WordPress
  - WooCommerce
  - WP-OAuth

## Documentation

During the Alpha/Beta stages, due to constant changes, documentation
will be mainly written in-line. With a dedicated section being created
at the first major release.

### Install

Clone our repository in to your development environment.

```
git clone https://github.com/trinitymirror/creative-store.git creative-store
cd creative-store
```

Activate the sub-modules.

```
git submodule update --init --recursive
```

Copy the `./_scripts/sample.wp-config` file to the `creative-store/web/` folder and rename it `wp-config.php`.

Fill in the `wp-config.php` with your local MySQL database details.

Import the latest development database using your favourite MySQL client.

Navigate to the home page `http://localhost/creative-store/web/`.

### Updating WordPress

To make this less complicated we include WordPress as a submodule.

To update the version of WordPress; fetch the origin repository, checkout the SHA of the latest tag, and commit the changes:

```
cd web/system
git fetch origin --tags
git checkout @SHA
cd ../../
git add web/system
git commit -m "Update WordPress to x.x.x"
```

### Deploying

Deployments are made automatically via CodeShip when branches, passing our tests, are merged into `master`.

## Report Issues

If you spot any issues please create a ticket via GitHub's Issue
Tracker. If the issue is security related please use the contact
information below.

## Contribute

In lieu of a formal style guide, take care to maintain the existing
coding style.

## Contact

Trinity Mirror Creative
[tmcreative@trinitymirror.com](tmcreative@trinitymirror.com)

## Copyright

Unless otherwise stated © Trinity Mirror.
