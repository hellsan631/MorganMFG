module.exports = (grunt)->

  ############################################################
  # Project configuration
  ############################################################

  grunt.initConfig

    imagemin:
      build:
        options:
          optimizationLevel: 3
        files: [
          expand: true
          cwd: '.assets/'
          src: [
            '**/*.{png,jpg,gif}',
            '**/**/*.{png,jpg,gif}',
            '**/**/**/*.{png,jpg,gif}'
          ]
          dest: 'assets/'
        ]

    uglify:
      build:
        options:
          mangle: true
        files: [
          expand: true
          cwd: '.assets/'
          src: [
            '*.js', '!*.min.js',
            '**/*.js', '!**/*.min.js',
            '**/**/*.js', '!**/**/*.min.js',
            '**/**/**/*.js', '!**/**/**/*.min.js'
          ]
          dest: 'assets/'
          ext: '.js'
        ]

    cssmin:
      build:
        files: [
          expand: true
          cwd: '.assets/'
          src: [
            '*.css', '!*.min.css',
            '**/*.css', '!**/*.min.css',
            '**/**/*.css', '!**/**/*.min.css',
            '**/**/**/*.css', '!**/**/**/*.min.css'
          ]
          dest: 'assets/'
        ]

  ##############################################################
  # Watch Task
  ###############################################################

    watch:
      configFiles:
        files: 'Gruntfile.js'
        options:
          reload: true

  ##############################################################
  # Dependencies
  ###############################################################

  grunt.loadNpmTasks('grunt-contrib-cssmin')
  grunt.loadNpmTasks('grunt-contrib-imagemin')
  grunt.loadNpmTasks('grunt-contrib-uglify')
  grunt.loadNpmTasks('grunt-contrib-watch')

  ############################################################
  # Alias tasks
  ############################################################

  grunt.registerTask('build', [
    'uglify:build' # public
    'cssmin:build' # public
  ])

  grunt.registerTask('css', [
    'cssmin:build' # public
  ])

  grunt.registerTask('deploy', [
    'imagemin:build' # public
    'uglify:build' # public
    'cssmin:build' # public
  ])

