What is WebYep² ?
================

WebYep2 is a Web Content Management System which is based heavily on the original 'https://github.com/obdev/WebYep', 
and as before WebYep2 is an Open Source system. 
There are many WebCMS available, even Open Source, but the original WebYep was different, and the new WebYep2 carries those innovative ideas/direction on to meet the new demands of a modern PHP7 compatible CMS:

* WebYep is designed to be simple. It's easy to install, understand and most of all use.
* WebYep does not require a database server.... yipppeee
* WebYep is available in multiple languages.
* No PHP or HTML knowledge needed.
* Freeway & RapidWeaver plugins are available plus code snippets for manual insertion into HTML. A Dreamweaver plugin is on the cards!!

 

So whats new in this release?
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

Once WebYep has had time to become a world leader and take over the cms world, or a few weeks time whichever comes first. I will be launching a commercial version which contains the Freeway actions and the pre-installed commercial and licensed rich-text editor (redactor) this editor has already been configured with a file and image manager.. all installed and ready to go...
But "how much will I charge for this commercial version" I hear you ask... well not much, most probably about the price of a few cups of tea and slice of cake at costa. 
If you would prefer to spend 'absolutely nothing' on your cms then that's fine... this version is the same as the commercial version, but it can only use TinyMCE or CKEditor for the rich-text editor.
As you can see, the entry-level bar has been lowered to subterranean levels... so there are no excuses for moaning.

 

Is It Perfect?
============================

**Nope.** I'm reasonably sure there are going to be some bugs that have slipped past me.
But it won't go pop!! or bring on the downfall of the UK economy...

 

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

