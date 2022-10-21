<?php
/**
 * Groups configuration for default Minify implementation
 * @package Minify
 */

/**
 * You may wish to use the Minify URI Builder app to suggest
 * changes. http://yourdomain/min/builder/
 *
 * See https://github.com/mrclay/minify/blob/master/docs/CustomServer.wiki.md for other ideas
 **/

return array(
//    'testJs' => array('//minify/quick-test.js'), 
//    'testCss' => array('//minify/quick-test.css'),
'js' => array(
'//assets/js/config.js',
'//vendors/popper/popper.min.js', 
'//vendors/bootstrap/bootstrap.min.js', 
'//vendors/anchorjs/anchor.min.js', 
'//vendors/is/is.min.js',
'//assets/js/lightslider.js',
'//assets/js/infinite-ajax-scroll.min.js'),

'js2' => array(
'//vendors/lodash/lodash.min.js', 
'//vendors/list.js/list.min.js', 
'//vendors/countup/countUp.umd.js',
'//assets/js/lazyload.js',
'//assets/js/jquery.mask.js'),

'interactive' => array(
'//assets/js/type-it.js', 
'//assets/js/progressbar.js', 
'//assets/js/form-interactive.js', 
'//assets/js/verimail.jquery.min.js'),

'normal' => array(
'//assets/js/jquery.validate.min.js', 
'//assets/js/progressbar.js', 
'//assets/js/form-normal.js', 
'//assets/js/verimail.jquery.min.js'),

'normalnew' => array(
    '//assets/js/jquery.validate.min.js', 
    '//assets/js/progressbar.js', 
    '//assets/js/form-normal-new.js', 
    '//assets/js/verimail.jquery.min.js'),
    
'fa-js' => array(
'//assets/js/brands.min.js', 
'//assets/js/solid.min.js', 
'//assets/js/fontawesome.min.js'),

'css' => array(
'//assets/css/theme-rtl.min.css', 
'//assets/css/theme.min.css', 
'//assets/css/animate.css', 
'//vendors/overlayscrollbars/OverlayScrollbars.min.css', 
'//assets/css/menuv3.css',
'//assets/css/lazyload.css',
'//assets/css/review.css')
);
