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

namespace local_epure\vocabulary;

/**
 * The words the administrator can choose for the objects of the platform.
 *
 * A term is an array with the keys singular, plural and gender ('m' or 'f', used in French).
 *
 * @package    local_epure
 * @copyright  2026 Eric Falcon
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class terms {
    /** @var string[] Objects whose name can be chosen. */
    public const CONCEPTS = ['course', 'student', 'teacher'];

    /** @var string[] Languages the vocabulary can be rewritten in. */
    public const LANGUAGES = ['fr', 'en'];

    /** @var string Choice of a word typed by the administrator. */
    public const CUSTOM = 'custom';

    /** @var array<string, array<string, string>> Key of the word used by the language pack, by language and object. */
    public const DEFAULTS = [
        'fr' => ['course' => 'cours', 'student' => 'etudiant', 'teacher' => 'enseignant'],
        'en' => ['course' => 'course', 'student' => 'student', 'teacher' => 'teacher'],
    ];

    /**
     * Words proposed for each object, by language.
     *
     * @return array<string, array<string, array<string, array<string, string>>>> language => object => key => term.
     */
    public static function presets(): array {
        $t = fn(string $singular, string $plural, string $gender = 'm') => compact('singular', 'plural', 'gender');
        return [
            'fr' => [
                'course' => [
                    'cours' => $t('cours', 'cours'),
                    'formation' => $t('formation', 'formations', 'f'),
                    'parcours' => $t('parcours', 'parcours'),
                    'module' => $t('module', 'modules'),
                ],
                'student' => [
                    'etudiant' => $t('étudiant', 'étudiants'),
                    'apprenant' => $t('apprenant', 'apprenants'),
                    'stagiaire' => $t('stagiaire', 'stagiaires'),
                    'participant' => $t('participant', 'participants'),
                    'collaborateur' => $t('collaborateur', 'collaborateurs'),
                ],
                'teacher' => [
                    'enseignant' => $t('enseignant', 'enseignants'),
                    'formateur' => $t('formateur', 'formateurs'),
                    'tuteur' => $t('tuteur', 'tuteurs'),
                    'intervenant' => $t('intervenant', 'intervenants'),
                    'professeur' => $t('professeur', 'professeurs'),
                    'coach' => $t('coach', 'coachs'),
                ],
            ],
            'en' => [
                'course' => [
                    'course' => $t('course', 'courses'),
                    'program' => $t('program', 'programs'),
                    'programme' => $t('programme', 'programmes'),
                    'module' => $t('module', 'modules'),
                    'class' => $t('class', 'classes'),
                    'learningpath' => $t('learning path', 'learning paths'),
                ],
                'student' => [
                    'student' => $t('student', 'students'),
                    'learner' => $t('learner', 'learners'),
                    'trainee' => $t('trainee', 'trainees'),
                    'participant' => $t('participant', 'participants'),
                    'employee' => $t('employee', 'employees'),
                ],
                'teacher' => [
                    'teacher' => $t('teacher', 'teachers'),
                    'trainer' => $t('trainer', 'trainers'),
                    'tutor' => $t('tutor', 'tutors'),
                    'instructor' => $t('instructor', 'instructors'),
                    'facilitator' => $t('facilitator', 'facilitators'),
                    'coach' => $t('coach', 'coaches'),
                ],
            ],
        ];
    }

    /**
     * Name of the setting that stores a choice.
     *
     * @param string $lang Language.
     * @param string $concept Object.
     * @param string $suffix Empty for the choice, or singular, plural, gender for a custom word.
     * @return string
     */
    public static function setting(string $lang, string $concept, string $suffix = ''): string {
        return "vocab_{$lang}_{$concept}" . ($suffix === '' ? '' : "_{$suffix}");
    }

    /**
     * The word chosen for an object, when it differs from the one of the language pack.
     *
     * @param string $lang Language.
     * @param string $concept Object.
     * @return array<string, string>|null The term, or null to keep the language pack wording.
     */
    public static function chosen(string $lang, string $concept): ?array {
        $choice = (string) get_config('local_epure', self::setting($lang, $concept));
        if ($choice === '' || $choice === self::DEFAULTS[$lang][$concept]) {
            return null;
        }
        if ($choice === self::CUSTOM) {
            $singular = trim((string) get_config('local_epure', self::setting($lang, $concept, 'singular')));
            $plural = trim((string) get_config('local_epure', self::setting($lang, $concept, 'plural')));
            $gender = get_config('local_epure', self::setting($lang, $concept, 'gender')) === 'f' ? 'f' : 'm';
            if ($singular === '') {
                return null;
            }
            return ['singular' => $singular, 'plural' => $plural === '' ? $singular : $plural, 'gender' => $gender];
        }
        return self::presets()[$lang][$concept][$choice] ?? null;
    }

    /**
     * The words chosen in a language, for the objects whose wording changes.
     *
     * @param string $lang Language.
     * @return array<string, array<string, string>> object => term.
     */
    public static function chosen_all(string $lang): array {
        $targets = [];
        foreach (self::CONCEPTS as $concept) {
            if ($term = self::chosen($lang, $concept)) {
                $targets[$concept] = $term;
            }
        }
        return $targets;
    }
}
