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
 * Rewrites a language string with the words chosen by the administrator.
 *
 * Placeholders ({$a}, {$a->name}), HTML tags, entities and addresses are never changed.
 *
 * @package    local_epure
 * @copyright  2026 Eric Falcon
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class rewriter {
    /** @var string Parts of a string that must be kept as they are. */
    private const PROTECTED = '/(\{[^{}]*\}|<[^<>]*>|&[a-z0-9#]+;|https?:\/\/[^\s"<>]+|\$a(?:->\w+)?)/iu';

    /** @var array<string, array<string, string>> Words that replace those of the language pack, by object. */
    protected array $targets;

    /**
     * Constructor.
     *
     * @param array $targets Terms by object (object => term), see {@see terms}.
     */
    public function __construct(array $targets) {
        $this->targets = $targets;
    }

    /**
     * The rewriter for a language.
     *
     * @param string $lang Language code.
     * @param array $targets Terms by object (object => term).
     * @return rewriter|null Null when the language is not supported.
     */
    public static function for_language(string $lang, array $targets): ?rewriter {
        return match ($lang) {
            'fr' => new rewriter_fr($targets),
            'en' => new rewriter_en($targets),
            default => null,
        };
    }

    /**
     * Rewrites a string.
     *
     * @param string $text The string in the language pack.
     * @param string $english The same string in English, which tells whether an ambiguous word is plural.
     * @return string|null The new string, or null when nothing changes.
     */
    public function rewrite(string $text, string $english = ''): ?string {
        if (!$this->targets || $text === '') {
            return null;
        }
        $parts = preg_split(self::PROTECTED, $text, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($parts as $i => $part) {
            // Even indexes are plain text, odd ones the protected parts.
            if ($i % 2 === 0 && $part !== '') {
                foreach ($this->targets as $concept => $term) {
                    $part = $this->rewrite_concept($part, $concept, $term, $english);
                }
                $parts[$i] = $part;
            }
        }
        $result = implode('', $parts);
        return $result === $text ? null : $result;
    }

    /**
     * Replaces the word of one object in plain text.
     *
     * @param string $text Plain text.
     * @param string $concept Object.
     * @param array $term New word (singular, plural, gender).
     * @param string $english English version of the whole string.
     * @return string
     */
    abstract protected function rewrite_concept(string $text, string $concept, array $term, string $english): string;

    /**
     * Gives a word the case of another one: capitalised, upper case or unchanged.
     *
     * @param string $model Word whose case is copied.
     * @param string $word Word to change, in lower case.
     * @return string
     */
    protected static function match_case(string $model, string $word): string {
        if ($model === '' || $word === '') {
            return $word;
        }
        if (\core_text::strlen($model) > 1 && \core_text::strtoupper($model) === $model) {
            return \core_text::strtoupper($word);
        }
        $first = \core_text::substr($model, 0, 1);
        if (\core_text::strtoupper($first) === $first && \core_text::strtolower($first) !== $first) {
            return \core_text::strtoupper(\core_text::substr($word, 0, 1)) . \core_text::substr($word, 1);
        }
        return $word;
    }

    /**
     * Whether the word begins with a vowel sound (a, e, i, o, u, y, with or without accent).
     *
     * @param string $word Word.
     * @return bool
     */
    protected static function starts_with_vowel(string $word): bool {
        return (bool) preg_match('/^[aeiouyàâäéèêëîïôöûüœæ]/iu', $word);
    }

    /**
     * Whether the English string uses the word in the plural only.
     *
     * @param string $english English string.
     * @param string $singular English singular, for example course.
     * @param string $plural English plural, for example courses.
     * @return bool|null True for plural, false for singular, null when unknown.
     */
    protected static function english_number(string $english, string $singular, string $plural): ?bool {
        $hasplural = preg_match('/(?<![\p{L}])' . preg_quote($plural, '/') . '(?![\p{L}])/iu', $english);
        $hassingular = preg_match('/(?<![\p{L}])' . preg_quote($singular, '/') . '(?![\p{L}])/iu', $english);
        if ($hasplural && !$hassingular) {
            return true;
        }
        if ($hassingular && !$hasplural) {
            return false;
        }
        return null;
    }
}
