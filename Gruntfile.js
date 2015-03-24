module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        jshint: {
            files: ['Gruntfile.js', 'assets/js/**/*.js'],
            options: {
                globals: {
                    jQuery: true
                }
            }
        },
        concat: {
            options: {
                stripBanners: true,
                banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
                ' * <%= pkg.homepage %>\n' +
                ' * Copyright (c) <%= grunt.template.today("yyyy") %>;\n' +
                ' * Licensed GPLv2+\n' +
                ' */\n'
            },
            scripts: {
                src: [
                    // List the JS files to Concat
                    'assets/js/src/custom.js',
                    'assets/js/src/foundation.min.js'
                ],
                dest: 'assets/js/scripts.js'
            }
        },
        uglify: {
            all: {
                files: {
                    'assets/js/scripts.min.js': ['assets/js/scripts.js']
                },
                options: {
                    banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
                    ' * <%= pkg.homepage %>\n' +
                    ' * Copyright (c) <%= grunt.template.today("yyyy") %>;\n' +
                    ' * Licensed GPLv2+\n' +
                    ' */\n',
                    mangle: {
                        except: ['jQuery']
                    }
                }
            }
        },
        sass: {
            options: {
                includePaths: [
                    'bower_components/foundation/scss',
                    'bower_components/components-font-awesome/scss'
                ]
            },
            dist: {
                options: {
                    outputStyle: 'compressed'
                },
                files: {
                    'assets/css/app.css': 'assets/scss/app.scss'
                }
            }
        },
        cssmin: {
            add_banner: {
                options: {
                    banner: '/*\n' +
                    ' * Theme Name: <%= pkg.title %>\n' +
                    ' * Theme URI: <%= pkg.homepage %>\n' +
                    ' * Author: <%= pkg.author.name %>\n' +
                    ' * Author URI: <%= pkg.author.url %>\n' +
                    ' * Description: <%= pkg.description %>\n' +
                    ' * Version: <%= pkg.version %>\n' +
                    ' */\n',
                    keepSpecialComments: 0
                },
                files: {
                    'style.css': ['assets/css/app.css']
                }
            }
        },
        copy: {
            main: {
                files: {
                    'assets/js/src/foundation.min.js': 'bower_components/foundation/js/foundation.min.js',
                    'assets/js/src/modernizr.js': 'bower_components/modernizr/modernizr.js'
                }
            },
            fonts: {
                files: [
                    {
                        expand: true,
                        cwd: 'bower_components/components-font-awesome/fonts/',
                        src: [
                            '**',
                        ],
                        dest: 'assets/fonts/'
                    }
                ]
            }
        },
        watch: {
            sass: {
                files: [
                    'assets/scss/**/*.scss'
                ],
                tasks: ['sass', 'cssmin'],
                options: {
                    debounceDelay: 500
                }
            },
            scripts: {
                files: [
                    'assets/js/**/*.js'
                ],
                tasks: ['concat', 'uglify', 'jshint'],
                options: {
                    debounceDelay: 500
                }
            }
        }
    });

    // Load other tasks
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Default task.
    grunt.registerTask( 'default', ['watch', 'concat', 'jshint', 'uglify', 'sass', 'cssmin'] );
    grunt.registerTask( 'update', ['copy'] );

    grunt.util.linefeed = '\n';
};