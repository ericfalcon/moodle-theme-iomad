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
 * Rewrites English strings: the word, its plural, and the article a or an before it.
 *
 * @package    local_epure
 * @copyright  2026 Eric Falcon
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class rewriter_en extends rewriter {
    /** @var array<string, string[]> Singular and plural used by Moodle, by object. */
    public const SOURCES = [
        'course' => ['course', 'courses'],
        'student' => ['student', 'students'],
        'teacher' => ['teacher', 'teachers'],
    ];

    /**
     * Replaces the word of one object in plain text.
     *
     * @param string $text Plain text.
     * @param string $concept Object.
     * @param array<string, string> $term New word.
     * @param string $english English version of the whole string.
     * @return string
     */
    protected function rewrite_concept(string $text, string $concept, array $term, string $english): string {
        [$singular, $plural] = self::SOURCES[$concept];
        $pattern = '/(?<![\p{L}])(' . $plural . '|' . $singular . ')(?![\p{L}])/iu';
        if (!preg_match_all($pattern, $text, $matches, PREG_OFFSET_CAPTURE)) {
            return $text;
        }
        // From the end, so that the offsets of the earlier matches stay valid.
        foreach (array_reverse($matches[1]) as [$word, $offset]) {
            $before = substr($text, 0, $offset);
            $after = substr($text, $offset + strlen($word));
            $isplural = \core_text::strtolower($word) === $plural;

            // The phrase "of course" is not about a course.
            if (!$isplural && $concept === 'course' && preg_match('/(?<![\p{L}])of\s+$/iu', $before)) {
                continue;
            }

            $new = self::match_case($word, $isplural ? $term['plural'] : $term['singular']);
            if (!$isplural && preg_match('/(?<![\p{L}])(an?)(\s+)$/iu', $before, $article, PREG_OFFSET_CAPTURE)) {
                $a = self::starts_with_vowel($new) ? 'an' : 'a';
                $before = substr($before, 0, $article[1][1]) . self::match_case($article[1][0], $a) . $article[2][0];
            }
            $text = $before . $new . $after;
        }
        return $text;
    }
}
