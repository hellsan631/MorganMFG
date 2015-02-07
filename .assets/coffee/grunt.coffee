module.exports = (grunt)->

  ############################################################
  # Project configuration
  ############################################################

  grunt.initConfig

    cfg:
      gruntFiles:[
        '.assets/coffee/grunt.coffee' #gruntfile
      ]

    imagemin:
      build:
        options:
          optimizationLevel: 3
        files: [
          expand: true
          cwd: '.assets/uploads/'
          src: ['**/*.{png,jpg,gif}']
          dest: 'assets/uploads/'
        ]

    coffee:
      options:
        bare: true
        sourceMap: true
      build:
        files:
          'Gruntfile.js': '.assets/coffee/grunt.coffee'

    uglify:
      build:
        options:
          mangle: true
          compress: true
          sourceMap: true
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
      scripts:
        files: '.assets/coffee/*.coffee'
        tasks: ['coffee']
      configFiles:
        files: 'Gruntfile.js'
        options:
          reload: true

  ##############################################################
  # Dependencies
  ###############################################################

  grunt.loadNpmTasks('grunt-contrib-coffee')
  grunt.loadNpmTasks('grunt-contrib-cssmin')
  grunt.loadNpmTasks('grunt-contrib-imagemin')
  grunt.loadNpmTasks('grunt-contrib-uglify')
  grunt.loadNpmTasks('grunt-contrib-watch')

  ############################################################
  # Alias tasks
  ############################################################

  grunt.registerTask('build', [
    'coffee' # tmp
    'uglify:build' # public
    'cssmin:build' # public
  ])

  grunt.registerTask('css', [
    'cssmin:build' # public
  ])

  grunt.registerTask('deploy', [
    'imagemin:build' # public
    'coffee' # tmp
    'uglify:build' # public
    'cssmin:build' # public
  ])

