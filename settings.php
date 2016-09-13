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
 * Shoelace theme with the underlying Bootstrap theme.
 *
 * @package    theme
 * @subpackage shoelace
 * @copyright  &copy; 2013-onwards G J Barnard in respect to modifications of the Clean theme.
 * @author     G J Barnard - gjbarnard at gmail dot com and {@link http://moodle.org/user/profile.php?id=442195}
 * @author     Based on code originally written by Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;
require_once(__DIR__ . "/lib.php");

$settings = null;

$ADMIN->add('themes', new admin_category('theme_shoelace', get_string('configtitle', 'theme_shoelace')));
	
	$generalsettings = new admin_settingpage('theme_shoelace_general', get_string('generalsettings', 'theme_shoelace'));

	
	 // CDN Fonts - 1 = no, 2 = yes.
    $name = 'theme_shoelace/cdnfonts';
    $title = get_string('cdnfonts', 'theme_shoelace'); 
    $description = get_string('cdnfonts_desc', 'theme_shoelace');
    $default = 1;
    $choices = array(
        1 => new lang_string('no'), // No.
        2 => new lang_string('yes') // Yes.
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $generalsettings->add($setting);
	
    // Theme colour setting.
    $name = 'theme_shoelace/themecolour';
    $title = get_string('themecolour', 'theme_shoelace');
    $description = get_string('themecolourdesc', 'theme_shoelace');
    $default = '#ffd974';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $generalsettings->add($setting);

    // Text colour setting.
    $name = 'theme_shoelace/textcolour';
    $title = get_string('textcolour', 'theme_shoelace');
    $description = get_string('textcolourdesc', 'theme_shoelace');
    $default = '#653cae';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $generalsettings->add($setting);

    // Navbar text colour setting.
    $name = 'theme_shoelace/navbartextcolour';
    $title = get_string('navbartextcolour', 'theme_shoelace');
    $description = get_string('navbartextcolourdesc', 'theme_shoelace');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $generalsettings->add($setting);

 
    // Use FontAwesome font.
    $name = 'theme_shoelace/fontawesome';
    $title = get_string('fontawesome', 'theme_shoelace');
    $description = get_string('fontawesome_desc', 'theme_shoelace');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 1);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $generalsettings->add($setting);

    // Invert Navbar to dark background.
    $name = 'theme_shoelace/invert';
    $title = get_string('invert', 'theme_shoelace');
    $description = get_string('invertdesc', 'theme_shoelace');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $generalsettings->add($setting);

    // Logo file setting.
    $name = 'theme_shoelace/logo';
    $title = get_string('logo','theme_shoelace');
    $description = get_string('logodesc', 'theme_shoelace');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $generalsettings->add($setting);

    // Number of marketing blocks.
    $name = 'theme_shoelace/nummarketingblocks';
    $title = get_string('nummarketingblocks','theme_shoelace');
    $description = get_string('nummarketingblocksdesc', 'theme_shoelace');
    $choices = array(
        1 => new lang_string('one', 'theme_shoelace'),
        2 => new lang_string('two', 'theme_shoelace'),
        3 => new lang_string('three', 'theme_shoelace'),
        4 => new lang_string('four', 'theme_shoelace')
    );
    $default = 2;
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $generalsettings->add($setting);

    // Number of footer blocks.
    $name = 'theme_shoelace/numfooterblocks';
    $title = get_string('numfooterblocks','theme_shoelace');
    $description = get_string('numfooterblocksdesc', 'theme_shoelace');
    $choices = array(
        1 => new lang_string('one', 'theme_shoelace'),
        2 => new lang_string('two', 'theme_shoelace'),
        3 => new lang_string('three', 'theme_shoelace'),
        4 => new lang_string('four', 'theme_shoelace')
    );
    $default = 2;
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $generalsettings->add($setting);

    // Footnote setting.
    $name = 'theme_shoelace/footnote';
    $title = get_string('footnote', 'theme_shoelace');
    $description = get_string('footnotedesc', 'theme_shoelace');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $generalsettings->add($setting);

    // Custom CSS file.
    $name = 'theme_shoelace/customcss';
    $title = get_string('customcss', 'theme_shoelace');
    $description = get_string('customcssdesc', 'theme_shoelace');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $generalsettings->add($setting);
    $ADMIN->add('theme_shoelace', $generalsettings);

	//Leader Board
    $leaderboardsettings = new admin_settingpage('theme_shoelace_leaderboards', get_string('leaderboards', 'theme_shoelace'));
	$conf = get_config('theme_shoelace');


	// The leaderboardcount.
	$name = 'theme_shoelace/leaderboardcount';
	$title = get_string('leaderboardcount', 'theme_shoelace');
	$description = get_string('leaderboardcount_desc', 'theme_shoelace');
	$default_leaderboardcount=3;
	$leaderboardcount = Array();
	for($x=0;$x<THEME_SHOELACE_CAROUSEL_MAX + 1;$x++){$leaderboardcount[$x]=$x;}
	$setting = new admin_setting_configselect($name, $title, $description, $default_leaderboardcount, $leaderboardcount);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$leaderboardsettings->add($setting);

	//One set of entries (SQL + Title) for each leaderboard count
	if($conf && property_exists($conf,'leaderboardcount')){
		$boardcount = $conf->leaderboardcount;
	}else{
		$boardcount = $default_leaderboardcount;
	}
	for($i=1;$i<$boardcount+1;$i++){
		//Leaderboard titles
		$name ='theme_shoelace/leaderboardtitle' . $i;
		$title = get_string('leaderboardtitle','theme_shoelace',$i);
		$description = get_string('leaderboardtitle_desc','theme_shoelace');
		$setting = new admin_setting_configtext($name, $title, $description, '');
		$leaderboardsettings->add($setting);

		// Leaderboards  sqls
		$name ='theme_shoelace/leaderboardsql' . $i;
		$title = get_string('leaderboardsql','theme_shoelace',$i);
		$description = get_string('leaderboardsql_desc','theme_shoelace');
		$setting = new admin_setting_configtextarea($name, $title, $description, '');
		$setting->set_updatedcallback('theme_reset_all_caches');
		$leaderboardsettings->add($setting);
		
		
		// Leaderboard background color setting.
		$name = 'theme_shoelace/leaderboardbackcolour' . $i;
		$title = get_string('leaderboardbackcolour', 'theme_shoelace');
		$description = get_string('leaderboardbackcolour_desc', 'theme_shoelace');
		$default = '#c2bd42';
		$previewconfig = null;
		$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
		$setting->set_updatedcallback('theme_reset_all_caches');
		$leaderboardsettings->add($setting);

		// Leaderboard forecolor setting.
		$name = 'theme_shoelace/leaderboardforecolour' . $i;
		$title = get_string('leaderboardforecolour', 'theme_shoelace');
		$description = get_string('leaderboardforecolour_desc', 'theme_shoelace');
		$default = '#ffffff';
		$previewconfig = null;
		$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
		$setting->set_updatedcallback('theme_reset_all_caches');
		$leaderboardsettings->add($setting);
		
		
	}

	$ADMIN->add('theme_shoelace', $leaderboardsettings);
	
	//The Slider
	// Front page slider page....
    // Number of front page slides.
    $name = 'theme_shoelace/frontpagenumberofslides';
    $title = get_string('frontpagenumberofslides', 'theme_shoelace');
    $description = get_string('frontpagenumberofslides_desc', 'theme_shoelace');
    $default = 3;
    $choices = array(
        0 => '0',
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7',
        8 => '8',
        9 => '9',
        10 => '10',
        11 => '11',
        12 => '12',
        13 => '13',
        14 => '14',
        15 => '15',
        16 => '16'
    );
    $slidersettings = new admin_settingpage('theme_shoelace_slider', get_string('frontpagesliderheading', 'theme_shoelace'));
    $slidersettings->add(new admin_setting_heading('theme_shoelace_slider', get_string('frontpagesliderheadingsub', 'theme_shoelace'),
            format_text(get_string('frontpagesliderheadingdesc', 'theme_shoelace'), FORMAT_MARKDOWN)));
    $slidersettings->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    // Slide speed.
    $name = 'theme_shoelace/frontpagesliderspeed';
    $title = get_string('frontpagesliderspeed', 'theme_shoelace');
    $description = get_string('frontpagesliderspeed_desc', 'theme_shoelace');
    $default = 5000;
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_INT);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $slidersettings->add($setting);

    // Show on mobile.
    $name = 'theme_shoelace/frontpageslidermobile';
    $title = get_string('frontpageslidermobile', 'theme_shoelace');
    $description = get_string('frontpageslidermobile_desc', 'theme_shoelace');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 1);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $slidersettings->add($setting);

    // Show on tablet.
    $name = 'theme_shoelace/frontpageslidertablet';
    $title = get_string('frontpageslidertablet', 'theme_shoelace');
    $description = get_string('frontpageslidertablet_desc', 'theme_shoelace');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 1);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $slidersettings->add($setting);

    // Language variables for settings....
    $langpackurl = new moodle_url('/admin/tool/langimport/index.php');
    $langsinstalled = array_merge(array('all' => get_string('all')), get_string_manager()->get_list_of_translations());

    $numberofslides = get_config('theme_shoelace', 'frontpagenumberofslides');
    for ($i = 1; $i <= $numberofslides; $i++) {
        $slidersettings->add(new admin_setting_heading('theme_shoelace_frontpageslide_heading'.$i, get_string('frontpageslidersettingspageheading', 'theme_shoelace', array('slide' => $i)), null));

        // Image.
        $name = 'theme_shoelace/frontpageslideimage'.$i;
        $title = get_string('frontpageslideimage', 'theme_shoelace', array('slide' => $i));
        $description = get_string('frontpageslideimage_desc', 'theme_shoelace', array('slide' => $i));
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'frontpageslideimage'.$i);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $slidersettings->add($setting);

        // URL.
        $name = 'theme_shoelace/frontpageslideurl'.$i;
        $title = get_string('frontpageslideurl', 'theme_shoelace', array('slide' => $i));
        $description = get_string('frontpageslideurl_desc', 'theme_shoelace', array('slide' => $i));
        $default = '';
        $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $slidersettings->add($setting);

        // Caption title.
        $name = 'theme_shoelace/frontpageslidecaptiontitle'.$i;
        $title = get_string('frontpageslidecaptiontitle', 'theme_shoelace', array('slide' => $i));
        $description = get_string('frontpageslidecaptiontitle_desc', 'theme_shoelace', array('slide' => $i));
        $default = '';
        $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $slidersettings->add($setting);

        // Caption text.
        $name = 'theme_shoelace/frontpageslidecaptiontext'.$i;
        $title = get_string('frontpageslidecaptiontext', 'theme_shoelace', array('slide' => $i));
        $description = get_string('frontpageslidecaptiontext_desc', 'theme_shoelace', array('slide' => $i));
        $default = '';
        $setting = new admin_setting_configtextarea($name, $title, $description, $default, PARAM_TEXT);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $slidersettings->add($setting);

        // Status.
        $name = 'theme_shoelace/frontpageslidestatus'.$i;
        $title = get_string('frontpageslidestatus', 'theme_shoelace', array('slide' => $i));
        $description = get_string('frontpageslidestatus_desc', 'theme_shoelace');
        $default = 1;
        $choices = array(
            1 => new lang_string('draft', 'theme_shoelace'),
            2 => new lang_string('published', 'theme_shoelace')
        );
        $slidersettings->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

        // Display.
        $name = 'theme_shoelace/frontpageslidedisplay'.$i;
        $title = get_string('frontpageslidedisplay', 'theme_shoelace', array('slide' => $i));
        $description = get_string('frontpageslidedisplay_desc', 'theme_shoelace', array('slide' => $i));
        $default = 1;
        $choices = array(
            1 => new lang_string('always', 'theme_shoelace'),
            2 => new lang_string('loggedout', 'theme_shoelace'),
            3 => new lang_string('loggedin', 'theme_shoelace')
        );

        $slidersettings->add(new admin_setting_configselect($name, $title, $description, $default, $choices));
        // Slider language only.
        $name = 'theme_shoelace/frontpageslidelang'.$i;
        $title = get_string('frontpageslidelang', 'theme_shoelace', array('slide' => $i));
        $description = get_string('frontpageslidelang_desc', 'theme_shoelace', array('slide' => $i, 'url' => html_writer::tag('a', get_string('langpack_urlname', 'theme_shoelace'), array(
                       'href' => $langpackurl, 'target' => '_blank'))));
        $default = 'all';
        $setting = new admin_setting_configselect($name, $title, $description, $default, $langsinstalled);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $slidersettings->add($setting);
    }
    $ADMIN->add('theme_shoelace', $slidersettings);

