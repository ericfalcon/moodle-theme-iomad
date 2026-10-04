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

namespace local_epure\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

use local_epure\vocabulary\manager;
use local_epure\vocabulary\terms;

/**
 * Choice of the words used for courses, students and teachers, in each language.
 *
 * @package    local_epure
 * @copyright  2026 Eric Falcon
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class vocabulary_form extends \moodleform {
    /**
     * Form definition.
     */
    protected function definition() {
        $mform = $this->_form;
        $translations = get_string_manager()->get_list_of_translations(true);
        $presets = terms::presets();

        foreach (manager::languages() as $lang) {
            $mform->addElement('header', 'lang_' . $lang, $translations[$lang]);
            $mform->setExpanded('lang_' . $lang);

            foreach (terms::CONCEPTS as $concept) {
                $name = terms::setting($lang, $concept);
                $options = [];
                foreach ($presets[$lang][$concept] as $key => $term) {
                    $options[$key] = $term['singular'] === $term['plural']
                        ? $term['singular']
                        : $term['singular'] . ' / ' . $term['plural'];
                }
                $options[terms::CUSTOM] = get_string('vocabcustom', 'local_epure');
                $mform->addElement('select', $name, get_string('vocab_' . $concept, 'local_epure'), $options);
                $mform->setDefault($name, get_config('local_epure', $name) ?: terms::DEFAULTS[$lang][$concept]);

                foreach (['singular', 'plural'] as $form) {
                    $field = terms::setting($lang, $concept, $form);
                    $mform->addElement('text', $field, get_string('vocab' . $form, 'local_epure'), ['size' => 24]);
                    $mform->setType($field, PARAM_TEXT);
                    $mform->setDefault($field, (string) get_config('local_epure', $field));
                    $mform->hideIf($field, $name, 'neq', terms::CUSTOM);
                }
                if ($lang === 'fr') {
                    $field = terms::setting($lang, $concept, 'gender');
                    $mform->addElement('select', $field, get_string('vocabgender', 'local_epure'), [
                        'm' => get_string('vocabmasculine', 'local_epure'),
                        'f' => get_string('vocabfeminine', 'local_epure'),
                    ]);
                    $mform->setDefault($field, get_config('local_epure', $field) ?: 'm');
                    $mform->hideIf($field, $name, 'neq', terms::CUSTOM);
                }
            }
        }

        $buttons = [
            $mform->createElement('submit', 'submitbutton', get_string('vocabapply', 'local_epure')),
            $mform->createElement('submit', 'resetbutton', get_string('vocabreset', 'local_epure'), [], false),
        ];
        $mform->addGroup($buttons, 'buttonar', '', ' ', false);
        $mform->closeHeaderBefore('buttonar');
    }

    /**
     * Validation: a custom word needs at least its singular.
     *
     * @param array $data Submitted data.
     * @param array $files Submitted files.
     * @return array Errors.
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);
        if (!empty($data['resetbutton'])) {
            return $errors;
        }
        foreach (manager::languages() as $lang) {
            foreach (terms::CONCEPTS as $concept) {
                $singular = terms::setting($lang, $concept, 'singular');
                if (($data[terms::setting($lang, $concept)] ?? '') === terms::CUSTOM && trim($data[$singular] ?? '') === '') {
                    $errors[$singular] = get_string('required');
                }
            }
        }
        return $errors;
    }
}
