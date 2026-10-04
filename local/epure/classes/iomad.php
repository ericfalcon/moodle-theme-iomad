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

namespace local_epure;

/**
 * Detection of IOMAD and access to the current company.
 *
 * IOMAD is optional: every method returns a neutral value on a standard Moodle site.
 *
 * @package    local_epure
 * @copyright  2026 Eric Falcon
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class iomad {
    /**
     * Whether IOMAD is installed on this site.
     *
     * IOMAD ships the local_iomad plugin, which defines the \iomad class.
     *
     * @return bool
     */
    public static function is_installed(): bool {
        global $CFG;
        if (class_exists('\iomad', false)) {
            return true;
        }
        return file_exists($CFG->dirroot . '/local/iomad/lib/iomad.php')
            && \core_plugin_manager::instance()->get_plugin_info('local_iomad') !== null;
    }

    /**
     * Identifier of the company of the current user, or 0 when there is none.
     *
     * @return int
     */
    public static function current_company_id(): int {
        global $CFG;
        if (!self::is_installed()) {
            return 0;
        }
        require_once($CFG->dirroot . '/local/iomad/lib/iomad.php');
        return (int) \iomad::get_my_companyid(\context_system::instance(), false);
    }
}
