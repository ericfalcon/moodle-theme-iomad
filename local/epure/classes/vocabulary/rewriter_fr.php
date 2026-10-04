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
 * Rewrites French strings.
 *
 * Replacing a word is not enough in French: « le cours » must become « la formation »,
 * « l'étudiant » « le stagiaire », « Tous les cours » « Toutes les formations », and
 * « cours masqué » « formation masquée ». The rewriter regenerates the determiner and
 * the adjective before the word, elides them when needed, and makes the adjective or
 * participle after the word agree when the gender changes.
 *
 * @package    local_epure
 * @copyright  2026 Eric Falcon
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class rewriter_fr extends rewriter {
    /** @var array<string, string[]> Singular and plural used by the French language pack, by object (all masculine). */
    public const SOURCES = [
        'course' => ['cours', 'cours'],
        'student' => ['étudiant', 'étudiants'],
        'teacher' => ['enseignant', 'enseignants'],
    ];

    /** @var array<string, string[]> English singular and plural, to tell whether « cours » is plural. */
    private const ENGLISH = [
        'course' => ['course', 'courses'],
        'student' => ['student', 'students'],
        'teacher' => ['teacher', 'teachers'],
    ];

    /** @var string Determiner and adjective just before the word. */
    private const BEFORE = "/(?<![\\p{L}])
        (?:(?P<tous>tous|toutes|tout|toute)\\s+)?
        (?:(?P<det>de\\s+la|de\\s+l['’]|à\\s+la|à\\s+l['’]|les|le|la|l['’]|du|des|aux|au|une|un|cette|cet|ces|ce
            |mes|mon|ma|tes|ton|ta|ses|son|sa|notre|nos|votre|vos|leurs|leur|chaque|quelles|quels|quelle|quel
            |aucune|aucun|de|d['’]|plusieurs|certaines|certains|quelques)(?P<sep>\\s+|(?<=['’])))?
        (?:(?P<adj>nouvelles|nouveaux|nouvelle|nouvel|nouveau|premières|premiers|première|premier
            |dernières|derniers|dernière|dernier|seules|seuls|seule|seul|anciennes|anciens|ancienne|ancien
            |autres|autre|mêmes|même)(?P<sep2>\\s+))?
        $/xiu";

    /** @var array<string, array{0: string, 1: bool|null}> Determiner => [kind, plural]. */
    private const DETERMINERS = [
        'le' => ['def', false], 'la' => ['def', false], "l'" => ['def', false], 'les' => ['def', true],
        'du' => ['ofdef', false], 'de la' => ['ofdef', false], "de l'" => ['ofdef', false], 'des' => ['ofdef', true],
        'au' => ['todef', false], 'à la' => ['todef', false], "à l'" => ['todef', false], 'aux' => ['todef', true],
        'un' => ['indef', false], 'une' => ['indef', false],
        'ce' => ['dem', false], 'cet' => ['dem', false], 'cette' => ['dem', false], 'ces' => ['dem', true],
        'mon' => ['m', false], 'ma' => ['m', false], 'mes' => ['m', true],
        'ton' => ['t', false], 'ta' => ['t', false], 'tes' => ['t', true],
        'son' => ['s', false], 'sa' => ['s', false], 'ses' => ['s', true],
        'notre' => ['notre', false], 'nos' => ['notre', true],
        'votre' => ['votre', false], 'vos' => ['votre', true],
        'leur' => ['leur', false], 'leurs' => ['leur', true],
        'chaque' => ['chaque', false],
        'quel' => ['quel', false], 'quelle' => ['quel', false], 'quels' => ['quel', true], 'quelles' => ['quel', true],
        'aucun' => ['aucun', false], 'aucune' => ['aucun', false],
        'de' => ['de', null], "d'" => ['de', null],
        'plusieurs' => ['plusieurs', true],
        'certains' => ['certain', true], 'certaines' => ['certain', true],
        'quelques' => ['quelques', true],
    ];

    /** @var array<string, string[]> Adjectives placed before the noun: masculine, masculine before a vowel, feminine, plurals. */
    private const ADJECTIVES = [
        'nouveau' => ['nouveau', 'nouvel', 'nouvelle', 'nouveaux', 'nouvelles'],
        'premier' => ['premier', 'premier', 'première', 'premiers', 'premières'],
        'dernier' => ['dernier', 'dernier', 'dernière', 'derniers', 'dernières'],
        'seul' => ['seul', 'seul', 'seule', 'seuls', 'seules'],
        'ancien' => ['ancien', 'ancien', 'ancienne', 'anciens', 'anciennes'],
        'autre' => ['autre', 'autre', 'autre', 'autres', 'autres'],
        'même' => ['même', 'même', 'même', 'mêmes', 'mêmes'],
    ];

    /** @var array<string, string> Adjectives after the noun whose feminine is not regular. */
    private const FEMININES = [
        'inscrit' => 'inscrite', 'actuel' => 'actuelle', 'suivant' => 'suivante', 'précédent' => 'précédente',
        'ouvert' => 'ouverte', 'complet' => 'complète', 'choisi' => 'choisie', 'fini' => 'finie',
        'défini' => 'définie', 'réussi' => 'réussie', 'suivi' => 'suivie', 'rempli' => 'remplie',
        'public' => 'publique', 'gratuit' => 'gratuite', 'prévu' => 'prévue',
    ];

    /**
     * Replaces the word of one object in plain text.
     *
     * @param string $text Plain text.
     * @param string $concept Object.
     * @param array $term New word (singular, plural, gender).
     * @param string $english English version of the whole string.
     * @return string
     */
    protected function rewrite_concept(string $text, string $concept, array $term, string $english): string {
        [$singular, $plural] = self::SOURCES[$concept];
        $forms = array_unique([$plural, $singular]);
        $pattern = '/(?<![\p{L}])(' . implode('|', $forms) . ')(?![\p{L}])/iu';
        if (!preg_match_all($pattern, $text, $matches, PREG_OFFSET_CAPTURE)) {
            return $text;
        }
        $feminine = $term['gender'] === 'f';

        // From the end, so that the offsets of the earlier matches stay valid.
        foreach (array_reverse($matches[1]) as [$word, $offset]) {
            $before = substr($text, 0, $offset);
            $after = substr($text, $offset + strlen($word));

            // The phrases « en cours » (in progress) and « au cours de » (during) are not about a course.
            if (
                $concept === 'course' && (preg_match('/(?<![\p{L}])en\s+$/iu', $before)
                    || (preg_match('/(?<![\p{L}])au\s+$/iu', $before) && preg_match('/^\s+d(?:e|u|es|[\'’])/iu', $after)))
            ) {
                continue;
            }

            preg_match(self::BEFORE, $before, $m);
            $tous = $m['tous'] ?? '';
            $det = $m['det'] ?? '';
            $adj = $m['adj'] ?? '';
            $detkey = str_replace('’', "'", preg_replace('/\s+/u', ' ', \core_text::strtolower($det)));
            [$kind, $detplural] = $det === '' ? [null, null] : self::DETERMINERS[$detkey];
            $adjlemma = $adj === '' ? null : self::adjective_lemma($adj);

            // Number: from the word itself, else from the words before it, else from the English string.
            $isplural = null;
            if ($singular !== $plural) {
                $isplural = \core_text::strtolower($word) === $plural;
            }
            $isplural ??= $detplural;
            if ($isplural === null && $adjlemma !== null) {
                $isplural = in_array(\core_text::strtolower($adj), array_slice(self::ADJECTIVES[$adjlemma], 3), true);
            }
            if ($isplural === null && $tous !== '') {
                $isplural = in_array(\core_text::strtolower($tous), ['tous', 'toutes'], true);
            }
            // In « Cours non commencés », an adjective that agrees after the word tells its number.
            if (
                $isplural === null && preg_match('/^\s+(?:(?:non|pas)\s+)?(\p{L}+)/iu', $after, $next)
                    && self::feminine($next[1]) !== null
            ) {
                $isplural = str_ends_with(\core_text::strtolower($next[1]), 's');
            }
            $isplural ??= self::english_number($english, ...self::ENGLISH[$concept]) ?? false;

            $noun = self::match_case($word, $isplural ? $term['plural'] : $term['singular']);
            $replacement = $noun;
            if ($adjlemma !== null) {
                $newadj = self::adjective($adjlemma, $isplural, $feminine, self::starts_with_vowel($noun));
                $replacement = self::match_case($adj, $newadj) . $m['sep2'] . $replacement;
            }
            if ($kind !== null) {
                $newdet = self::determiner($kind, $isplural, $feminine, self::starts_with_vowel($replacement));
                $sep = str_ends_with($newdet, "'") ? '' : ($m['sep'] !== '' ? $m['sep'] : ' ');
                $replacement = self::match_case($det, $newdet) . $sep . $replacement;
            }
            if ($tous !== '') {
                $newtous = $isplural ? ($feminine ? 'toutes' : 'tous') : ($feminine ? 'toute' : 'tout');
                $replacement = self::match_case($tous, $newtous) . ' ' . $replacement;
            }

            $start = strlen($before) - strlen($m[0] ?? '');
            $text = substr($before, 0, $start) . $replacement . ($feminine ? self::agree($after) : $after);
        }
        return $text;
    }

    /**
     * The lemma of an adjective placed before the noun.
     *
     * @param string $adj Adjective as written.
     * @return string|null
     */
    private static function adjective_lemma(string $adj): ?string {
        $adj = \core_text::strtolower($adj);
        foreach (self::ADJECTIVES as $lemma => $forms) {
            if (in_array($adj, $forms, true)) {
                return $lemma;
            }
        }
        return null;
    }

    /**
     * An adjective placed before the noun, agreed with it.
     *
     * @param string $lemma Lemma.
     * @param bool $plural Plural.
     * @param bool $feminine Feminine.
     * @param bool $vowel Whether the noun starts with a vowel.
     * @return string
     */
    private static function adjective(string $lemma, bool $plural, bool $feminine, bool $vowel): string {
        $forms = self::ADJECTIVES[$lemma];
        if ($plural) {
            return $feminine ? $forms[4] : $forms[3];
        }
        if ($feminine) {
            return $forms[2];
        }
        return $vowel ? $forms[1] : $forms[0];
    }

    /**
     * A determiner, agreed with the noun and elided before a vowel.
     *
     * @param string $kind Kind of determiner, see {@see self::DETERMINERS}.
     * @param bool $plural Plural.
     * @param bool $feminine Feminine.
     * @param bool $vowel Whether the next word starts with a vowel.
     * @return string
     */
    private static function determiner(string $kind, bool $plural, bool $feminine, bool $vowel): string {
        switch ($kind) {
            case 'def':
                return $plural ? 'les' : ($vowel ? "l'" : ($feminine ? 'la' : 'le'));
            case 'ofdef':
                return $plural ? 'des' : ($vowel ? "de l'" : ($feminine ? 'de la' : 'du'));
            case 'todef':
                return $plural ? 'aux' : ($vowel ? "à l'" : ($feminine ? 'à la' : 'au'));
            case 'indef':
                return $plural ? 'des' : ($feminine ? 'une' : 'un');
            case 'dem':
                return $plural ? 'ces' : ($feminine ? 'cette' : ($vowel ? 'cet' : 'ce'));
            case 'm':
            case 't':
            case 's':
                return $kind . ($plural ? 'es' : ($feminine && !$vowel ? 'a' : 'on'));
            case 'notre':
                return $plural ? 'nos' : 'notre';
            case 'votre':
                return $plural ? 'vos' : 'votre';
            case 'leur':
                return $plural ? 'leurs' : 'leur';
            case 'quel':
                return 'quel' . ($feminine ? 'le' : '') . ($plural ? 's' : '');
            case 'aucun':
                return $feminine ? 'aucune' : 'aucun';
            case 'de':
                return $vowel ? "d'" : 'de';
            case 'certain':
                return $feminine ? 'certaines' : 'certains';
            default:
                return $kind;
        }
    }

    /**
     * Makes the adjective or participle right after a noun that became feminine agree with it.
     *
     * @param string $after Text after the noun.
     * @return string
     */
    private static function agree(string $after): string {
        $patterns = [
            // After être: « est masqué », « a été créé », « n'est pas visible ».
            "/^(\\s+(?:n['’])?(?:est|sont|sera|seront|était|étaient|soit|soient|a\\s+été|ont\\s+été|avait\\s+été|avaient\\s+été)"
                . "(?:\\s+(?:pas|plus|bien|déjà|encore|toujours|automatiquement|correctement))*\\s+)(\\p{L}+)/iu",
            // Right after the noun: « masqué », « non commencés ».
            '/^(\s+(?:(?:non|pas|déjà|bien)\s+)?)(\p{L}+)/iu',
        ];
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $after, $m) && ($feminine = self::feminine($m[2])) !== null) {
                return $m[1] . self::match_case($m[2], $feminine) . substr($after, strlen($m[0]));
            }
        }
        return $after;
    }

    /**
     * The feminine of an adjective or past participle.
     *
     * @param string $word Masculine word.
     * @return string|null Null when the word is not an adjective that changes.
     */
    private static function feminine(string $word): ?string {
        $lower = \core_text::strtolower($word);
        $plural = str_ends_with($lower, 's');
        $base = $plural ? substr($lower, 0, -1) : $lower;
        if (isset(self::FEMININES[$base])) {
            return self::FEMININES[$base] . ($plural ? 's' : '');
        }
        if (str_ends_with($base, 'é')) {
            return $base . 'e' . ($plural ? 's' : '');
        }
        if (str_ends_with($base, 'if') && \core_text::strlen($base) > 3) {
            return substr($base, 0, -1) . 've' . ($plural ? 's' : '');
        }
        return null;
    }
}
