module.exports = function(grunt) {
    grunt.initConfig({
        imagemin: {
            dist: {
                options: {
                    optimizationLevel: 5
                },
                files: [{
                    expand: true,
                    cwd: 'src/img',
                    src: ['*.{png,jpg,gif}'],
                    dest: 'img/'
                }]
            }
       },       
       cssmin: {
            dist: {
                options: {
                    banner: '/*! NewsDigest: A Trashcan News Aggregator | Neo Melonas (@neomelonas) | MIT Licensed */'
                },
                files: [{
                    expand: true,
                    cwd: 'src/css',
                    src: ['*.css','!*.min.css'],
                    dest: 'css',
                    ext: '.min.css'
                }]
            }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.registerTask('default', ['imagemin','cssmin']);
};
