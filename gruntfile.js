module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    less: {
      development: {
        options: {
        paths: ['html/static/css']
        }
       ,files: {
          'content/themes/creative-store/style.css': ['content/themes/creative-store/less/global.less']
         ,'content/themes/creative-store/login.css': ['content/themes/creative-store/less/login.less']
        }
      }
    }

   ,jshint: {
      options: {
        browser: true
       ,curly: true
       ,eqeqeq: true
       ,eqnull: true
       ,indent: 2
       ,laxbreak: true
       ,laxcomma: true
       ,quotmark: 'single'
       ,trailing: true
       ,undef: true
       ,globals: {
          jQuery: true
        }
      }
     ,files: {
        src: ['content/themes/creative-store/js/jquery.nav-main.js']
      }
    }

    ,csslint: {
      options: {
         "adjoining-classes": false
        ,"box-model": false
        ,"box-sizing": false
        ,"regex-selectors": false
        ,"universal-selector": false
      }
      ,files: {
        src: ['content/themes/creative-store/style.css']
      }
    }

   ,watch: {
      files: ['content/themes/creative-store/less/**/**.less']
     ,tasks: ['less']
     ,options: {
        livereload: true
      }
    }

  });

  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-csslint');

  grunt.registerTask('default', 'serve');
  grunt.registerTask('serve', ['less', 'watch']);
  grunt.registerTask('ci-test', ['jshint', 'csslint']);

};
