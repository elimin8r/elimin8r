import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
const sass = gulpSass(dartSass);

import gulp from 'gulp';
import cacheBuster from 'gulp-cachebust';
import runSequence from 'gulp4-run-sequence';
import { deleteAsync } from 'del';
import fs from 'fs';
import concat from 'gulp-concat';
import terser from 'gulp-terser';
import cache from 'gulp-cache';
import imagemin from 'gulp-imagemin';
import sourcemaps from 'gulp-sourcemaps';
import cleanCSS from 'gulp-clean-css';
import autoprefixer from 'gulp-autoprefixer';

const srcDir = './assets'; // Source directory
const destDir = './dist'; // Destination directory

// Who you gonna call? Cache buster!
var cacheBust = new cacheBuster();
const manifestPath = destDir + '/manifest.json';
gulp.task('cachebust', () => {
  return gulp.src([destDir + '/css/*.css', destDir + '/js/*.js']) // Include JS files
    .pipe(cacheBust.resources())
    .pipe(gulp.dest(file => {
      if (file.extname === '.css') {
        return destDir + '/css';
      } else if (file.extname === '.js') {
        return destDir + '/js';
      }
    }))
    .pipe(cacheBust.references())
    .pipe(gulp.dest(file => {
      if (file.extname === '.css') {
        return destDir + '/css';
      } else if (file.extname === '.js') {
        return destDir + '/js';
      }
    }))
    .on('end', () => {
      let manifest = {};
      ['css', 'js'].forEach(type => {
        fs.readdir(destDir + '/' + type, (err, files) => {
          if (err) throw err;

          files.forEach(file => {
            // Only include .css and .js files
            const regex = /^[a-z]+\.[a-z]+\.[a-z0-9]+\.(css|js)$/;
            if (file.match(regex)) {
              // Remove the hash from the filename
              let originalFile = file.replace(/\.[a-z0-9]+\.(css|js)$/, '.$1');
              // Add to the manifest
              manifest[originalFile] = file;
            }
          });

          // Write the manifest to the file
          fs.writeFile(manifestPath, JSON.stringify(manifest, null, 2), (err) => {
            if (err) throw err;
          });
        });
      });
    });
});

// Compile Sass
gulp.task('sass-frontend', function() {
  return gulp.src(srcDir + '/scss/style.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write())
    .pipe(concat('style.min.css'))
    .pipe(gulp.dest(destDir + '/css'));
});

gulp.task('sass-critical', function() {
  return gulp.src(srcDir + '/scss/critical.scss')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(concat('critical.min.css'))
    .pipe(gulp.dest(destDir + '/css'));
});

gulp.task('sass-admin', function() {
  return gulp.src(srcDir + '/scss/admin.scss')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(concat('admin.min.css'))
    .pipe(gulp.dest(destDir + '/css'));
});

gulp.task('sass', gulp.parallel('sass-frontend', 'sass-critical', 'sass-admin'));

// Compile & minify JavaScript
gulp.task("terser", function() {
  return gulp.src(srcDir + '/js/*.js')
  .pipe(concat('script.min.js'))
  .pipe(terser())
  .pipe(gulp.dest(destDir + '/js'));
});

// Compress images
gulp.task('images', function() {
  return gulp.src(srcDir + '/images/**/*')
  .pipe(cache(imagemin()))
  .pipe(gulp.dest(destDir + '/images'));
});

// Minify CSS
gulp.task('minify-css',function() {
  return gulp.src(destDir + '/css/style.min.css')
    .pipe(cleanCSS())
    .pipe(gulp.dest(destDir + '/css'));
});

// Watch for changes
gulp.task('watch', function(callback) {
  gulp.watch(srcDir + '/scss/**/*.scss', gulp.series('sass'));
  gulp.watch(srcDir + '/js/*.js', gulp.series('terser'));
  gulp.watch(srcDir + '/images/**/*', gulp.series('images'));

  runSequence('clean:dist', ['sass', 'terser', 'images'], 'minify-css', 'cachebust', callback);
});

// Delete destination folder
gulp.task('clean:dist', async function() {
  return await deleteAsync(destDir);
});

// Build assets
gulp.task('build', function(callback) {
  runSequence('clean:dist', ['sass', 'terser', 'images'], 'minify-css', 'cachebust', callback);
});