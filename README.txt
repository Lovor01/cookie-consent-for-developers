=== Cookie consent for developers ===
Contributors: lovor
Donate link: http://www.lovrohrust.com.hr
Tags: comments, spam
Requires at least: 4.9.6
Tested up to: 4.9.8
Stable tag: 4.9
Requires PHP: 5.6.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Give user a choice to control cookie or similar technology usage from your and third party sites

== Description ==

This plugin is intended primarily for developers, although any Wordpress user with knowledge of HTML and Javascript can use it. The plugin implements the logic of dealing with cookies as required by EU regulation and explained [here](https://ico.org.uk/for-organisations/guide-to-pecr/cookies-and-similar-technologies/). There is also [This european commission page](http://ec.europa.eu/ipg/basics/legal/cookies/index_en.htm) which explains basic things about cookies and legislation which regulates their usage.

The stress of plugin is on simplicity, which also gives developers open hands to do customization as prefered.

With proper use, you can make your website GDPR and PECR compliant. The basic principles are that user must be clearly informed about cookies that you use on a webpage (even from external services - web pages), and that user should be given a choice to decide if he wants to accept these cookies. The exception are cookies that do not identify computer (without unique identificator) and which are necessary for proper page functioning, like remembering shoping basket in an online store.

= How to use =

There is a setup page on admin panel in standard menu item 'Tools'. It is important to understand how plugin works, and that you should divide javascript that places cookies into "working horse" part which places cookies and does other things and part which starts that "working horse".

On the plugin settings page, you should give short information about cookies or other similar technologies (from now on I will refer simple as "cookies", although that also refers to local storage, session storage, ...) used and ID of the page which tells user more about use of such technologies. This info shows as info window and is customizable via css. Two examples,css_example1.css and css_example2.css are given to show different styling of this info window (or ribbon). The "learn more" page (whose ID is given) should also provide mechanism to choose between allowing only necessary cookies or allowing all cookies. More about this page later.

Then you have to enter code in the header and footer which places cookies and the code that calls that code, separately. In this way, the code that places cookies is executed only when user allows.

Finally, you can enter opt-out code which will block functions which place cookies if user decides not to use them.

There is also posibility to enter custom code which will run on window load event (when page fully loads) which you can use to add special effects to info window or anything else you wish.

= Learn more page =

On learn more page (you have to build it yourself) you should explain about the cookies and their usage in simple and understandable way to general public. The information about all cookies on your web and their purpose should be given (including third-party). 

**Important**: Two buttons (or links) should also be given on this page, with id's: 'btnAcceptCookies' and 'btnRefuseCookies' (without apostrophes). These buttons shall be used to enable user to choose if cookies will be used or not (except necessary ones).

== Installation ==

Install and activate plugin from Wordpress

or

1. Upload `ntg-cookie-consent` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

Go to Tools -> 03GO Cookie consent and fill the plugin settings

== Screenshots ==

Will be placed after receiving access to SVN repository

== Changelog ==

= 1.0 =
* First version, fully functional, try it ;)