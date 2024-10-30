=== Metadata Driven Wordpress Event Calendar ===
Contributors: theshine, David Caplan
Donate link: http://www.bumpershine.com/donate
Tags: metadata, events, calendar, custom, fields, field, template, meta, custom field, custom fields, custom field template, bumpershine
Requires at least: 2.1
Tested up to: 3.0
Stable tag: 1.0.0

This plugin enables you to specify upcoming events the metadata of a post or page.

== Description ==

The metadata wordpress event calendar provides a nice GUI interface for adding upcoming events to each post or page. The metadata event calendar is driven by the Custom Field Template plugin by Hiroaki Miyashita. While you could do what I'm what I'm doing without the CFT plugin, it would be much, much more time consuming. 


== Installation ==

1. Download the `custom-field-template` plugin by Hiroaki Miyashita
2. Copy the `custom-field-template` directory into your `wp-content/plugins` directory
3. Activate the plugin through the `Plugins` menu in WordPress
4. Edit the options in `Settings` > `Custom Field Template` using the cft_settings.txt file included in this plugin
5. Place calendar.php and calendar_rss.php in your active theme directory
6. View the detailed instructions on how to configure this plugin over here: http://bit.ly/DElG0 or continue reading below.

Install the Custom Field Template plugin for Wordpress. I've got my plugin configured specifically for New York area events, and you can look at and/or download my settings in cft_settings.txt, of course feel free to change the options based on where you live.

Once you've got the settings configured to your liking, install the calendar.php template in your active theme folder (eg. wp-content/themes/youractivetheme) on your webserver. Then the last thing you need to do is add a new page to your blog (Pages-> Add New) and make sure that "Calendar" is set as the default template. You'll see this setting on the right hand side of your page. This is very important, if you don't set the default template to calendar, the event calendar will not work. 

Once you've configured the Custom Field Template and added the new Calendar page, there really isn't a lot to do other than commence normal blogging. Just remember though, the next time you add a post that references a future event, add in the details in the custom fields below the post and voila, it will appear on your calendar page like magic. Events are ordered sequentially by date and only future events show up in the calendar. Past events are still available in the database, and adding an archive page would be easy to do, but right now I don't really see the need for it. 

This event calendar isn't the most robust thing in the world and it's not meant to be. It's just a quick little way to keep track of shows without having to navigate off of the "add new post" page in wordpress. If you're looking for something a little more hardcore, you might want to check out the Blogs for Bands Wordpress Plugin. If there is anything you can think of that might make this calendar better, feel free to let me know in the comments. Enjoy!

A Final Note: When creating an event, I don't recommend combining a ticketmaster or ticketweb link together with the "other ticket link" textbox. Just use one or the other, if you use both, two "buy ticket" links will show up under the event. If you choose Ticketmaster or Ticketweb as the ticket provider, the calendar performs an automatic search for your show on the respective site. If your show isn't sold through the Ticketmaster or Ticketweb, then you should use the "other ticket link" textbox and paste the full URL to the ticket purchasing page.

UPDATE: I just added the code to generate a calendar RSS feed to the download package. To activate the RSS feed on your blog, all you have to do is add calendar_rss.php to your theme and then make a new Wordpress page with "Calendar RSS" as the default template.

== Frequently Asked Questions ==

= Is there an archive page for previous shows? =

No, not yet, but it wouldn't be too hard to add.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the directory of the stable readme.txt, so in this case, `/tags/4.3/screenshot-1.png` (or jpg, jpeg, gif)
2. This is the second screen shot

== Screenshots ==

1. Custom Field Template Plugin with Event Calendar Settings
2. Add The Calendar Template and Calendar Page
3. Add A Sample Event (aka New Blog Post)

== Changelog ==

= 1.0.0 =
* Initial release.

== Known Issues / Bugs ==

== Uninstall ==

1. Deactivate the plugin
2. Delete calendar.php and calendar_rss.php from your theme (if you like)
3. That's it! :)