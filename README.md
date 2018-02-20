What is WebYep 2?
================

WebYep 2 is Web Content Management System. WebYep is now Open Source. There are
many WebCMS available, even Open Source, but WebYep is different:

* WebYep is designed to be simple. It's easier to get started and understand
  all its features.
* WebYep does not require a database server.
* WebYep is available in German and English.
* No PHP or HTML knowledge required.
* Comes with Dreamweaver and RapidWeaver plugins.


What is in this Repository?
============================

This git repository contains the source code of WebYep. If you just want to
install and use WebYep, it's easier to download a package from
http://www.obdev.at/webyep.

Use this repository if you want to apply patches or change anything in WebYep.
If you fix any bugs or add features, please send a patch or a pull request to
Objective Development.


Building a WebYep Package from the Source Code
===============================================

In order to build WebYep from the source code, you need the following
prerequisites:

* Mac OS X 10.6 or higher. Mac OS X comes with a command line version of PHP.
* If you want to build the Dreamweaver Plugin, you need to copy the application
  `Adobe Extension Manager CS5.app` into the `external-dependencies` directory.
  This version of WebYep has been tested with Adobe Extension Manager CS5
  version 5.0.298, but newer versions should work as well.
* If you want to build the RapidWeaver plugin, you need Xcode 4 (tested with
  version 4.6, but older and newer versions should work as well) and the
  RapidWeaver Plugin Utilities framework. Copy the folder
  `RWPluginUtilities.framework` into the `external-depenencies` directory.
  As of RapidWeaver 5 this framework can be found in
  `RapidWeaver.app/Contents/Frameworks/RWPluginUtilities.framework`.

If a prerequisite for a plugin is missing, the build script simply omits the
respective package with the plugin.

Once you have all prerequisites installed, run the build script. Open a
Terminal window, change directory into the root of this repository and type:

    release-building/make_release.php -r <version>

Replace `<version>` with the version specification of the packages you want to
build, e.g. `1.7.2-patched`.

Run the script without parameters to see other build options. Once the script
has finished, it opens a Finder window with English and German WebYep
packages, ready for distribution.


Tested Versions of Prerequisites
=================================

WebYep has a couple of prerequisites for building from the source code (see
above), and can be integrated with various external packages such as rich text
editors etc. Here's a list what has been tested. Newer and older versions may
work as well.

For building the plugins:

 Dreamweaver CS6
 RapidWeaver 5.2.2

For the installation:

 jQuery      1.4.3 is bundled in webyep-system/programm/javascript/
 Fancybox    1.3.4
 CKEditor    3.6.6.1
 TinyMCE     (unknown)
 Lightbox    (unknown)


License
========

WebYep is now distributed under the Terms and Conditions of the GNU General
Public License in version 2 (GPLv2). A copy of these terms and conditions can
be found in the directory `release-building`:

* `WebYep License Agreement.html` for the English version.
* `WebYep Lizenzbedingungen.html` for a German translation.

