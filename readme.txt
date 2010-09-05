=== Sub Title Plus ===
Contributors: Naif Amoodi
tags:  post, posts, blog post, blog posts, seo, search engine optimization, seo optimization, sub title plus, alternate title, title, subtitle
Requires at least: 2.1
Tested up to: 3.0.0
stable tag: trunk

== Description ==
The Sub Title Plus - SEO WordPress plugin provides an elegant method for users to assign a sub title to posts and pages. A sub title can be used to assign a mini description to a post or can be used for any other purpose. The Spunky Jones blog assigns a sub title to most of it's posts to better describe the post's content.

The plugin has inbuilt support for defining inline CSS formatting to the sub title's. It lets the user assign a CSS margin, padding, width, background color, border style, border width, border color, font size and font color.

The plugin also features a 'WP Subtitle' import functionality which lets users import titles from the WP Subtitle plugin (assuming they have in the past or still are using that plugin to manage their sub titles)

Check out some of the other <a href="http://www.spunkyjones.com/">WordPress plugins</a> by the same author.

== Installation ==
1. Upload the whole plugin folder to your /wp-content/plugins/ folder.
2. Go to the Plugins page and activate the plugin.

The usage instructions for this plugin are as follows:

1. Once the plugin has been activated from the administration panel, go to the options page of the plugin and define the CSS formatting you would like to use

2. Then edit the index.php file under your theme's folder and find
either of these:

<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

or

<h3 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>

or

<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>

3. Right after that, paste the following line of code:

<?php stp_sub_title(); ?>

4. Save the index.php file and refresh the site

5. In case your theme has a single.php, search.php and/or page.php file, you'll
need to apply these instructions to those files too

By default the plugin uses a <div></div> tag. In case you want to use a different tag, say <h3>, you can replace <?php stp_sub_title(); ?> with <?php stp_sub_title('h3'); ?>. By doing that, the <div></div> is replaced with <h3></h3>

== Additional ==
1. The Sub Title Plus plugin was written for the Spunky Jones Blog, by Naif Amoodi.
2. If you like the plugin, be sure to spread the word about this plugin. Making a small blog post about it and include a link back to the Spunky Jones Blog, would be great!

== License ==
You should have received a copy of the GNU General Public License along with SEO Top Tip. If not, see <http://www.gnu.org/licenses/>.


