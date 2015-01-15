// Generate timestamp for deploy files

var now = new Date(),year = now.getFullYear(),month = now.getMonth() + 1,date = now.getDate(),hour = now.getHours(),minutes = now.getMinutes(),seconds = now.getSeconds();
var dirname = year.toString()  + month.toString() + date.toString() + hour.toString() + minutes.toString() + seconds.toString();

// Grunt

module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({

  //  Config
    pkg: grunt.file.readJSON('package.json')
   ,dir: {
      theme: 'web/content/themes/creative-store'  // <%= dir.theme %>/
     ,plugin: 'web/content/plugins'  // <%= dir.plugin %>/
   }
  //  Build Site

   ,watch: {
      less: {
        files: ['<%= dir.theme %>/less/**/*']
       ,tasks: ['recess']
      }
     ,image: {
        files: ['<%= dir.theme %>/gui/**/*']
      }
     ,theme: {
        files: ['<%= dir.theme %>/**/*.php']
      }
     ,plugin: {
        files: ['<%= dir.plugin %>/*']
      }
     ,options: {
        livereload: true
      }
    }

  // Compile

   ,recess: {
      theme: {
        options: {
          compile: true
         ,compress: true
         ,noIDs: true
         ,noJSPrefix: true
         ,noOverqualifying: true
         ,noUnderscores: false
         ,noUniversalSelectors: false
         ,prefixWhitespace: true
         ,strictPropertyOrder: true
         ,zeroUnits: true
          //includePath: mixed
        }
       ,files: {
          '<%= dir.theme %>/style.css': ['<%= dir.theme %>/less/global.less']
         ,'<%= dir.theme %>/login.css': ['<%= dir.theme %>/less/login.less']
        }
      }
   }

   ,less: {
      theme: {
        files: {
          '<%= dir.theme %>/style.css': ['<%= dir.theme %>/less/global.less']
         ,'<%= dir.theme %>/login.css': ['<%= dir.theme %>/less/login.less']
        }
      }
    }

  // Deployment

    // Config settings for each deployment location
    ,sshconfig: {
      production: {
        host: '<%= grunt.option("host") %>',
        username: '<%= grunt.option("username") %>',
        password: '<%= grunt.option("password") %>',
        path: '~/domains/creativestore.trinitymirror.com/releases/' + dirname + '/',
        showProgress: true
      }
    }

    // SSH commands to be used
   ,sshexec: {
      'make-release-dir': {
        command: 'mkdir -m 755 -p ~/domains/creativestore.trinitymirror.com/releases/' + dirname
      },
      'current-symlink': {
        command: 'rm -rf ~/domains/creativestore.trinitymirror.com/html && ln -s /creativestore.trinitymirror.com/releases/' + dirname + ' /creativestore.trinitymirror.com/html'
      },
      'shared-symlink': {
        command: 'ln -s ~/domains/creativestore.trinitymirror.com/shared/uploads /creativestore.trinitymirror.com/releases/' + dirname + '/content/uploads'
      },
      'move-config': {
        command: 'mv -f ~/domains/creativestore.trinitymirror.com/releases/' + dirname + '/config/master.htaccess /creativestore.trinitymirror.com/releases/' + dirname + '/.htaccess && mv -f /creativestore.trinitymirror.com/releases/' + dirname + '/config/master.wp-config.php /creativestore.trinitymirror.com/releases/' + dirname + '/.wp-config.php && rm -rf /creativestore.trinitymirror.com/releases/' + dirname + '/config'
      }
    }

   // SFTP Commands
   ,sftp: {
      deploy: {
        files: {
          './': ['~/clone/config/**/*', '~/clone/web/index.php', '~/clone/web/content/**/*', '~/clone/web/system/**/*']
        },
        options: {
          srcBasePath: '~/clone/web/',
          showProgress: true,
          createDirectories: true,
          directoryPermissions: parseInt(755, 8)
        }
      }
    }

  // Validate

   ,htmlhint: {
      options: {
        'tag-pair': true
       ,'tagname-lowercase': true
       ,'attr-lowercase': true
       ,'attr-value-double-quotes': true
       ,'doctype-first': true
       ,'spec-char-escape': true
       ,'id-unique': true
       ,'head-script-disabled': true
       ,'style-disabled': true
       ,'src-not-empty': true
       ,'img-alt-require': true
      },
      theme: {
        src: ['<%= dir.theme %>/**/*.php']
      }

    }

   ,csslint: {
      options: {
        'adjoining-classes': false
       ,'box-model': false
       ,'box-sizing': false
       ,'regex-selectors': false
       ,'universal-selector': false
       ,'unqualified-attributes': false
       ,'font-sizes': false  //  Until CSSLint has the option to set an amount
      },
      src: [
        '<%= dir.theme %>/style.css'
       ,'<%= dir.theme %>/rtl.css'
      ]
    }

   ,cssmetrics: {
      theme: {
        src: [
          '<%= dir.theme %>/style.css'
         ,'<%= dir.theme %>/rtl.css'
        ]
       ,options: {
          quiet: false
         ,maxSelectors: 4096
         ,maxFileSize: 10240000
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
          console: true
         ,module: true
         ,jQuery: true
         ,'wp': false
        }
      },
      src: ['gruntfile.js']
    }

   ,phplint: {
      theme: ['<%= dir.theme %>/**/*.php']
     ,plugin: ['<%= dir.plugin %>/**/*.php']
    }

  // Optimise

   ,imagemin: {
      options: {
        optimizationLevel: 3
      }
     ,production: {
        files: [{
          expand: true
         ,cwd: '<%= dir.theme %>/images'
         ,src: ['**/*.{png,jpg,gif,svg}']
         ,dest: '<%= dir.theme %>/images'
        }]
      }
    }

  });

  // Tasks

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-htmlhint');
  grunt.loadNpmTasks('grunt-contrib-csslint');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-css-metrics');
  grunt.loadNpmTasks('grunt-phplint');
  grunt.loadNpmTasks('grunt-recess');
  grunt.loadNpmTasks('grunt-ssh');

  // Options

  grunt.registerTask('default', ['recess', 'serve']);
  grunt.registerTask('test', ['phplint','cssmetrics', 'csslint', 'jshint']);
  grunt.registerTask('optim', ['imagemin']);
  grunt.registerTask('dev', ['recess']);
  grunt.registerTask('build', ['recess', 'optim']);
  grunt.registerTask('serve', ['watch']);
  // Deployment options
  grunt.registerTask('deploy', ['sshexec:make-release-dir', 'sftp:deploy', 'sshexec:move-config', 'sshexec:shared-symlink']);

};
