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
 * Upgrade steps for local_epure.
 *
 * @package    local_epure
 * @copyright  2026 Eric Falcon
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Upgrades the plugin.
 *
 * @param int $oldversion Version installed before the upgrade.
 * @return bool
 */
function xmldb_local_epure_upgrade($oldversion) {
    global $DB;
    $dbman = $DB->get_manager();

    if ($oldversion < 2026100500) {
        $table = new xmldb_table('local_epure_vocab');
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('lang', XMLDB_TYPE_CHAR, '30', null, XMLDB_NOTNULL, null, null);
        $table->add_field('component', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->add_field('stringid', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->add_field('value', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
        $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_index('langcomponent', XMLDB_INDEX_NOTUNIQUE, ['lang', 'component']);
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        upgrade_plugin_savepoint(true, 2026100500, 'local', 'epure');
    }

    if ($oldversion < 2026100700) {
        // The vocabulary of the platform moved to the theme, which copied the words and the strings
        // (theme_epure upgrade to 2026100600). The words for companies and departments chosen for
        // the whole platform become the words of all companies, applied by the string manager.
        $config = get_config('local_epure');
        $platform = [];
        $iomadwords = false;
        foreach ($config as $name => $value) {
            $pattern = '/^vocab_(fr|en)_(course|student|teacher|company|department)(_singular|_plural|_gender)?$/';
            if (!preg_match($pattern, $name, $m)) {
                continue;
            }
            if (in_array($m[2], ['company', 'department'], true)) {
                $platform[$name] = $value;
                $iomadwords = $iomadwords || ($m[3] === '' && $value !== \theme_epure\vocabulary\terms::DEFAULTS[$m[1]][$m[2]]);
            }
            unset_config($name, 'local_epure');
        }
        if ($iomadwords && !get_config('local_epure', 'company_0')) {
            \local_epure\vocabulary\company::save(0, $platform);
        }

        if ($dbman->table_exists('local_epure_vocab')) {
            $dbman->drop_table(new xmldb_table('local_epure_vocab'));
        }

        // The strings with company words written in the language pack by local_epure 0.3 are removed
        // by applying the vocabulary of the theme again, which no longer includes them.
        if ($iomadwords) {
            foreach (\theme_epure\vocabulary\manager::languages() as $lang) {
                \theme_epure\vocabulary\manager::apply($lang);
            }
        }

        upgrade_plugin_savepoint(true, 2026100700, 'local', 'epure');
    }

    return true;
}
