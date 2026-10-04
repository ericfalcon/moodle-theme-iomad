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
 * Tests for IOMAD detection.
 *
 * @package    local_epure
 * @category   test
 * @copyright  2026 Eric Falcon
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers     \local_epure\iomad
 */
#[\PHPUnit\Framework\Attributes\CoversClass(iomad::class)]
final class iomad_test extends \advanced_testcase {
    /**
     * On a site without IOMAD, detection is negative and there is no company.
     */
    public function test_without_iomad(): void {
        global $CFG;
        if (file_exists($CFG->dirroot . '/local/iomad/lib/iomad.php')) {
            $this->markTestSkipped('IOMAD is installed on this site.');
        }
        $this->resetAfterTest();
        $this->setAdminUser();
        $this->assertFalse(iomad::is_installed());
        $this->assertSame(0, iomad::current_company_id());
    }
}
