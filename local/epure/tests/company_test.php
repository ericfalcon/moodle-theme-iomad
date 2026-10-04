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

use local_epure\vocabulary\company;
use local_epure\vocabulary\terms;

#[\PHPUnit\Framework\Attributes\CoversClass(vocabulary\company::class)]
#[\PHPUnit\Framework\Attributes\CoversClass(string_manager::class)]
#[\PHPUnit\Framework\Attributes\CoversClass(hook_callbacks::class)]
/**
 * Tests for the vocabulary of IOMAD companies.
 *
 * @package    local_epure
 * @category   test
 * @copyright  2026 Eric Falcon
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers     \local_epure\vocabulary\company
 * @covers     \local_epure\string_manager
 * @covers     \local_epure\hook_callbacks
 */
final class company_test extends \advanced_testcase {
    /**
     * Saving the words of a company, and going back to the words of the platform.
     */
    public function test_save(): void {
        $this->resetAfterTest();
        $this->assertFalse(company::active());

        company::save(7, [terms::setting('en', 'company') => 'client', terms::setting('en', 'department') => '']);
        $this->assertTrue(company::active());
        $this->assertSame([7], company::ids());
        $this->assertSame(['company' => terms::presets()['en']['company']['client']], company::chosen(7, 'en'));
        $this->assertSame([], company::chosen(7, 'fr'));

        // For a company, the word of the language pack is a choice: it can differ from the word of the platform.
        set_config(terms::setting('en', 'company'), 'organisation', 'local_epure');
        company::save(8, [terms::setting('en', 'company') => 'company']);
        $this->assertSame([7, 8], company::ids());
        $this->assertSame('Edit company', company::rewriter(8, 'en')->rewrite('Edit organisation'));

        // No choice left: the company uses the words of the platform.
        company::save(7, [terms::setting('en', 'company') => '']);
        $this->assertSame([8], company::ids());
        $this->assertNull(company::rewriter(7, 'en'));
    }

    /**
     * The string manager applies the words of the company of the user, on top of the language pack.
     */
    public function test_string_manager(): void {
        global $CFG;
        $this->resetAfterTest();
        company::save(7, [terms::setting('en', 'course') => '', terms::setting('en', 'company') => 'client']);

        $manager = new class ($CFG->langotherroot, $CFG->langlocalroot, []) extends string_manager {
            /** @var int Company of the user in the test. */
            public int $fakecompany = 7;

            /**
             * Company of the user in the test.
             *
             * @return int
             */
            protected function company_id(): int {
                return $this->fakecompany;
            }
        };
        // Strings without the words of the company do not change.
        $this->assertSame('Add a new course', $manager->get_string('addnewcourse', 'moodle', null, 'en'));

        // A string of this plugin mentions companies: the IOMAD strings are not installed on standard Moodle.
        $this->assertStringContainsString('client', $manager->get_string('iomaddetected', 'local_epure', null, 'en'));
        $this->assertStringNotContainsString('company', $manager->get_string('iomaddetected', 'local_epure', null, 'en'));

        // A user without company sees the words of the platform.
        $manager->fakecompany = 0;
        $this->assertStringContainsString('company', $manager->get_string('iomaddetected', 'local_epure', null, 'en'));
    }

    /**
     * Without IOMAD, the string manager of Moodle is kept.
     */
    public function test_after_config_without_iomad(): void {
        global $CFG;
        if (file_exists($CFG->dirroot . '/local/iomad/lib/iomad.php')) {
            $this->markTestSkipped('IOMAD is installed on this site.');
        }
        $this->resetAfterTest();
        company::save(7, [terms::setting('en', 'company') => 'client']);
        hook_callbacks::after_config(new \core\hook\after_config());
        $this->assertArrayNotHasKey('customstringmanager', $CFG->config_php_settings);
        $this->assertTrue(hook_callbacks::string_manager_available());
    }
}
