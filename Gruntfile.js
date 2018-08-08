module.exports = function(grunt) {
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
            replacement: 'Version: <%= pkg.version %>'

          }]
        },
        files: [
          { src: ['<%= pkg.name %>.php'], dest: './'}
				]
      }
    },

    // copying files to create the zip file
    copy: {
      // excluding not necessary files
			main: {
				src:  [
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
  grunt.loadNpmTasks('grunt-wptools');

  grunt.registerTask('default', ['phpcs']);
  grunt.registerTask('build', ['wptools', 'replace:pluginfile', 'copy:main', 'compress:main'])
};
