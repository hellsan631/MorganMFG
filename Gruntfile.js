//@ sourceMappingURL=Gruntfile.map
module.exports = function(grunt) {
  grunt.initConfig({
    cfg: {
      gruntFiles: ['.assets/coffee/grunt.coffee']
    },
    imagemin: {
      build: {
        options: {
          optimizationLevel: 3
        },
        files: [
          {
            expand: true,
            cwd: '.assets/uploads/',
            src: ['**/*.{png,jpg,gif}'],
            dest: 'assets/uploads/'
          }
        ]
      }
    },
    coffee: {
      options: {
        bare: true,
        sourceMap: true
      },
      build: {
        files: {
          'Gruntfile.js': '.assets/coffee/grunt.coffee'
        }
      }
    },
    uglify: {
      build: {
        options: {
          mangle: true,
          compress: true,
          sourceMap: true
        },
        files: [
          {
            expand: true,
            cwd: '.assets/',
            src: ['*.js', '!*.min.js', '**/*.js', '!**/*.min.js', '**/**/*.js', '!**/**/*.min.js', '**/**/**/*.js', '!**/**/**/*.min.js'],
            dest: 'assets/',
            ext: '.js'
          }
        ]
      }
    },
    cssmin: {
      build: {
        files: [
          {
            expand: true,
            cwd: '.assets/',
            src: ['*.css', '!*.min.css', '**/*.css', '!**/*.min.css', '**/**/*.css', '!**/**/*.min.css', '**/**/**/*.css', '!**/**/**/*.min.css'],
            dest: 'assets/'
          }
        ]
      }
    },
    watch: {
      scripts: {
        files: '.assets/coffee/*.coffee',
        tasks: ['coffee']
      },
      configFiles: {
        files: 'Gruntfile.js',
        options: {
          reload: true
        }
      }
    }
  });
  grunt.loadNpmTasks('grunt-contrib-coffee');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.registerTask('build', ['coffee', 'uglify:build', 'cssmin:build']);
  grunt.registerTask('css', ['cssmin:build']);
  return grunt.registerTask('deploy', ['imagemin:build', 'coffee', 'uglify:build', 'cssmin:build']);
};
