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
$settings = null;
$ADMIN->add('themes', new admin_category('theme_shoelace', 'Shoelace'));

// General settings.
$generalsettings = new admin_settingpage('theme_shoelace_generic', get_string('generalsettings', 'theme_shoelace'));
$generalsettings->add(new admin_setting_heading('theme_shoelace_generalheading',
    get_string('generalheadingsub', 'theme_shoelace'),
    format_text(get_string('generalheadingdesc', 'theme_shoelace'), FORMAT_MARKDOWN)));
if ($ADMIN->fulltree) {
    global $CFG;
    if (file_exists("{$CFG->dirroot}/theme/shoelace/shoelace_admin_setting_configinteger.php")) {
        require_once($CFG->dirroot . '/theme/shoelace/shoelace_admin_setting_configinteger.php');
    } else if (!empty($CFG->themedir) && file_exists("{$CFG->themedir}/shoelace/shoelace_admin_setting_configinteger.php")) {
        require_once($CFG->themedir . '/shoelace/shoelace_admin_setting_configinteger.php');
    }

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

    // Invert Navbar to dark background.
    $name = 'theme_shoelace/invert';
    $title = get_string('invert', 'theme_shoelace');
    $description = get_string('invertdesc', 'theme_shoelace');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $generalsettings->add($setting);

    /* Hide/show navbar on scroll. */
    $name = 'theme_shoelace/navbarscroll';
    $title = get_string('navbarscroll', 'theme_shoelace');
    $upamount = get_config('theme_shoelace', 'navbarscrollupamount');
    $upamountdefault = 240;
    if ($upamount == 0) {
        $upamount = $upamountdefault;
    }
    $description = get_string('navbarscroll_desc', 'theme_shoelace',
        array('upamount' => $upamount));
    $default = 2;
    $choices = array(
        1 => new lang_string('no'),   // No.
        2 => new lang_string('yes')   // Yes.
    );
    $generalsettings->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    /* Navbar scroll up amount. */
    $name = 'theme_shoelace/navbarscrollupamount';
    $title = get_string('navbarscrollupamount', 'theme_shoelace');
    $lower = 0;
    $upper = 500;
    $description = get_string('navbarscrollupamount_desc', 'theme_shoelace',
        array('lower' => $lower, 'upper' => $upper));
    $setting = new shoelace_admin_setting_configinteger($name, $title, $description, $upamountdefault, $lower, $upper);
    $generalsettings->add($setting);

    /* CDN Fonts - 1 = no, 2 = yes. */
    $name = 'theme_shoelace/cdnfonts';
    $title = get_string('cdnfonts', 'theme_shoelace');
    $description = get_string('cdnfonts_desc', 'theme_shoelace');
    $default = 1;
    $choices = array(
        1 => new lang_string('no'),   // No.
        2 => new lang_string('yes')   // Yes.
    );
    $generalsettings->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    // Logo file setting.
    $name = 'theme_shoelace/logo';
    $title = get_string('logo', 'theme_shoelace');
    $description = get_string('logodesc', 'theme_shoelace');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $generalsettings->add($setting);

    // Number of marketing blocks.
    $name = 'theme_shoelace/nummarketingblocks';
    $title = get_string('nummarketingblocks', 'theme_shoelace');
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
    $title = get_string('numfooterblocks', 'theme_shoelace');
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
}
$ADMIN->add('theme_shoelace', $generalsettings);

// Slideshow settings.
$shoelacesettingsslideshow = new admin_settingpage('theme_shoelace_slideshow', get_string('slideshowheading', 'theme_shoelace'));
if ($ADMIN->fulltree) {
    $shoelacesettingsslideshow->add(new admin_setting_heading('theme_shoelace_slideshow',
        get_string('slideshowheadingsub', 'theme_shoelace'),
        format_text(get_string('slideshowdesc', 'theme_shoelace'), FORMAT_MARKDOWN)));

    // Toggle slideshow.
    $name = 'theme_shoelace/toggleslideshow';
    $title = get_string('toggleslideshow', 'theme_shoelace');
    $description = get_string('toggleslideshowdesc', 'theme_shoelace');
    $alwaysdisplay = get_string('alwaysdisplay', 'theme_shoelace');
    $displaybeforelogin = get_string('displaybeforelogin', 'theme_shoelace');
    $displayafterlogin = get_string('displayafterlogin', 'theme_shoelace');
    $dontdisplay = get_string('dontdisplay', 'theme_shoelace');
    $default = 1;
    $choices = array(1 => $alwaysdisplay, 2 => $displaybeforelogin, 3 => $displayafterlogin, 0 => $dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $shoelacesettingsslideshow->add($setting);

    // Number of slides.
    $name = 'theme_shoelace/numberofslides';
    $title = get_string('numberofslides', 'theme_shoelace');
    $description = get_string('numberofslides_desc', 'theme_shoelace');
    $default = 4;
    $choices = array(
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
    $shoelacesettingsslideshow->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    // Hide slideshow on phones.
    $name = 'theme_shoelace/hideontablet';
    $title = get_string('hideontablet', 'theme_shoelace');
    $description = get_string('hideontabletdesc', 'theme_shoelace');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $shoelacesettingsslideshow->add($setting);

    // Hide slideshow on tablet.
    $name = 'theme_shoelace/hideonphone';
    $title = get_string('hideonphone', 'theme_shoelace');
    $description = get_string('hideonphonedesc', 'theme_shoelace');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $shoelacesettingsslideshow->add($setting);

    // Slide interval.
    $name = 'theme_shoelace/slideinterval';
    $title = get_string('slideinterval', 'theme_shoelace');
    $description = get_string('slideintervaldesc', 'theme_shoelace');
    $default = '5000';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $shoelacesettingsslideshow->add($setting);

    // Slide caption text colour setting.
    $name = 'theme_shoelace/slidecaptiontextcolor';
    $title = get_string('slidecaptiontextcolor', 'theme_shoelace');
    $description = get_string('slidecaptiontextcolordesc', 'theme_shoelace');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $shoelacesettingsslideshow->add($setting);

    // Slide caption background colour setting.
    $name = 'theme_shoelace/slidecaptionbackgroundcolor';
    $title = get_string('slidecaptionbackgroundcolor', 'theme_shoelace');
    $description = get_string('slidecaptionbackgroundcolordesc', 'theme_shoelace');
    $default = '#ffd974';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $shoelacesettingsslideshow->add($setting);

    // Show caption centred.
    $name = 'theme_shoelace/slidecaptioncentred';
    $title = get_string('slidecaptioncentred', 'theme_shoelace');
    $description = get_string('slidecaptioncentreddesc', 'theme_shoelace');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $shoelacesettingsslideshow->add($setting);

    // Show caption options.
    $name = 'theme_shoelace/slidecaptionoptions';
    $title = get_string('slidecaptionoptions', 'theme_shoelace');
    $description = get_string('slidecaptionoptionsdesc', 'theme_shoelace');
    $default = '0';
    $choices = array(
        0 => get_string('slidecaptionbeside', 'theme_shoelace'),
        1 => get_string('slidecaptionontop', 'theme_shoelace'),
        2 => get_string('slidecaptionunderneath', 'theme_shoelace')
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $shoelacesettingsslideshow->add($setting);

    // Slide button colour setting.
    $name = 'theme_shoelace/slidebuttoncolor';
    $title = get_string('slidebuttoncolor', 'theme_shoelace');
    $description = get_string('slidebuttoncolordesc', 'theme_shoelace');
    $default = '#ffd974';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $shoelacesettingsslideshow->add($setting);

    // Slide button hover colour setting.
    $name = 'theme_shoelace/slidebuttonhovercolor';
    $title = get_string('slidebuttonhovercolor', 'theme_shoelace');
    $description = get_string('slidebuttonhovercolordesc', 'theme_shoelace');
    $default = '#653cae';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $shoelacesettingsslideshow->add($setting);

    $numberofslides = get_config('theme_shoelace', 'numberofslides');
    for ($i = 1; $i <= $numberofslides; $i++) {
        // This is the descriptor for the slide.
        $name = 'theme_shoelace/slide'.$i.'info';
        $heading = get_string('slideno', 'theme_shoelace', array('slide' => $i));
        $information = get_string('slidenodesc', 'theme_shoelace', array('slide' => $i));
        $setting = new admin_setting_heading($name, $heading, $information);
        $shoelacesettingsslideshow->add($setting);

        // Title.
        $name = 'theme_shoelace/slide'.$i;
        $title = get_string('slidetitle', 'theme_shoelace');
        $description = get_string('slidetitledesc', 'theme_shoelace');
        $default = '';
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $shoelacesettingsslideshow->add($setting);

        // Image.
        $name = 'theme_shoelace/slide'.$i.'image';
        $title = get_string('slideimage', 'theme_shoelace');
        $description = get_string('slideimagedesc', 'theme_shoelace');
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide'.$i.'image');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $shoelacesettingsslideshow->add($setting);

        // Caption text.
        $name = 'theme_shoelace/slide'.$i.'caption';
        $title = get_string('slidecaption', 'theme_shoelace');
        $description = get_string('slidecaptiondesc', 'theme_shoelace');
        $default = '';
        $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $shoelacesettingsslideshow->add($setting);

        // URL.
        $name = 'theme_shoelace/slide'.$i.'url';
        $title = get_string('slideurl', 'theme_shoelace');
        $description = get_string('slideurldesc', 'theme_shoelace');
        $default = '';
        $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $shoelacesettingsslideshow->add($setting);

        // URL target.
        $name = 'theme_shoelace/slide'.$i.'target';
        $title = get_string('slideurltarget', 'theme_shoelace');
        $description = get_string('slideurltargetdesc', 'theme_shoelace');
        $target1 = get_string('slideurltargetself', 'theme_shoelace');
        $target2 = get_string('slideurltargetnew', 'theme_shoelace');
        $target3 = get_string('slideurltargetparent', 'theme_shoelace');
        $default = '_blank';
        $choices = array('_self' => $target1, '_blank' => $target2, '_parent' => $target3);
        $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $shoelacesettingsslideshow->add($setting);
    }
}
$ADMIN->add('theme_shoelace', $shoelacesettingsslideshow);

$styleguidesetting = new admin_settingpage('theme_shoelace_styleguide', get_string('styleguide', 'theme_shoelace'));
if ($ADMIN->fulltree) {
    // Style guide.
    if (file_exists("{$CFG->dirroot}/theme/shoelace/shoelace_admin_setting_styleguide.php")) {
        require_once($CFG->dirroot . '/theme/shoelace/shoelace_admin_setting_styleguide.php');
    } else if (!empty($CFG->themedir) && file_exists("{$CFG->themedir}/shoelace/shoelace_admin_setting_styleguide.php")) {
        require_once($CFG->themedir . '/shoelace/shoelace_admin_setting_styleguide.php');
    }
    $styleguidesetting->add(new shoelace_admin_setting_styleguide('theme_shoelace_styleguide',
        get_string('styleguidesub', 'theme_shoelace'),
        get_string('styleguidedesc', 'theme_shoelace',
            array(
                'origcodelicenseurl' => html_writer::link('http://www.apache.org/licenses/LICENSE-2.0', 'Apache License v2.0',
                    array('target' => '_blank')),
                'thiscodelicenseurl' => html_writer::link('http://www.gnu.org/copyleft/gpl.html', 'GPLv3',
                    array('target' => '_blank')),
                'compatible' => html_writer::link('http://www.gnu.org/licenses/license-list.en.html#apache2', 'compatible',
                    array('target' => '_blank')),
                'contentlicenseurl' => html_writer::link('http://creativecommons.org/licenses/by/3.0/', 'CC BY 3.0',
                    array('target' => '_blank')),
                'globalsettings' => html_writer::link('http://getbootstrap.com/2.3.2/scaffolding.html#global', 'Global settings',
                    array('target' => '_blank'))
            )
        )
    ));
}
$ADMIN->add('theme_shoelace', $styleguidesetting);
