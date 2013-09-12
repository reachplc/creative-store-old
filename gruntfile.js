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

   ,watch: {
      files: ['content/themes/creative-store/less/**/*.less']
     ,tasks: ['less']
     ,options: {
        livereload: true
      }
    }

  });

  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.registerTask('default', 'serve');
  grunt.registerTask('serve', ['less', 'watch']);

};