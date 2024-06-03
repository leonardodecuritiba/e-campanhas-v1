# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) 
and this project adheres to [Semantic Versioning](http://semver.org/).

## [1.1.1] - 2018-03-10
 - Add    : Ability to disable autoloading css/js files in script.js
 - Add    : Support i18n for several plugins
 - Add    : Support hide/show for sidebar (See layout/sidebar-doc.html)
 - Add    : Ability to set a cache bust string that will be append to all vendor files before loading (see script.js)
 - Add    : Add 'data-disable-backdrop-click' to quickview to don't hide quickview after clicking on backdrop
 - Update : Reduce the padding-left on topbar submenus in mobile devices
 - Fix    : Plugin loader wasn't working if core.min.js had version bumper
 - Fix    : Topbar menu wasn't scrolling on mobile devices
 - Fix    : Duplication loading of google map script
 - Fix    : Tabs in samples/invoicer/settings.html

## [1.1.0] - 2018-01-21
 - Update : Plugins (Bootstrap, jQuery, Push, Lity, SweetAlert, html5sortable, noUiSlider, Typed.js)
 - Update : Custom checkbox and custom radio markup due to BS4 markup change
 - Update : Input group markup due to BS4 markup change
 - Update : .table-responsive to wrap .table due to BS4 change
 - Update : Minor CSS and JS improvements
 - Fix    : Auto-complete of topbar search

## [1.0.3] - 2017-12-05
 - Add    : Boxed layout (see layout/layout.html)
 - Add    : Quickview - Ajax load from toggler (see /layout/quickview-doc.html)
 - Update : Smaller gap-{size} for mobile devices
 - Update : Larger aside-toggler in small devices
 - Update : Statistic widgets - Better responsive behaviour on mobile devices
 - Update : Ability to make a quickview fullscreen on mobile (see docs)
 - Update : Ability to have transparent .topbar
 - Update : Plugins (VueJS, intercooler.js)
 - Update : Minor CSS and JS improvements


## [1.0.2] - 2017-11-08
 - Update : To Bootstrap-4 beta-2
 - Update : Plugins (SweetAlert2, Quill, Chartjs, VueJS, ReactJS)
 - Fix    : .topbar-search to hide placeholder without requiring script.js
 - Fix    : Minor bug fixes


## [1.0.1] - 2017-10-02
 - Add    : /layout/layout.html added with 5 layout variations
 - Update : Add .main-container class to body > main. The <main> tag without a .main-container class is depricated
 - Update : Script.js file of sample demos to use the latest config options
 - Update : Made the text colors a little darker
 - Update : Select picker now accepts data-lang option
 - Update : Plugins (SweetAlert2, Summernote, Quill, Chartjs)
 - Update : Version of few plugins in package.json
 - Update : Minor enhancements
 - Fix    : Sidebar wasn't closing in small iOS devices


## [1.0.0] - 2017-09-09
 - Initial release!

