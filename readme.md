# Creative Store

## Quick start

Requirements:

- Apache, MySQL, PHP
- [LESS CSS](http://lesscss.org/)
- [GruntJS](http://gruntjs.com/)

1. Clone the repo: `git clone https://github.com/michaelbragg/creative-store.git creative-store && cd creative-store`
2. Install the Grunt dependencies `npm install`
3. Copy config files
  1. `cp ./_scripts/local-config-sample.php ./local-config.php`
  2. `cp ./_scripts/wp-config-sample.php ./wp-config.php`
4. Enter your local MySQL details
5. Import MySQL database
6. Update the urls in the MySQL db
  1. tbc
  2. tbc
7. Link the pre-commit hook `ln -s ../../_scripts/pre-commit .git/hooks/pre-commit`
8. Run Grunt `grunt`
9. Visit `http://{your.ip.address}/creative-store/`
