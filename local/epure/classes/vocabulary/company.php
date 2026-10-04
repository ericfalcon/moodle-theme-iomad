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
 * Vocabulary of each IOMAD company: the words used for « company » and « department ».
 *
 * Language packs are shared by the whole site, so the words of a company cannot be written in
 * them. They are applied when the strings are loaded, by {@see \local_epure\string_manager},
 * for the users of the company and for the administrator who selected it.
 *
 * The choices of a company are stored in the plugin settings, as company_<id> (JSON, same
 * setting names as the platform vocabulary), and the list of companies with their own words
 * as companies.
 *
 * @package    local_epure
 * @copyright  2026 Eric Falcon
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class company {
    /** @var array<int, array<string, ?rewriter>> Rewriters of the request, by company and language. */
    private static array $rewriters = [];

    /**
     * Whether at least one company has its own words.
     *
     * @return bool
     */
    public static function active(): bool {
        return (string) get_config('local_epure', 'companies') !== '';
    }

    /**
     * Identifiers of the companies that have their own words.
     *
     * @return int[]
     */
    public static function ids(): array {
        $ids = (string) get_config('local_epure', 'companies');
        return $ids === '' ? [] : array_map('intval', explode(',', $ids));
    }

    /**
     * The settings of a company.
     *
     * @param int $companyid Company.
     * @return array<string, string> Setting name => value, see {@see terms::setting()}.
     */
    public static function values(int $companyid): array {
        $json = get_config('local_epure', 'company_' . $companyid);
        $values = $json ? json_decode($json, true) : null;
        return is_array($values) ? $values : [];
    }

    /**
     * The words chosen by a company in a language, for the objects whose wording changes.
     *
     * @param int $companyid Company.
     * @param string $lang Language.
     * @return array<string, array<string, string>> object => term.
     */
    public static function chosen(int $companyid, string $lang): array {
        $values = self::values($companyid);
        $targets = [];
        foreach (terms::IOMAD_CONCEPTS as $concept) {
            if ($values && ($term = terms::chosen($lang, $concept, $values))) {
                $targets[$concept] = $term;
            }
        }
        return $targets;
    }

    /**
     * Saves the settings of a company, or removes them when the platform words are kept.
     *
     * @param int $companyid Company.
     * @param array $values Setting name => value.
     */
    public static function save(int $companyid, array $values): void {
        $ids = array_diff(self::ids(), [$companyid]);
        unset_config('company_' . $companyid, 'local_epure');
        $keep = false;
        foreach (terms::LANGUAGES as $lang) {
            foreach (terms::IOMAD_CONCEPTS as $concept) {
                $keep = $keep || terms::chosen($lang, $concept, $values) !== null;
            }
        }
        if ($keep) {
            set_config('company_' . $companyid, json_encode($values), 'local_epure');
            $ids[] = $companyid;
        }
        sort($ids);
        set_config('companies', implode(',', array_unique($ids)), 'local_epure');
        set_config('companyrev', time(), 'local_epure');
        self::$rewriters = [];
        // Also invalidates the strings cached by the browsers.
        get_string_manager()->reset_caches();
    }

    /**
     * Revision of the company words, part of the cache keys.
     *
     * @return int
     */
    public static function revision(): int {
        return (int) get_config('local_epure', 'companyrev');
    }

    /**
     * The rewriter for a company and a language.
     *
     * The words to replace are those of the platform vocabulary when one is chosen, else those of the language pack.
     *
     * @param int $companyid Company.
     * @param string $lang Language.
     * @return rewriter|null Null when the company keeps the words of the platform.
     */
    public static function rewriter(int $companyid, string $lang): ?rewriter {
        if (!array_key_exists($lang, self::$rewriters[$companyid] ?? [])) {
            $targets = in_array($lang, terms::LANGUAGES, true) ? self::chosen($companyid, $lang) : [];
            $sources = [];
            foreach (array_keys($targets) as $concept) {
                $platform = terms::chosen($lang, $concept);
                $sources[$concept] = $platform ? [$platform] : terms::pack_words($lang, $concept);
            }
            self::$rewriters[$companyid][$lang] = $targets ? rewriter::for_language($lang, $targets, $sources) : null;
        }
        return self::$rewriters[$companyid][$lang];
    }

    /**
     * Forgets the rewriters of the request (for tests).
     */
    public static function reset(): void {
        self::$rewriters = [];
    }
}
