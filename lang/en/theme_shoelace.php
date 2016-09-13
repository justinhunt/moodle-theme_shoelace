<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'theme_shoelace', language 'en'
 *
 * @package    theme
 * @subpackage shoelace
 * @copyright  &copy; 2013-onwards G J Barnard in respect to modifications of the Clean theme.
 * @author     G J Barnard - gjbarnard at gmail dot com and {@link http://moodle.org/user/profile.php?id=442195}
 * @author     Based on code originally written by Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['choosereadme'] = '
<div class="clearfix">
<div class="well">
<h2>Shoelace</h2>
<p><img class="img-polaroid" src="shoelace/pix/screenshot.png" /></p>
</div>
<div class="well">
<h3>About</h3>
<p>Shoelace is a modified Moodle bootstrap theme which inherits styles and renderers from its parent theme.</p>
<h3>Parents</h3>
<p>This theme is based upon the Bootstrap theme, which was created for Moodle 2.5, with the help of:<br>
Stuart Lamour, Mark Aberdour, Paul Hibbitts, Mary Evans.</p>
<h3>Theme Credits</h3>
<p>Author: G J Barnard<br>
Contact: <a href="http://moodle.org/user/profile.php?id=442195">Moodle profile</a><br>
Website: <a href="http://about.me/gjbarnard">about.me/gjbarnard</a>
</p>
<h3>Sponsorships</h3>
<p>This theme is provided to you for free, and if you want to express your gratitude for using this theme, please consider sponsoring by:
<h4>PayPal</h4>
<p>Please contact me via my <a href="http://moodle.org/user/profile.php?id=442195" target="_blank">\'Moodle profile\'</a> for details as I am an individual and therefore am unable to have \'buy me now\' buttons under their terms.</p>
<h4>Flattr</h4>
<a href="https://flattr.com/profile/gjb2048" target="_blank">
clicking here to sponsor.
</a>
<br>Sponsorships may allow me to provide you with more or better features in less time.</p>
<h3>Report a bug:</h3>
<p><a href="http://tracker.moodle.org">http://tracker.moodle.org</a></p>
<h3>More information</h3>
<p><a href="shoelace/Readme.md">How to use this theme.</a></p>
</div></div>';

$string['configtitle'] = 'Shoelace';

$string['themecolour'] = 'Theme colour';
$string['themecolourdesc'] = 'Set the colour for the theme.';

$string['textcolour'] = 'Text colour';
$string['textcolourdesc'] = 'Set the colour for the text.';

$string['navbartextcolour'] = 'Navbar text colour';
$string['navbartextcolourdesc'] = 'Set the colour for the navbar text.';

$string['customcss'] = 'Custom CSS';
$string['customcssdesc'] = 'Whatever CSS rules you add to this textarea will be reflected in every page, making for easier customization of this theme.';

$string['footnote'] = 'Footnote';
$string['footnotedesc'] = 'Whatever you add to this textarea will be displayed in the footer throughout your Moodle site.';

$string['invert'] = 'Invert navbar';
$string['invertdesc'] = 'Inverts text and theme colour for the navbar at the top of the page.';

$string['logo'] = 'Logo';
$string['logodesc'] = 'Please upload your custom logo here if you want to add it to the header.<br>
If the height of your logo is more than 75px add the following CSS rule to the Custom CSS box below.<br>
a.logo {height: 100px;} or whatever height in pixels the logo is.';

$string['nummarketingblocks'] = 'Maximum number of blocks per row in the marketing area';
$string['nummarketingblocksdesc'] = 'The maximum blocks per row in the marketing area.';

$string['numfooterblocks'] = 'Maximum number of blocks per row in the footer';
$string['numfooterblocksdesc'] = 'The maximum blocks per row in the footer.';

$string['one'] = 'One';
$string['two'] = 'Two';
$string['three'] = 'Three';
$string['four'] = 'Four';

$string['pluginname'] = 'Shoelace';

$string['region-side-post'] = 'Right';
$string['region-side-pre'] = 'Left';
$string['region-footer'] = 'Footer';
$string['region-marketing'] = 'Marketing';

$string['cdnfonts'] = 'Content delivery network fonts';
$string['cdnfonts_desc'] = 'Use content delivery network fonts';

// Navbar.
$string['gotobottom'] = 'Go to the bottom of the page';

// Anti-gravity.
$string['antigravity'] = 'Back to top';

//from shoehorn
$string['draft'] = 'Draft';
$string['published'] = 'Published';
$string['langpack_urlname'] = 'Language packs';

// Display:....
$string['loggedout'] = 'Logged out';
$string['loggedin'] = 'Logged in';
$string['always'] = 'Always';

// Leaderboard Unique strings
$string['majhub'] = 'MAJ Hub';
$string['generalsettings'] = 'General';
$string['leaderboards'] = 'Leaderboards';
$string['leaderboardcount'] = 'Leaderboard Count';
$string['leaderboardcount_desc'] = 'Specify here the number of leaderboards you wish to display';
$string['leaderboardtitle'] = 'Leaderboard Title({$a})';
$string['leaderboardtitle_desc'] = 'This will be the leaderboard title as it appears above the board on the page.';
$string['leaderboardsql'] = 'Leaderboard SQL({$a})';
$string['leaderboardsql_desc'] = 'The leaderboard SQL will be passed as is to a $DB->get_records_sql() call. This result will be the data from which the leaderboard will be built.';

// Front page slider settings.
$string['frontpagesliderheading'] = 'Front page slider';
$string['frontpagesliderheadingsub'] = 'Present your portfolio with slides on the front page';
$string['frontpagesliderheadingdesc'] = "Present your portfolio with slides containing an image, URL and text.  To change the number of slides change the 'Number of front page slides' below and save the page to update.  The best height for an image is 500px as this is the maximum space at greater than 1200px wide window resolution.  The dimensions are then calculated based on the available space and image ratio.";
$string['frontpageslidersettingspageheading'] = 'Slide {$a->slide}';
$string['frontpagesliderspeed'] = 'Set the slider transition speed in ms';
$string['frontpagesliderspeed_desc'] = 'Set the slide transition speed in milliseconds.  Set to 0 for manual control.';
$string['frontpageslidermobile'] = 'Display front page slider on mobile';
$string['frontpageslidermobile_desc'] = 'Display the front page slider on mobile devices.';
$string['frontpageslidertablet'] = 'Display front page slider on tablet';
$string['frontpageslidertablet_desc'] = 'Display the front page slider on tablet devices.';
$string['frontpagenumberofslides'] = 'Number of front page slides';
$string['frontpagenumberofslides_desc'] = 'Number of slides on the front page slider.';
$string['frontpageslideimage'] = 'Slide {$a->slide} image';
$string['frontpageslideimage_desc'] = 'The image for slide {$a->slide}';
$string['frontpageslideurl'] = 'Slide {$a->slide} URL';
$string['frontpageslideurl_desc'] = 'The URL for slide {$a->slide}';
$string['frontpageslidecaptiontitle'] = 'Slide {$a->slide} caption title';
$string['frontpageslidecaptiontitle_desc'] = 'The caption title for slide {$a->slide}';
$string['frontpageslidecaptiontext'] = 'Slide {$a->slide} caption text';
$string['frontpageslidecaptiontext_desc'] = 'The caption text for slide {$a->slide}';
$string['frontpageslidestatus'] = 'Slide {$a->slide} status';
$string['frontpageslidestatus_desc'] = 'Set to \'Draft\' when you are creating the slide and \'Published\' when you want it to be seen taking into account the display and language settings.';
$string['frontpageslidedisplay'] = 'Slide {$a->slide} status';
$string['frontpageslidedisplay_desc'] = 'When to display slide {$a->slide}.';
$string['frontpageslidelang'] = 'Slide {$a->slide} language';
$string['frontpageslidelang_desc'] = 'Slide language number {$a->slide}.  To see more languages, install language packs on \'{$a->url}\'.  Set to \'all\' for all languages.';

//FontAwesome
$string['fontawesome'] = 'Use the FontAwesome icon font';
$string['fontawesome_desc'] = 'Enable this option to use the FontAwesome icon font.';


//leadertable
$string['coursesearch'] = "Course Search";
$string['coursename'] = "Course Name";
$string['downloadrank'] = "Download Ranking";
$string['moodleversion'] = "Moodle";
$string['uploaddate'] = "Date";
$string['contributor'] = "Author";
$string['leaderboardbackcolour']="Leaderboard background color";
$string['leaderboardbackcolour_desc']="";
$string['leaderboardforecolour']="Leaderboard foreground color";
$string['leaderboardforecolour_desc']="";



