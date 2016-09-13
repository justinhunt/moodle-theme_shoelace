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
 * Shoelace theme.
 *
 * @package    theme
 * @subpackage shoelace
 * @copyright  &copy; 2015-onwards G J Barnard in respect to modifications of the Bootstrap theme.
 * @author     G J Barnard - gjbarnard at gmail dot com and {@link http://moodle.org/user/profile.php?id=442195}
 * @author     Based on code originally written by Bas Brands, David Scotson and many other contributors.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_shoelace;

class toolbox {

    static protected $theme;

    /**
     * Finds the given tile file in the theme.  If it does not exist for the Shoelace child theme then the parent is checked.
     * @param string $filename Filename without extension to get.
     * @return string Complete path of the file.
     */
    static public function get_tile_file($filename) {
        global $CFG, $PAGE;
        $themedir = $PAGE->theme->dir;
        $filename .= '.php';

        /* Check only if a child of 'Shoelace' to prevent conflicts with other themes using the 'tiles' folder.
           The test is to change theme from Shoelace to Eyelet with the theme selector and not get an error. */
        if (in_array('shoelace', $PAGE->theme->parents)) {
            $themename = $PAGE->theme->name;
            if (file_exists("$themedir/layout/tiles/$filename")) {
                return "$themedir/layout/tiles/$filename";
            } else if (file_exists("$CFG->dirroot/theme/$themename/layout/tiles/$filename")) {
                return "$CFG->dirroot/theme/$themename/layout/tiles/$filename";
            } else if (!empty($CFG->themedir) and file_exists("$CFG->themedir/$themename/layout/tiles/$filename")) {
                return "$CFG->themedir/$themename/layout/tiles/$filename";
            }
        }
        // Check Shoelace.
        if (file_exists("$CFG->dirroot/theme/shoelace/layout/tiles/$filename")) {
            return "$CFG->dirroot/theme/shoelace/layout/tiles/$filename";
        } else if (!empty($CFG->themedir) and file_exists("$CFG->themedir/shoelace/layout/tiles/$filename")) {
            return "$CFG->themedir/shoelace/layout/tiles/$filename";
        } else {
            return dirname(__FILE__)."/$filename";
        }
    }

    /**
     * Finds the given less file in the theme.  If it does not exist for the Shoelace child theme then the parent is checked.
     * @param string $filename Filename without extension to get.
     * @return string Complete path of the file.
     */
    static private function get_less_file($filename) {
        global $CFG, $PAGE;
        $themedir = $PAGE->theme->dir;
        $filename .= '.less';

        /* Check only if a child of 'Shoelace' to prevent conflicts with other themes using the 'tiles' folder.
           The test is to change theme from Shoelace to Eyelet with the theme selector and not get an error. */
        if (in_array('shoelace', $PAGE->theme->parents)) {
            $themename = $PAGE->theme->name;
            if (file_exists("$themedir/less/$filename")) {
                return "$themedir/less/$filename";
            } else if (file_exists("$CFG->dirroot/theme/$themename/less/$filename")) {
                return "$CFG->dirroot/theme/$themename/layout/tiles/$filename";
            } else if (!empty($CFG->themedir) and file_exists("$CFG->themedir/$themename/less/$filename")) {
                return "$CFG->themedir/$themename/less/$filename";
            }
        }
        // Check Shoelace.
        if (file_exists("$CFG->dirroot/theme/shoelace/less/$filename")) {
            return "$CFG->dirroot/theme/shoelace/less/$filename";
        } else if (!empty($CFG->themedir) and file_exists("$CFG->themedir/shoelace/less/$filename")) {
            return "$CFG->themedir/shoelace/less/$filename";
        } else {
            return null;
        }
    }

    /**
     * Finds the given less file in the theme.  If it does not exist for the Shoelace child theme then the parent is checked.
     * @param string $filename Filename without extension to get.
     * @return string LESS import statement for the file if it exists otherwise an empty string.
     */
    static public function get_extra_less($filename) {
        $content = '';
        $thefile = self::get_less_file($filename);
        if (!empty($thefile)) {
            $content .= '@import "'.$thefile.'";';
        }
        return $content;
    }

    /**
     * Finds the given setting in the theme from the themes' configuration object.
     * @param string $setting Setting name.
     * @param string $format false|'format_text'|'format_html'.
     * @param theme_config $theme null|theme_config object.
     * @return any false|value of setting.
     */
    static public function get_setting($setting, $format = false, $theme = null) {

        if (empty($theme)) {
            if (empty(self::$theme)) {
                self::$theme = \theme_config::load('shoelace');
            }
            $theme = self::$theme;
        }

        global $CFG;
        require_once($CFG->dirroot . '/lib/weblib.php');
        if (empty($theme->settings->$setting)) {
            return false;
        } else if (!$format) {
            return $theme->settings->$setting;
        } else if ($format === 'format_text') {
            return format_text($theme->settings->$setting, FORMAT_PLAIN);
        } else if ($format === 'format_html') {
            return format_text($theme->settings->$setting, FORMAT_HTML, array('trusted' => true, 'noclean' => true));
        } else {
            return format_string($theme->settings->$setting);
        }
    }


    /**
     * Finds the given setting in the theme using the get_config core function for when the theme_config object has not been created.
     * @param string $setting Setting name.
     * @param themename $themename null(default of 'shoelace' used)|theme name.
     * @return any false|value of setting.
     */
    static public function get_config_setting($setting, $themename = null) {
        if (empty($themename)) {
            $themename = 'shoelace';
        }
        return \get_config('theme_'.$themename, $setting);
    }

    /**
     * Returns an object containing HTML for the areas affected by settings.
     *
     * @param $theme Theme to use if not parent.
     * @return stdClass An object with the following properties:
     *      - navbarclass A CSS class to use on the navbar. By default ''.
     *      - heading HTML to use for the heading. A logo if one is selected or the default heading.
     *      - footnote HTML to use as a footnote. By default ''.
     */
    static function get_html_for_settings($theme = null) {

        if (empty($theme)) {
            if (empty(self::$theme)) {
                self::$theme = \theme_config::load('shoelace');
            }
            $theme = self::$theme;
        }

        global $CFG, $OUTPUT;
        $return = new \stdClass;

        $return->navbarclass = '';
        if (!empty($theme->settings->invert)) {
            $return->navbarclass .= ' navbar-inverse';
        }
        
        if (!empty($settings->fontawesome) && ($settings->fontawesome == 1)) {
            $return->additionalbodyclasses[] = 'fontawesome';
            $return->fontawesome = true;
        } else {
            $return->fontawesome = false;
        }

        if (!empty($theme->settings->logo)) {
            $return->heading = \html_writer::link($CFG->wwwroot, '', array('title' => get_string('home'), 'class' => 'logo'));
        } else {
            $return->heading = $OUTPUT->page_heading();
        }

        $return->footnote = '';
        if (!empty($theme->settings->footnote)) {
            $return->footnote = '<div class="footnote text-center">'.$theme->settings->footnote.'</div>';
        }

        return $return;
    }
    
     /**
     * States if the front page slides can be shown.
     *
     * @return array of slideno => 1 = no, 2 = yes.
     */
    static public function shown_frontpageslides() {
        $slides = array();
        $settings =  \theme_config::load('shoelace')->settings;

        $frontpagenumberofslides = (empty($settings->frontpagenumberofslides)) ? false : $settings->frontpagenumberofslides;
        if ($frontpagenumberofslides) {
            $loggedin = isloggedin();
            $lang = current_language();
            for ($sl = 1; $sl <= $frontpagenumberofslides; $sl++) {
                $frontpageslidestatus = 'frontpageslidestatus' . $sl;
                if (empty($settings->$frontpageslidestatus) or ( $settings->$frontpageslidestatus == 2)) { // 2 is published.
                    $frontpageslidedisplay = 'frontpageslidedisplay' . $sl;
                    if (empty($settings->$frontpageslidedisplay)
                            or ( $settings->$frontpageslidedisplay == 1) // Always.
                            or ( ($settings->$frontpageslidedisplay == 2) and ( $loggedin == false)) // Logged out.
                            or ( ($settings->$frontpageslidedisplay == 3) and ( $loggedin == true)) // Logged in.
                    ) {
                        $frontpageslidelang = 'frontpageslidelang' . $sl;
                        if (empty($settings->$frontpageslidelang) or ( $settings->$frontpageslidelang == 'all') or ( $settings->$frontpageslidelang
                                == $lang)) {
                            // Slide can be shown.
                            $slides[$sl] = 2;
                        } else {
                            // Slide is not shown.
                            $slides[$sl] = 1;
                        }
                    }
                }
            }
        }

        return $slides;
    }

    
    static public function showslider($settings) {
        $devicetype = \core_useragent::get_device_type(); // In moodlelib.php.
        if ($devicetype == "mobile") {
            $showslider = (empty($settings->frontpageslidermobile)) ? false : $settings->frontpageslidermobile;
        } else if ($devicetype == "tablet") {
            $showslider = (empty($settings->frontpageslidertablet)) ? false : $settings->frontpageslidertablet;
        } else {
            $showslider = true;
        }
        return $showslider;
    }
}
