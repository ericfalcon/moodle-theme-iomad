<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Admin settings for local_epure.
 *
 * @package    local_epure
 * @copyright  2026 Eric Falcon
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $ADMIN->add('localplugins', new admin_category('local_epure_category', get_string('pluginname', 'local_epure')));

    $settings = new admin_settingpage('local_epure', get_string('status', 'local_epure'));
    if ($ADMIN->fulltree) {
        $status = \local_epure\iomad::is_installed()
            ? get_string('iomaddetected', 'local_epure')
            : get_string('iomadnotdetected', 'local_epure');
        $settings->add(new admin_setting_heading(
            'local_epure/status',
            get_string('status', 'local_epure'),
            html_writer::tag('p', $status)
        ));
    }
    $ADMIN->add('local_epure_category', $settings);

    $ADMIN->add('local_epure_category', new admin_externalpage(
        'local_epure_vocabulary',
        get_string('vocabulary', 'local_epure'),
        new moodle_url('/local/epure/vocabulary.php')
    ));

    if (\local_epure\iomad::is_installed()) {
        $ADMIN->add('local_epure_category', new admin_externalpage(
            'local_epure_companyvocabulary',
            get_string('companyvocabulary', 'local_epure'),
            new moodle_url('/local/epure/company_vocabulary.php')
        ));
    }
}
