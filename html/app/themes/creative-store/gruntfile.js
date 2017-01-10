// Grunt

module.exports = function (grunt) {

  /** Project configuration. */
  grunt.initConfig({

    //  Config
    pkg: grunt.file.readJSON('package.json'),
    dir: {
      theme: '.', // <%= dir.theme %>/
    },

    sass: {
      options: {
        sourceMap: true,
      },
      development: {
        files: {
          '<%= dir.theme %>/style.css': ['<%= dir.theme %>/_assets/sass/style.scss'],
        },
      },
    },

    postcss: {
      options: {
        map: {
          inline: false,
          annotation: '<%= dir.theme %>/',
        },
        processors: [
          require('autoprefixer')({ browsers: 'last 2 versions' }), // add vendor prefixes
          require('cssnano')(), // minify the result
        ],
      },
      dist: {
        src: 'style.css',
      },
    },

    // Optimise

    imagemin: {
        options: {
          optimizationLevel: 3,
        },
        production: {
          files: [
            {
              expand: true,
              cwd: '<%= dir.theme %>/_assets/gui',
              src: ['**/*.{png,jpg,gif}'],
              dest: '<%= dir.theme %>/gui',
            },
          ],
        },
      },

    /**
     * Minify SVGs using SVGO.
     *
     * @link https://github.com/sindresorhus/grunt-svgmin
     */
    svgmin: {
      options: {
        plugins: [
          { removeComments: true },
          { removeUselessStrokeAndFill: true },
          { removeEmptyAttrs: true },
        ],
      },
      dist: {
        files: [
          {
            expand: true,
            cwd: '<%= dir.theme %>/gui',
            src: ['**/*.svg'],
            dest: '<%= dir.theme %>/gui',
          },
        ],
      },
    },

    uglify: {
      production: {
        files: {
          '<%= dir.theme %>/_assets/js/navigation.js': ['<%= dir.theme %>/js/navigation.js'],
        },
      },
    },

    /**
     * Merge SVGs into a single SVG.
     *
     * @link https://github.com/FWeinb/grunt-svgstore
     */
    svgstore: {
      options: {
        cleanup: false,
        svg: {
          style: 'height: 0; width: 0; position: absolute; visibility: hidden;',
        },
      },
      icons: {
        options: {
          prefix: 'icon-',
        },
        files: [
          {
            '<%= dir.theme %>/gui/icons.svg': '<%= dir.theme %>/_assets/gui/svg-icons/*.svg',
          },
        ],
      },
      logos: {
        options: {
          prefix: 'logo-',
        },
        files: [
          {
            '<%= dir.theme %>/gui/logos.svg': '<%= dir.theme %>/_assets/gui/svg-logos/*.svg',
          },
        ],
      },
    },

    watch: {
      css: {
        files: '<%= dir.theme %>/_assets/sass/**/*.scss',
        tasks: ['styles'],
        options: {
          interrupt: true,
        },
      },
      svg: {
        files: [
          '<%= dir.theme %>/_assets/images/svg-icons/*.svg',
          '<%= dir.theme %>/_assets/images/svg-solutions/*.svg',
        ],
        tasks: ['icons'],
        options: {
          interrupt: true,
        },
      },
    },

    /**
     * Stats
     */

    parker: {
      options: {
        metrics: [
          'TotalStylesheetSize',
          'TotalRules',
          'TotalSelectors',
          'TotalIdentifiers',
          'TotalDeclarations',
          'SelectorsPerRule',
          'IdentifiersPerSelector',
          'SpecificityPerSelector',
          'TopSelectorSpecificity',
          'TopSelectorSpecificitySelector',
          'TotalIdSelectors',
          'TotalUniqueColours',
          'UniqueColours',
          'TotalImportantKeywords',
          'TotalMediaQueries',
          'MediaQueries',
        ],
      },
      src: [
        '<%= dir.theme %>/**/*.css',
        '!<%= dir.theme %>/_assets/**',
        '!<%= dir.theme %>/vendor/**',
        '!<%= dir.theme %>/bower_components/**',
        '!<%= dir.theme %>/node_modules/**',
      ],
    },

    cssstats: {
      options: {
        safe: true,
      },
      src: [
        '<%= dir.theme %>/**/*.css',
        '!<%= dir.theme %>/_assets/**',
        '!<%= dir.theme %>/vendor/**',
        '!<%= dir.theme %>/_assets/bower_components/**',
        '!<%= dir.theme %>/node_modules/**',
      ],
    },

    /**
     * Tests.
     */
    sasslint: {
      target: [
        '<%= dir.theme %>/_assets/sass/**/*.scss',
        '!<%= dir.theme %>/_assets/sass/_normalize.scss',
      ],
    },

    jshint: {
      options: {
        boss: true,
        curly: true,
        eqeqeq: true,
        eqnull: true,
        es3: true,
        expr: true,
        immed: true,
        noarg: true,
        nonbsp: true,
        onevar: true,
        quotmark: 'single',
        trailing: true,
        undef: true,
        unused: true,
        browser: true,
        globals: {
          _: false,
          Backbone: false,
          jQuery: false,
          JSON: false,
          wp: false,
        },
      },
      src: [
        '<%= dir.theme %>/_assets/js/**/*.js',
      ],
    },

  });

  // Tasks

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-cssstats');
  grunt.loadNpmTasks('grunt-parker');
  grunt.loadNpmTasks('grunt-newer');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-sass-lint');
  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-svgmin');
  grunt.loadNpmTasks('grunt-svgstore');

  // Options

  grunt.registerTask('stats', ['parker']);
  grunt.registerTask('tests', ['sasslint']);
  grunt.registerTask('styles', ['sass:development', 'postcss']);
  grunt.registerTask('scripts', ['newer:uglify:production']);
  grunt.registerTask('optim', ['newer:imagemin']);
  grunt.registerTask('icons', ['svgstore']);
  grunt.registerTask('dev', ['styles', 'scripts', 'icons', 'optim', 'watch']);
  grunt.registerTask('default', ['styles', 'scripts', 'icons', 'optim']);

};
