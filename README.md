What is WebYep 3
================
WebYep3 is a Web Content Management System which is based heavily on the original 'https://github.com/obdev/WebYep', 
and as before WebYep3 is an Open Source system. 
There are many WebCMS available, even Open Source, but the original WebYep was different, and the new WebYep3 carries those innovative ideas/direction on to meet the new demands of a modern PHP8 compatible CMS:

* WebYep is designed to be simple. It's easy to install, understand and most of all use.
* WebYep does not require a database server.... yipppeee
* WebYep is available in multiple languages.
* No PHP or HTML knowledge needed.
* Freeway & RapidWeaver plugins are available plus code snippets for manual insertion into HTML. A Dreamweaver plugin is on the cards!!


So whats new in version 3.0.3 release?
============================

1. A lot!!!! 
2. Now WebYep is PHP 8 compatible, all editors have been updated
3. Markup text NOW correctly handles HTML entities by either leaving anything you type 'as is' or converting it to the actual intended character, and this can be toggled on and off via the config file.
4. Countless tiny bugs have been squashed but there sure to be others some where!!
5. An extra free Richtext editor is available to use along the Tiny MCE and cKeditor editors and this one is called trumbowyg
6. New documentation written by Will Woodgate cheers Will 


So whats new in version 2.1.1 release?
============================

1. This release disables the deprecated set_magic_quotes_runtime() which introduced an error if running PHP 7.2 and newer. This only affected the WebYep Attachment downloaded file.



So whats new in version 2.1 release?
============================

This release adds or introduces bug fixes and a number improvements

1. Fixed errors and mismatches within the live page when choosing a specific Javascript Libabry setting within the config file which in turn caused the Javascript error warning windows to be displayed
2. Loop error fixed when modal windows were set to none within the config file.
3. Logon window cancel button fixed when no modal windows are specified within the config file.
4. Date control now works correctly.
5. WebYep loops work correctly in all PHP versions from PHP 5.6 to PHP 7.3.7
6. WebYep Read More item extra character removal fix
7. Numerous small fixes.
8. A new menu feature, which allows a developer to set the WebYep menu visual hierarchy as either expanded or collapsed when opening the WebYep menu editor. This is set within the config file.
9. Spanish has been added to the supported languages within the WebYep interface
10. Removal of license legacy file as this is now not needed.
11. There is a Commercial Rapidweaver plugin that's been re-written by William Woodgate, and this can be purchased from here: https://stacks4stacks.com/webyep/  Please note: this is a Rapid-weaver plugin and can be used in conjunction with the Free WebYep2 system or the Commercial version of WebYep2.



So whats new in version 2 release?
============================

This release adds or introduces a massive amount of visual changes. So as a guide, I have listed the main differences below :

1. visually… virtually everything has been updated, although I am still finding hidden warning popups which still use the original CSS layout, but I hope they are few and far between.
2. config file has changed a lot, and it now allows more control. It's also where you can configure things like the path to where the commercial rich-text editor files are stored or the language the editor uses *(more about that later)*.  I have also added things like extra choice and control over which Javascript framework you wish to use and if you want to include the reference automatically. I have expanded the selection of Javascript frameworks to include Mootools. It’s also from here where you can set elements such as date time configuration.
3. we now have a new Text editor to add to Short-text, Long-text and Rich-text. This new item is called Markup-text. It allows you to copy and paste raw code into your HTML page This is extremely handy for things like embedding code from Vimeo etc
4. all code snippets have been updated so we now have control over what size the modal window should be for each modal item
5. Menu items now have the choice of 'if you wish a link to be a none WebYep generated instance link'. This is triggered via a checkbox.
6. Long-text and Gallery-text items now have an optional floating mini menu enabled by a checkbox.
7. I have kept the gallery construction the same, but it now uses a none table method ()although I need to create a quick tutorial for everyone to understand how to use it).
8. The init-code has been tweaked and as well!! As well as the init code, we now have a new session code snippet which is added to the body tag
9. 'Date controled' WebYep loops have had to be rewritten, and again I need to post a tutorial with new updated code
10. There is a Rapidweaver plugin that's been re-written by William Woodgate, and he will launch the minute WebYep 2 is live on Github! but in the meantime you can read all about his stacks here: https://forums.obdev.at/viewtopic.php?f=6&t=11171

 

Whats the commercial editor all about??
============================

My first thoughts was once WebYep2/3 had had time to become a world leader and take over the cms world, or after a few weeks had passed after the initial launch whichever come first I would launch a commercial version. This would contain the Freeway actions and a version of WebYep2 with the pre-installed commercial and licensed rich-text editor (redactor) this editor has already been configured with a file and image manager.. all installed and ready to go...
But before that happened, I wanted to make sure WebYep was stable enough, and after I discovered the loop errors and the Javascript errors, I felt it only right to wait until I fixed those and so hence why I waited for WebYep 2.1 to be finished. That is now done so in the next week or so WebYep2.1 commercial will be launched.

But "how much will I charge for this commercial version" I hear you ask... well not much, most probably about the price of a few cups of tea and slice of cake at costa. 
If you would prefer to spend 'absolutely nothing' on your cms then that's fine... the latest version is the same as the commercial version, but it can only use TinyMCE or CKEditor for the rich-text editor as per the original WebYep1 series.
As you can see, the entry-level bar has been lowered to subterranean levels... so there are no excuses for moaning.

 

Is It Perfect?
============================

**3.0.3 is is getting prety darn good and is quite a bit better than 2**
**2.1.1 was slightly better than 2.1 and 2.1 is a lot better than 2.0** I'm reasonably sure there are going to be some bugs that have slipped past me.
But it won't go pop!! or bring on the downfall of the UK economy... only the Government can do that!

 

What is in this Repository?
============================

This git repository contains the source code of WebYep². If you just want to
install and use WebYep; it's easier to download the complete zip package.

'As normal' use this repository if you want to apply patches or change anything in WebYep2.
If you fix any bugs or add features, please send a patch or a pull request.

 

License
========

WebYep is distributed under the original  Terms and Conditions of the GNU General Public License in version 2 (GPLv2). A copy of these terms and conditions can be found in the directory `release-building`

* `WebYep License Agreement.html` for the English version.
* `WebYep Lizenzbedingungen.html` for a German translation.

