
Experimental work towards WebYep 3.5
===================================

Alongside ongoing work on WebYep 3.1, we’re also experimenting with a new inline editing option planned for a future WebYep 3.5 release. This is an addition to WebYep, not a replacement, the existing WebYep items remain in place, although some have been rewritten and streamlined to make them cleaner and more consistent internally.

The focus of this work is a more flexible, on-page editing experience, where content is edited directly on the page using structured blocks rather than a single free-form text field. This opens the door to building proper content sections... for example combining text, tables, columns and media into rearrangeable layouts.. rather than just editing text and images in isolation.

We’re also testing optional AI and email plugins to explore how they might support writing, updates, exports and day-to-day communication. This work is very much experimental and not production-ready, but we’re keen to see how it complements existing WebYep workflows and what people make of it.


Yes WebYep 3.1 is done!!
================
WebYep 3.1 
Yes hold onto your hats – WebYep 3.1 has finally landed.... Well almost. Yes, the latest version is almost out, and it's practically perfect (if you ignore the minor detail of incomplete documentation... but who needs that!!
So, what magical wonders does this release bring you?
* 🎵 WebYep Audio: You can now upload audio files. Just what you needed. A way to share your questionable taste in music with the world!
* 📖 WebYep Guestbook: The guestbook is back! Because nothing says cutting-edge web technology like a digital sign-in book. Prepare for a flood of "Nice site!" and "First!" comments.
* And let's not forget the bug fixes! I’ve heroically squashed more bugs that were tripping over PHP 8.3.
I'll be rolling out this masterpiece in the next few weeks. Until then, try to contain your excitement.


What is WebYep 3
================
WebYep3 is a Web Content Management System which is based heavily on the original 'https://github.com/obdev/WebYep', 
and as before, WebYep3 is an Open Source system. 
There are many WebCMS available, even Open Source, but the original WebYep was different, and the new WebYep3 carries those innovative ideas/direction on to meet the new demands of a modern PHP8 compatible CMS:

* WebYep is designed to be simple. It's easy to install, understand and, most of all use.
* WebYep does not require a database server.... yipppeee
* WebYep is available in multiple languages.
* No PHP or HTML knowledge is needed.
* Freeway & RapidWeaver plugins are available, plus code snippets for manual insertion into HTML.


So what's new in version 3.0.6 release
============================

1. Again, quite a bit 
2. There was a bug which is now fixed that occurred if you had set popup windows to be used rather than modal windows from the config file settings, and in some instances, the WebYep lock disappeared and didn't work
3. Longtext Editor can now create tables again by the use of a | symbol which was causing a fatal crash in the previous versions of WebYep 3
4. Countless tiny bugs have been squashed, but there will surely be others somewhere!!
5. WebP file format has now been added to WebYep accepted file formats in WebYep - Images, Gallery, Attachments and some Richtext Editors


So what's new in version 3.0.3 release, I hear you ask!
============================

1. A lot!!!! 
2. Now WebYep is PHP 8 compatible, all editors have been updated
3. Markup text NOW correctly handles HTML entities by either leaving anything you type 'as is' or converting it to the actual intended character, and this can be toggled on and off via the config file.
4. Countless tiny bugs have been squashed, but there are sure to be others somewhere!!
5. An extra free Richtext editor is available to use along with the Tiny MCE, and CKEditor editors and this one is called Trumbowyg
6. New documentation has been written by Will Woodgate cheers Will 


So whats new in version 2.1.1 release?
============================

1. This release disables the deprecated set_magic_quotes_runtime(), which introduced an error if running PHP 7.2 and newer. This only affected the WebYep Attachment downloaded file.



So what's new in version 2.1 release?
============================

This release adds or introduces bug fixes and a number of improvements.

1. Fixed errors and mismatches within the live page when choosing a specific Javascript Libabry setting within the config file, which in turn caused the Javascript error warning windows to be displayed
2. Loop error fixed when modal windows were set to none within the config file.
3. Logon window cancel button is fixed when no modal windows are specified within the config file.
4. Date control now works correctly.
5. WebYep loops work correctly in all PHP versions from PHP 5.6 to PHP 7.3.7
6. WebYep Read More item extra character removal fix
7. Numerous small fixes.
8. A new menu feature, which allows a developer to set the WebYep menu visual hierarchy as either expanded or collapsed when opening the WebYep menu editor. This is set within the config file.
9. Spanish has been added to the supported languages within the WebYep interface
10. Removal of license legacy file as this is now not needed.
11. There is a Commercial Rapidweaver plugin that's been re-written by William Woodgate, and this can be purchased from here: https://stacks4stacks.com/webyep/  Please note: this is a Rapid-weaver plugin and can be used in conjunction with the Free WebYep2 system or the Commercial version of WebYep2.



So what's new in version 2 release?
============================

This release adds or introduces a massive amount of visual changes. So as a guide, I have listed the main differences below:

1. visually… virtually everything has been updated, although I am still finding hidden warning popups which still use the original CSS layout, but I hope they are few and far between.
2. config file has changed a lot, and it now allows more control. It's also where you can configure things like the path to where the commercial rich-text editor files are stored or the language the editor uses *(more about that later)*. I have also added things like extra choice and control over which Javascript framework you wish to use and if you want to include the reference automatically. I have expanded the selection of Javascript frameworks to include Mootools. It’s also from here where you can set elements such as date and time configuration.
3. we now have a new Text editor to add to Short-text, Long-text and Rich-text. This new item is called Markup-text. It allows you to copy and paste raw code into your HTML page. This is extremely handy for things like embedding code from Vimeo etc
4. all code snippets have been updated, so we now have control over what size the modal window should be for each modal item
5. Menu items now have the choice of 'if you wish a link to be a none WebYep generated instance link'. This is triggered via a checkbox.
6. Long-text and Gallery-text items now have an optional floating mini menu enabled by a checkbox.
7. I have kept the gallery construction the same, but it now uses a none table method (), although I need to create a quick tutorial for everyone to understand how to use it).
8. The init-code has been tweaked and as well!! As well as the init code, we now have a new session code snippet which is added to the body tag
9. 'Date controlled WebYep loops have had to be rewritten, and again I need to post a tutorial with new updated code
10. There is a Rapidweaver plugin that's been re-written by William Woodgate, and you can read all about his stacks here: https://stacks4stacks.com/webyep/

 

What's the commercial editor all about??
============================

My first thought was once WebYep3 had had time to become a world leader and take over the cms world, or after a few weeks had passed after the initial launch, whichever came first, I would launch a commercial version. This would contain the Freeway actions and a version of WebYep3 with the pre-installed commercial and licensed rich-text editor (redactor). This editor has already been configured with a file and image manager.. all installed and ready to go...
But before that happened, I wanted to make sure WebYep was stable enough, and after I discovered the loop errors and the Javascript errors and then WebYep needed to be written to work with PHP8, I felt it only right to wait until I fixed those and so hence why I waited for WebYep 3 to be finished. That is now done, so in the next month or so WebYep3 commercial will be launched.

But "how much will I charge for this commercial version" I hear you ask... well, not much, most probably about the price of a few cups of tea and a slice of cake at costa. 
If you would prefer to spend 'absolutely nothing on your cms, then that's fine... the latest version is the same as the commercial version, but it can only use TinyMCE or CKEditor and Trumbowyg, which is its default for the rich-text editor similar to the original WebYep 1 series.
As you can see, the entry-level bar has been lowered to subterranean levels... so there are no excuses for moaning.

 

Is It Perfect?
============================

**3.0.6 is getting prety darn good and is quite a bit better than 2.1.1, 2.1.1 was slightly better than 2.1 and 2.1 is a lot better than 2.0** I'm reasonably sure there are going to be some bugs that have slipped past me.
But it won't go pop!! or bring on the downfall of the UK economy... only the Government can do that!

 

What is in this Repository?
============================

This git repository contains the source code of WebYep². If you just want to
install and use WebYep; it's easier to download the complete zip package.

'As normal' use this repository if you want to apply patches or change anything in WebYep2.
If you fix any bugs or add features, please send a patch or a pull request.

 

License
========

WebYep is distributed under the original  Terms and Conditions of the GNU General Public License in version 2 (GPLv2). A copy of these terms and conditions can be found in the directory `release-bu
