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
        }
      }
    }

    ,csslint: {
      options: {
         "adjoining-classes": false
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
  grunt.loadNpmTasks('grunt-contrib-csslint');

  grunt.registerTask('default', 'serve');
  grunt.registerTask('serve', ['less', 'watch']);
  grunt.registerTask('ci-test', ['csslint']);

};
