'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        //'library/js/plugins/*.js',
        'library/js/*.js',
        '!library/js/scripts.min.js'
      ]
    },
    sass: {
      dist: {
        files: {
          'library/css/style.min.css': [
            'library/scss/style.scss'
          ]
        },
        options: {
          style: 'compressed',
          banner: '/*! <%= pkg.description %> - v<%= pkg.version %> - ' + '<%= grunt.template.today("yyyy-mm-dd") %> */'
        }
      },
      login: {
        files: {
          'library/css/login.css': [
            'library/scss/login.scss'
          ]
        },
        options: {
          style: 'compressed',
          banner: '/*! <%= pkg.description %> - v<%= pkg.version %> - ' + '<%= grunt.template.today("yyyy-mm-dd") %> */'
        }
      },
      ie: {
        files: {
          'library/css/ie.css': [
            'library/scss/ie.scss'
          ]
        },
        options: {
          style: 'compressed',
          banner: '/*! <%= pkg.description %> - v<%= pkg.version %> - ' + '<%= grunt.template.today("yyyy-mm-dd") %> */'
        }
      },
      admin: {
        files: {
          'library/css/admin.css': [
            'library/scss/admin.scss'
          ]
        },
        options: {
          style: 'compressed',
          banner: '/*! <%= pkg.description %> - v<%= pkg.version %> - ' + '<%= grunt.template.today("yyyy-mm-dd") %> */'
        }
      },
      buddypress: {
        files: {
          'community/css/buddypress.css': [
            'community/css/buddypress.scss'
          ]
        },
        options: {
          style: 'compressed',
          banner: '/*! <%= pkg.description %> - v<%= pkg.version %> - ' + '<%= grunt.template.today("yyyy-mm-dd") %> */'
        }
      }
    },
    uglify: {
      dist: {
        files: {
          'library/js/scripts.min.js': [
            'library/js/plugins/*.js',
            'library/js/*.js',
            '!library/js/scripts.min.js'
          ]
        },
        options: {
          banner: '/*! <%= pkg.description %> - v<%= pkg.version %> - ' + '<%= grunt.template.today("yyyy-mm-dd") %> */'
          // JS source map: to enable, uncomment the lines below and update sourceMappingURL based on your install
          // sourceMap: 'library/js/scripts.min.js.map',
          // sourceMappingURL: '/app/themes/roots/library/js/scripts.min.js.map'
        }
      }
    },
    version: {
      options: {
        file: 'library/bones.php',
        css: 'library/css/style.min.css',
        cssHandle: 'style-main-min',
        js: 'library/js/scripts.min.js',
        jsHandle: 'scripts-min-js'
      }
    },
    watch: {
      sass: {
        files: [
          'library/scss/*.scss',
          'library/scss/breakpoints/*.scss',
          'library/scss/modules/*.scss',
          'library/scss/partials/*.scss',
          'library/scss/materialize/*.scss',
          'library/scss/materialize/components/*.scss',
          'library/scss/materialize/components/date_picker/*.scss',
          'community/css/*.scss'
        ],
        tasks: ['sass', 'version']
      },
      js: {
        files: [
          '<%= jshint.all %>'
        ],
        tasks: ['jshint', 'uglify', 'version']
      },/*
      admin: {
        files: [
          'library/css/admin-colors/light/*.less'
        ],
        tasks: ['less']
      },*/
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: false
        },
        files: [
          'library/css/style.min.css',
          'library/js/scripts.min.js',
          'library/*.php',
          '*.php'
        ]
      }
    },
    clean: {
      dist: [
        'library/css/style.min.css',
        'library/js/scripts.min.js'
      ]
    }
  });

  // Load tasks
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-wp-version');

  // Register tasks
  grunt.registerTask('default', [
    'clean',
    'sass',
    'uglify',
    'version'
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);

};
