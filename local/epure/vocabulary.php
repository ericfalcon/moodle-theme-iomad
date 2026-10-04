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
 * Vocabulary of the platform: the words used for courses, students and teachers.
 *
 * @package    local_epure
 * @copyright  2026 Eric Falcon
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Shows the progress of the first preparation of a language.
define('NO_OUTPUT_BUFFERING', true);

require(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');

use local_epure\vocabulary\manager;
use local_epure\vocabulary\terms;

admin_externalpage_setup('local_epure_vocabulary');

$pageurl = new moodle_url('/local/epure/vocabulary.php');
$form = new \local_epure\form\vocabulary_form($pageurl);
$translations = get_string_manager()->get_list_of_translations(true);

if ($data = $form->get_data()) {
    $reset = !empty($data->resetbutton);
    foreach (manager::languages() as $lang) {
        foreach (terms::CONCEPTS as $concept) {
            $name = terms::setting($lang, $concept);
            set_config($name, $reset ? terms::DEFAULTS[$lang][$concept] : $data->$name, 'local_epure');
            foreach (['singular', 'plural', 'gender'] as $suffix) {
                $field = terms::setting($lang, $concept, $suffix);
                if (isset($data->$field)) {
                    set_config($field, trim($data->$field), 'local_epure');
                }
            }
        }
    }

    echo $OUTPUT->header();
    echo $OUTPUT->heading(get_string('vocabulary', 'local_epure'));
    foreach (manager::languages() as $lang) {
        echo $OUTPUT->heading($translations[$lang], 3);
        $progress = new progress_bar('local_epure_vocab_' . $lang, 500, true);
        $stats = manager::apply($lang, $progress);
        $message = $stats['total']
            ? get_string('vocabapplied', 'local_epure', (object) $stats)
            : get_string('vocabnone', 'local_epure');
        echo $OUTPUT->notification($message, 'success', false);
        if ($stats['kept']) {
            echo $OUTPUT->notification(get_string('vocabkept', 'local_epure', $stats['kept']), 'info', false);
        }
    }
    echo $OUTPUT->continue_button($pageurl);
    echo $OUTPUT->footer();
    die();
}

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('vocabulary', 'local_epure'));
echo html_writer::tag('p', get_string('vocabintro', 'local_epure'));

$languages = manager::languages();
if (!$languages) {
    echo $OUTPUT->notification(get_string('vocabnolanguage', 'local_epure'), 'warning', false);
}
foreach ($languages as $lang) {
    $examples = manager::examples($lang);
    if (!$examples) {
        continue;
    }
    $table = new html_table();
    $table->caption = get_string('vocabexamples', 'local_epure', (object) [
        'lang' => $translations[$lang],
        'count' => manager::count($lang),
    ]);
    $table->head = [get_string('vocabbefore', 'local_epure'), get_string('vocabafter', 'local_epure')];
    $table->attributes['class'] = 'generaltable w-auto';
    foreach ($examples as $example) {
        $table->data[] = [s($example['before']), s($example['after'])];
    }
    echo html_writer::table($table);
}

$form->display();
echo $OUTPUT->footer();
