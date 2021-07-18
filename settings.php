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
 * Settings configuration for admin setting section
 * @package    theme_academi_kair
 * @copyright  2015 onwards LMSACE Dev Team (http://www.lmsace.com)
 * @author    LMSACE Dev Team
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if (is_siteadmin()) {
    $settings = new theme_boost_admin_settingspage_tabs('themesettingacademi_kair', get_string('configtitle', 'theme_academi_kair'));
    $ADMIN->add('themes', new admin_category('theme_academi_kair', 'academi_kair'));

    /* Header Settings */
    $temp = new admin_settingpage('theme_academi_kair_header', get_string('headerheading', 'theme_academi_kair'));

    // Logo file setting.
    $name = 'theme_academi_kair/logo';
    $title = get_string('logo', 'theme_academi_kair');
    $description = get_string('logodesc', 'theme_academi_kair');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Custom CSS file.
    $name = 'theme_academi_kair/customcss';
    $title = get_string('customcss', 'theme_academi_kair');
    $description = get_string('customcssdesc', 'theme_academi_kair');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    $settings->add($temp);

    /* Slideshow Settings Start */
    $temp = new admin_settingpage('theme_academi_kair_slideshow', get_string('slideshowheading', 'theme_academi_kair'));
    $temp->add(new admin_setting_heading('theme_academi_kair_slideshow', get_string('slideshowheadingsub', 'theme_academi_kair'),
    format_text(get_string('slideshowdesc', 'theme_academi_kair'), FORMAT_MARKDOWN)));

    // Display Slideshow.
    $name = 'theme_academi_kair/toggleslideshow';
    $title = get_string('toggleslideshow', 'theme_academi_kair');
    $description = get_string('toggleslideshowdesc', 'theme_academi_kair');
    $yes = get_string('yes');
    $no = get_string('no');
    $default = 1;
    $choices = array(1 => $yes , 0 => $no);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);

    // Number of slides.
    $name = 'theme_academi_kair/numberofslides';
    $title = get_string('numberofslides', 'theme_academi_kair');
    $description = get_string('numberofslides_desc', 'theme_academi_kair');
    $default = 3;
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
    );
    $temp->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    // Slideshow settings.
    $numberofslides = get_config('theme_academi_kair', 'numberofslides');
    for ($i = 1; $i <= $numberofslides; $i++) {

        // This is the descriptor for Slide One.
        $name = 'theme_academi_kair/slide' . $i . 'info';
        $heading = get_string('slideno', 'theme_academi_kair', array('slide' => $i));
        $information = get_string('slidenodesc', 'theme_academi_kair', array('slide' => $i));
        $setting = new admin_setting_heading($name, $heading, $information);
        $temp->add($setting);

        // Slide Image.
        $name = 'theme_academi_kair/slide' . $i . 'image';
        $title = get_string('slideimage', 'theme_academi_kair');
        $description = get_string('slideimagedesc', 'theme_academi_kair');
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide' . $i . 'image');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Slide Caption.
        $name = 'theme_academi_kair/slide' . $i . 'caption';
        $title = get_string('slidecaption', 'theme_academi_kair');
        $description = get_string('slidecaptiondesc', 'theme_academi_kair');
        $default = get_string('slidecaptiondefault', 'theme_academi_kair', array('slideno' => sprintf('%02d', $i) ));
        $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
        $temp->add($setting);

        // Slide Description Text.
        $name = 'theme_academi_kair/slide' . $i . 'desc';
        $title = get_string('slidedesc', 'theme_academi_kair');
        $description = get_string('slidedesctext', 'theme_academi_kair');
        $default = get_string('slidedescdefault', 'theme_academi_kair');
        $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
        $temp->add($setting);
    }
    $settings->add($temp);

    /* Slideshow Settings End*/

    /* Footer Settings start */
    $temp = new admin_settingpage('theme_academi_kair_footer', get_string('footerheading', 'theme_academi_kair'));

    /* Enable and Disable footer logo */
    $name = 'theme_academi_kair/footlogo';
    $title = get_string('enable', 'theme_academi_kair');
    $description = '';
    $default = '1';
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $temp->add($setting);

    /* Footer Content */
    $name = 'theme_academi_kair/footnote';
    $title = get_string('footnote', 'theme_academi_kair');
    $description = get_string('footnotedesc', 'theme_academi_kair');
    $default = get_string('footnotedefault', 'theme_academi_kair');
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // INFO Link.
    $name = 'theme_academi_kair/infolink';
    $title = get_string('infolink', 'theme_academi_kair');
    $description = get_string('infolink_desc', 'theme_academi_kair');
    $default = get_string('infolinkdefault', 'theme_academi_kair');
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $temp->add($setting);

    // Copyright.
    $name = 'theme_academi_kair/copyright_footer';
    $title = get_string('copyright_footer', 'theme_academi_kair');
    $description = '';
    $default = get_string('copyright_default', 'theme_academi_kair');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    /* Address , Email , Phone No */
    $name = 'theme_academi_kair/address';
    $title = get_string('address', 'theme_academi_kair');
    $description = '';
    $default = get_string('defaultaddress', 'theme_academi_kair');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $name = 'theme_academi_kair/emailid';
    $title = get_string('emailid', 'theme_academi_kair');
    $description = '';
    $default = get_string('defaultemailid', 'theme_academi_kair');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $name = 'theme_academi_kair/phoneno';
    $title = get_string('phoneno', 'theme_academi_kair');
    $description = '';
    $default = get_string('defaultphoneno', 'theme_academi_kair');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    /* Facebook, Pinterest, Twitter, Google+ Settings */
    $name = 'theme_academi_kair/fburl';
    $title = get_string('fburl', 'theme_academi_kair');
    $description = get_string('fburldesc', 'theme_academi_kair');
    $default = get_string('fburl_default', 'theme_academi_kair');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $name = 'theme_academi_kair/pinurl';
    $title = get_string('pinurl', 'theme_academi_kair');
    $description = get_string('pinurldesc', 'theme_academi_kair');
    $default = get_string('pinurl_default', 'theme_academi_kair');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $name = 'theme_academi_kair/twurl';
    $title = get_string('twurl', 'theme_academi_kair');
    $description = get_string('twurldesc', 'theme_academi_kair');
    $default = get_string('twurl_default', 'theme_academi_kair');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $name = 'theme_academi_kair/gpurl';
    $title = get_string('gpurl', 'theme_academi_kair');
    $description = get_string('gpurldesc', 'theme_academi_kair');
    $default = get_string('gpurl_default', 'theme_academi_kair');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $settings->add($temp);
     /*  Footer Settings end */
}
