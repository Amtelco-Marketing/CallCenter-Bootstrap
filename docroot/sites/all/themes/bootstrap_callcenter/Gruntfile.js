module.exports = function (grunt) {
    grunt.initConfig({
        watch: {
            src: {
                files: ['**/*.scss', '**/*.php'],
                tasks: ['compass:dev']
            },
           options: {
                livereload: true,
            },
        },
        compass: {
            dev: {
                options: {
                    sassDir: ['sass'],
                    cssDir: ['css'],
                    environment: 'development',
                    imagesPath: 'images',
                    noLineComments: false,
                    outputStyle: 'expanded'
                }
            }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['watch']);
};
