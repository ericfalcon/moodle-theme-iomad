Épure détecte IOMAD automatiquement : aucun autre plugin n’est à installer.

## Avec IOMAD

Épure applique l'apparence que vous définissez pour chaque entreprise dans IOMAD (Tableau de bord IOMAD › Modifier l'entreprise › Apparence) :

| Réglage IOMAD de l'entreprise | Effet dans Épure |
|---|---|
| Couleur des titres (à défaut, couleur des liens) | Devient la couleur de marque de l'entreprise : la palette accessible est recalculée pour elle (en-tête, boutons, liens, contrastes AA). |
| Logo de l'entreprise | Remplace le logo d'Épure pour les utilisateurs de l'entreprise. |
| CSS personnalisé | Ajouté aux pages des utilisateurs de l'entreprise. |

Ces réglages s'appliquent aux utilisateurs rattachés à l'entreprise, et à l'administrateur qui a sélectionné l'entreprise dans le tableau de bord IOMAD. Seuls les codes couleur hexadécimaux sont pris en compte. La couleur principale (fond de page) d'IOMAD n'est pas appliquée, pour préserver la lisibilité.

**Tableau de bord IOMAD** : le tableau de bord d'IOMAD garde ses actions, ses onglets et ses droits, mais Épure en change la présentation :

- l'entreprise sélectionnée en en-tête, avec son logo, un accès direct à sa catégorie de cours et à ses sous-catégories (page de gestion pour qui gère les cours, liste des cours sinon), lien repris en tête de l'onglet Cours, et le sélecteur d'entreprise à côté ;
- les chiffres clés de l'entreprise : utilisateurs (et actifs cette semaine), cours, licences utilisées sur celles attribuées, achèvements des 30 derniers jours ; chacun mène à la page d'IOMAD correspondante ;
- des onglets sobres, soulignés de la couleur de marque, qui défilent sur mobile ;
- les actions en cartes, **regroupées par intention** dans chaque onglet : Créer, Paramétrer, Gérer, Importer et exporter, Suivre ;
- la palette de l'entreprise à la place des couleurs fixes d'IOMAD, et des onglets accessibles aux lecteurs d'écran.

**Gérer les cours** (paramètres IOMAD des cours) : le tableau d'IOMAD gagne une colonne **Catégorie**, après celle du cours, avec le chemin complet de sa catégorie (par exemple « Clinique des Tilleuls / Soins infirmiers »).

**Tout se règle dans la fiche de l'entreprise** (Tableau de bord IOMAD › Créer une entreprise ou Modifier l'entreprise › Apparence). En tête de cette partie, la section **Apparence Épure** propose :

| Réglage de l'entreprise | Effet |
|---|---|
| Couleur de marque | Code couleur libre, sélecteur de couleur, ou couleurs du logo de l'entreprise (pastilles et pipette, y compris pour un logo tout juste téléversé). Vide : la couleur du titre d'IOMAD, sinon celle du site. La palette accessible est recalculée. |
| Couleur de l'en-tête | Comme le site, blanc, ou couleur de marque. |
| Bannière des cours | Comme le site, affichée ou masquée, pour les utilisateurs de l'entreprise. |
| Aperçu de l'apprenant sur le tableau de bord | Comme le site, affiché ou masqué. |
| Barre de navigation mobile | Comme le site, affichée ou masquée. |
| Mode sombre | Comme le site, jamais, automatique selon l'appareil, ou toujours. |
| Pied de page | Texte, mentions légales, données personnelles, contact, autres liens ; un champ vide reprend la valeur du site, affichée en grisé. |
| Logo pour l'en-tête en couleur | Facultatif : une version du logo lisible sur la couleur de marque de l'entreprise, souvent blanche sur fond transparent. |
| Police | Comme le site, ou l'une des polices fournies. |

Les champs natifs d'IOMAD (logo, logo compact, CSS personnalisé) restent en dessous ; Épure se déclare thème IOMAD pour qu'IOMAD les affiche. Les couleurs d'IOMAD (titre, principale, lien), qui ne servent qu'aux thèmes IOMAD, sont masquées tant que l'entreprise utilise Épure ; une couleur du titre déjà enregistrée est reprise comme couleur de marque. Enfin, la section **Vocabulaire** règle les mots de l'entreprise, c'est-à-dire ses mots pour « entreprise » et « département », en français et en anglais (« client » et « équipe » pour l'une, « agence » et « service » pour une autre). Épure se déclare thème IOMAD pour qu'IOMAD affiche ces champs. Les mots pour toutes les entreprises se choisissent sur la page Épure : vocabulaire ; une entreprise sans mots propres utilise ceux-là.

Les paquets de langue étant communs à tout le site, ces mots sont appliqués au chargement des chaînes par un gestionnaire de chaînes que le thème active à chaque page (le mécanisme `$CFG->customstringmanager` de Moodle), avec un cache par entreprise. **Aucune modification de `config.php` n'est nécessaire.** Il n'est activé que si des mots sont choisis ; si `config.php` définit déjà un autre gestionnaire de chaînes, celui-ci est conservé et la page Épure : vocabulaire l'indique.

## Chiffres clés

Sur un Moodle sans IOMAD, le tableau de bord des gestionnaires de la plateforme commence par ses chiffres clés : utilisateurs (et actifs cette semaine), cours (et cours visibles), inscriptions actives, achèvements des 30 derniers jours. Avec IOMAD, ce sont ceux de l'entreprise sélectionnée, en tête du tableau de bord IOMAD.
