# Outils Épure (local_epure)

Plugin compagnon du thème [Épure](../../theme/epure). Il est facultatif : le thème fonctionne seul.

## Vocabulaire

Administration du site › Plugins › Plugins locaux › Outils Épure › Vocabulaire.

Choisissez, pour le français et l'anglais, les mots qui désignent :

| Objet | Mots proposés en français | Mots proposés en anglais |
|---|---|---|
| Cours | cours, formation, parcours, module, autre | course, program, programme, module, class, learning path, autre |
| Étudiants | étudiant, apprenant, stagiaire, participant, collaborateur, autre | student, learner, trainee, participant, employee, autre |
| Enseignants | enseignant, formateur, tuteur, intervenant, professeur, coach, autre | teacher, trainer, tutor, instructor, facilitator, coach, autre |
| Entreprises (IOMAD) | entreprise, société, client, établissement, organisation, filiale, agence, autre | company, client, organisation, organization, institution, subsidiary, agency, autre |
| Départements (IOMAD) | département, service, équipe, site, pôle, agence, unité, autre | department, team, site, unit, division, branch, autre |

Le vocabulaire s'applique à **tout Moodle** : menus, tableau de bord, listes de cours, participants, rôles, rapports, notifications, ainsi qu'aux pages des plugins et d'IOMAD.

En français, le plugin ne se contente pas de remplacer un mot : les articles, l'élision et les accords suivent le mot choisi. « Tous les cours » devient « Toutes les formations », « Ce cours est masqué » « Cette formation est masquée », « l'étudiant » « le stagiaire ». Pour un mot de votre choix, indiquez son singulier, son pluriel et son genre.

Fonctionnement :

- les chaînes sont écrites avec l'outil natif **Personnalisation de la langue** de Moodle (paquets `fr_local`, `en_local`) : aucun fichier de Moodle ni `config.php` n'est modifié ;
- les chaînes que vous avez personnalisées vous-même dans cet outil sont conservées, jamais écrasées ;
- chaque chaîne réécrite reste modifiable dans l'outil de personnalisation ;
- « Rétablir la formulation de Moodle » retire uniquement les chaînes écrites par le plugin ;
- la première application prend une vingtaine de secondes par langue (Moodle charge le paquet de langue dans l'outil), les suivantes quelques secondes.

Après l'installation d'une nouvelle version de Moodle ou d'un paquet de langue, appliquez à nouveau le vocabulaire pour couvrir les nouvelles chaînes.

## Vocabulaire de chaque entreprise IOMAD

Administration du site › Plugins › Plugins locaux › Outils Épure › Vocabulaire des entreprises.

Chaque entreprise peut avoir ses propres mots pour « entreprise » et « département », en français et en anglais : « client » et « équipe » pour l'une, « agence » et « service » pour une autre. Sans mots propres, une entreprise utilise ceux de la plateforme.

Ils s'appliquent sur toutes les pages aux utilisateurs de l'entreprise, et à l'administrateur qui l'a sélectionnée dans le tableau de bord IOMAD. Les mêmes règles de grammaire s'appliquent : « Modifier l'entreprise » devient « Modifier le client », « Afficher les entreprises suspendues » « Afficher les clients suspendus ».

Fonctionnement : les paquets de langue sont communs à tout le site, les mots d'une entreprise ne peuvent donc pas y être écrits. Le plugin active, pour chaque page, un gestionnaire de chaînes (le mécanisme `$CFG->customstringmanager` de Moodle) qui applique les mots de l'entreprise de l'utilisateur au moment où les chaînes sont chargées, avec un cache par entreprise. Il n'est activé que si au moins une entreprise a ses propres mots, et **aucune modification de `config.php` n'est nécessaire**. Si `config.php` définit déjà un autre gestionnaire de chaînes, il est conservé et la page l'indique.

À venir : le tableau de bord des entreprises.

## Installation

Copiez le dossier `epure` dans le dossier `local` de votre Moodle (`public/local` à partir de Moodle 5.1), puis lancez la mise à jour.

## Licence

GNU GPL v3 ou ultérieure.
