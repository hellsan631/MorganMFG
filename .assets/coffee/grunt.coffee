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
        files: grunt.file.expandMapping ['.assets/js/*.js', '.assets/theme/**/*.js'],
          'assets/',
          rename: (destBase, destPath)->
            destBase+destPath.replace '.js', '.js'

    cssmin:
      build:
        files: [
          expand: true
          cwd: '.assets/theme/css'
          src: ['*.css', '!*.min.css']
          dest: 'assets/theme/css'
        ]

  ##############################################################
  # Watch Task
  ###############################################################

    watch:
      scripts:
        files: '.assets/coffee/*.coffee'
        tasks: ['coffee']
      assets:
        files: '.assets/uploads/**/*'
        tasks: ['imagemin:build']
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
    'watch'
  ])

  grunt.registerTask('deploy', [
    'imagemin:build' # public
  ])

