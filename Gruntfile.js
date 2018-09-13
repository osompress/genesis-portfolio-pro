module.exports = function (grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    phpcs: {
      application: {
        src: ['./*.php']
      },
      options: {
        bin: 'vendor/bin/phpcs',
      }
    },

    replace: {
      pluginfile: {
        options: {
          patterns: [{
            match: /^.*Version:.*$/m,
            replacement: ' * Version: <%= pkg.version %>'

          }]
        },
        files: [
          { src: ['<%= pkg.main_plugin_file %>.php'], dest: './' }
        ]
      }
    },

    // copying files to create the zip file
    copy: {
      // excluding not necessary files
      main: {
        src: [
          '**',
          '!node_modules/**',
          '!build/**',
          '!vendor/**',
          '!.git/**',
          '!composer.json',
          '!composer.lock',
          '!package-lock.json',
          '!Gruntfile.js',
          '!package.json',
          '!.gitignore',
          '!.gitmodules',
          '!**/Gruntfile.js',
          '!**/package.json',
          '!README.md',
          '!**/*~'
        ],
        dest: 'build/<%= pkg.name %>/'
      },
    },

    // build zip file
    compress: {
      main: {
        options: {
          archive: '<%= pkg.name %>.zip'
        },
        files: [{
          expand: true,
          cwd: 'build/<%= pkg.name %>',
          src: [
            '**/*',
          ],
          dest: '<%= pkg.name %>/'
        }]
      }
    },

    // Check correct text domain is last argument of i18n functions.
    checktextdomain: {
      options: {
        text_domain: '<%= pkg.name %>',
        keywords: [
          '__:1,2d',
          '_e:1,2d',
          '_x:1,2c,3d',
          '_ex:1,2c,3d',
          '_n:1,2,4d',
          '_nx:1,2,4c,5d',
          '_n_noop:1,2,3d',
          '_nx_noop:1,2,3c,4d',
          'esc_attr__:1,2d',
          'esc_html__:1,2d',
          'esc_attr_e:1,2d',
          'esc_html_e:1,2d',
          'esc_attr_x:1,2c,3d',
          'esc_html_x:1,2c,3d'
        ]
      },
      files: {
        expand: true,
        src: [
          '*.php',
          'lib/**/*.php'
        ]
      }
    },

    // Check 'tested up to' headers against latest WordPress and WooCommerce.
    wptools: {
      test_wordpress: {
        options: {
          test: 'wordpress',
          readme: 'readme.txt',
        },
      },
    },

  });

  grunt.loadNpmTasks('grunt-phpcs');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-replace');
  grunt.loadNpmTasks('grunt-contrib-compress');
  grunt.loadNpmTasks('grunt-checktextdomain');
  grunt.loadNpmTasks('grunt-wptools');

  grunt.registerTask('default', ['phpcs']);
  grunt.registerTask('build', ['checktextdomain', 'wptools', 'replace:pluginfile', 'copy:main', 'compress:main'])
};
