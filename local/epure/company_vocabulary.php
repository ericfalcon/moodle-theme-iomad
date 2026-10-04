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
 * Vocabulary of each IOMAD company: the words used for « company » and « department ».
 *
 * @package    local_epure
 * @copyright  2026 Eric Falcon
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');

use local_epure\vocabulary\company;
use theme_epure\form\vocabulary_form;
use theme_epure\vocabulary\manager;
use theme_epure\vocabulary\terms;

// Company to edit: 0 for all companies (the platform), -1 for none.
$companyid = optional_param('companyid', -1, PARAM_INT);

admin_externalpage_setup('local_epure_companyvocabulary');
$pageurl = new moodle_url('/local/epure/company_vocabulary.php');

if (!\local_epure\iomad::is_installed()) {
    echo $OUTPUT->header();
    echo $OUTPUT->heading(get_string('companyvocabulary', 'local_epure'));
    echo $OUTPUT->notification(get_string('iomadnotdetected', 'local_epure'), 'info', false);
    echo $OUTPUT->footer();
    die();
}

$companies = [0 => get_string('companyvocabplatform', 'local_epure')]
    + array_map('format_string', $DB->get_records_menu('company', null, 'name', 'id, name'));
if (!isset($companies[$companyid])) {
    $companyid = -1;
}

$form = null;
if ($companyid >= 0) {
    $form = new vocabulary_form(new moodle_url($pageurl, ['companyid' => $companyid]), [
        'concepts' => terms::IOMAD_CONCEPTS,
        'values' => company::values($companyid),
        'companyid' => $companyid,
        'resetlabel' => get_string('companyvocabreset', 'local_epure'),
    ]);
    if ($data = $form->get_data()) {
        company::save($companyid, vocabulary_form::values_from($data, terms::IOMAD_CONCEPTS, true));
        redirect(
            new moodle_url($pageurl, ['companyid' => $companyid]),
            get_string('companyvocabsaved', 'local_epure', format_string($companies[$companyid])),
            null,
            \core\output\notification::NOTIFY_SUCCESS
        );
    }
}

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('companyvocabulary', 'local_epure'));
echo html_writer::tag('p', get_string('companyvocabintro', 'local_epure'));

if (!\local_epure\hook_callbacks::string_manager_available()) {
    echo $OUTPUT->notification(get_string('companyvocabunavailable', 'local_epure'), 'warning', false);
}

// Companies that have their own words.
$languages = manager::languages();
$rows = [];
foreach (company::ids() as $id) {
    if (!isset($companies[$id])) {
        continue;
    }
    $words = [];
    foreach ($languages as $lang) {
        foreach (company::chosen($id, $lang) as $term) {
            $words[] = $term['plural'];
        }
    }
    $link = html_writer::link(new moodle_url($pageurl, ['companyid' => $id]), $companies[$id]);
    $rows[] = [$link, s(implode(', ', array_unique($words)))];
}
if ($rows) {
    $table = new html_table();
    $table->caption = get_string('companyvocablist', 'local_epure');
    $table->head = [get_string('companyvocabcompany', 'local_epure'), get_string('companyvocabwords', 'local_epure')];
    $table->attributes['class'] = 'generaltable w-auto';
    $table->data = $rows;
    echo html_writer::table($table);
}

$select = new single_select(
    $pageurl,
    'companyid',
    array_map('format_string', $companies),
    $companyid,
    ['' => get_string('companyvocabchoose', 'local_epure')]
);
$select->set_label(get_string('companyvocabcompany', 'local_epure'));
echo $OUTPUT->render($select);

if ($form) {
    echo $OUTPUT->heading($companies[$companyid], 3);
    $form->display();
}

echo $OUTPUT->footer();
