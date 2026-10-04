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
 * English strings for local_epure.
 *
 * @package    local_epure
 * @copyright  2026 Eric Falcon
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['cachedef_companystrings'] = 'Strings with the words of an IOMAD company';
$string['companyvocabchoose'] = 'Choose a company…';
$string['companyvocabcompany'] = 'Company';
$string['companyvocabintro'] = 'Each company can have its own words for « company » and « department ». They apply to the users of the company, and to the administrator who selected it in the IOMAD dashboard, on every page. Without its own words, a company uses those of the platform (Vocabulary page).';
$string['companyvocablist'] = 'Companies with their own words';
$string['companyvocabreset'] = 'Use the words of the platform';
$string['companyvocabsaved'] = 'The vocabulary of {$a} is saved.';
$string['companyvocabulary'] = 'Vocabulary of the companies';
$string['companyvocabunavailable'] = 'config.php sets another custom string manager ($CFG->customstringmanager): the vocabulary of the companies cannot be applied. Remove that line, or contact the developer of that string manager.';
$string['companyvocabwords'] = 'Words';
$string['iomaddetected'] = 'IOMAD is installed: company features (dashboard, per-company colour, logo and vocabulary) will be available.';
$string['iomadnotdetected'] = 'IOMAD is not installed: company features are hidden. The vocabulary features work on any Moodle site.';
$string['pluginname'] = 'Épure tools';
$string['privacy:metadata'] = 'The Épure tools plugin does not store any personal data.';
$string['status'] = 'Status';
$string['vocab_company'] = 'Companies are called';
$string['vocab_course'] = 'Courses are called';
$string['vocab_department'] = 'Departments are called';
$string['vocab_student'] = 'Students are called';
$string['vocab_teacher'] = 'Teachers are called';
$string['vocabafter'] = 'With your vocabulary';
$string['vocabapplied'] = '{$a->total} strings use your vocabulary ({$a->changed} changed now).';
$string['vocabapply'] = 'Save and apply';
$string['vocabbefore'] = 'Moodle wording';
$string['vocabcustom'] = 'Other word…';
$string['vocabexamples'] = '{$a->lang}: {$a->count} strings use your vocabulary. Examples:';
$string['vocabfeminine'] = 'Feminine';
$string['vocabgender'] = 'Gender';
$string['vocabintro'] = 'Choose the words used for courses, students and teachers (and, with IOMAD, companies and departments). They replace Moodle\'s wording everywhere: menus, dashboard, course lists, participants, roles, reports, notifications, and the pages of plugins and IOMAD. In French, articles and agreements follow the word you choose. The strings are written with Moodle\'s language customisation tool: the customisations you made there yourself are kept, and you can still edit each string. Applying takes a few seconds, and about twenty seconds the first time for each language.';
$string['vocabkept'] = '{$a} strings you customised yourself in the language customisation tool were left unchanged.';
$string['vocabmasculine'] = 'Masculine';
$string['vocabnolanguage'] = 'None of the supported languages (French, English) is installed.';
$string['vocabnone'] = 'Moodle\'s wording is used.';
$string['vocabplatform'] = 'Same as the platform ({$a})';
$string['vocabplural'] = 'Plural';
$string['vocabreset'] = 'Restore Moodle\'s wording';
$string['vocabsingular'] = 'Singular';
$string['vocabulary'] = 'Vocabulary';
