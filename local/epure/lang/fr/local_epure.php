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
 * French strings for local_epure.
 *
 * @package    local_epure
 * @copyright  2026 Eric Falcon
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['cachedef_companystrings'] = 'Chaînes avec les mots d\'une entreprise IOMAD';
$string['companyvocabchoose'] = 'Choisir une entreprise…';
$string['companyvocabcompany'] = 'Entreprise';
$string['companyvocabintro'] = 'Choisissez les mots qui désignent « entreprise » et « département » : pour toutes les entreprises (la plateforme), et au besoin pour chacune. Ils s\'appliquent sur toutes les pages aux utilisateurs de l\'entreprise, et à l\'administrateur qui l\'a sélectionnée dans le tableau de bord IOMAD. Une entreprise sans mots propres utilise ceux de la plateforme.';
$string['companyvocablist'] = 'Entreprises qui ont leurs propres mots';
$string['companyvocabplatform'] = 'Toutes les entreprises (plateforme)';
$string['companyvocabreset'] = 'Utiliser les mots de la plateforme';
$string['companyvocabsaved'] = 'Le vocabulaire de {$a} est enregistré.';
$string['companyvocabulary'] = 'Vocabulaire des entreprises';
$string['companyvocabunavailable'] = 'config.php définit un autre gestionnaire de chaînes ($CFG->customstringmanager) : le vocabulaire des entreprises ne peut pas s\'appliquer. Retirez cette ligne, ou contactez le développeur de ce gestionnaire.';
$string['companyvocabwords'] = 'Mots';
$string['iomaddetected'] = 'IOMAD est installé : les fonctions entreprise (tableau de bord, couleur, logo et vocabulaire par entreprise) seront disponibles.';
$string['iomadnotdetected'] = 'IOMAD n\'est pas installé : les fonctions entreprise sont masquées. Les mots désignant les cours, les étudiants et les enseignants se règlent dans le thème Épure.';
$string['pluginname'] = 'Outils Épure';
$string['privacy:metadata'] = 'Le plugin Outils Épure ne stocke aucune donnée personnelle.';
$string['status'] = 'État';
