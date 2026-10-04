# Feuille de route — Épure

Ce document fige les décisions prises pendant la phase de conception. Il sert de référence pour le développement et pour les contributeurs.

La maquette interactive qui a servi à valider ces choix montre chaque écran décrit ici.

## Vision

Moodle « fait vieux » face aux plateformes payantes (360Learning, TalentLMS, LearnWorlds…). Épure lui donne le rendu d'une plateforme moderne, **sobre et professionnelle**, sans transformer l'administration en usine à réglages.

Principes :

1. **Peu de réglages, mais chacun change beaucoup de choses.** L'administrateur fait des choix ; le thème calcule le reste (palette, contrastes, variantes).
2. **Accessible par construction.** Les contrastes, le focus, la navigation au clavier et les préférences d'affichage ne dépendent pas de la bonne volonté de l'administrateur.
3. **Le moins de templates surchargés possible.** Chaque template surchargé est un coût à chaque mise à jour de Moodle. On privilégie le SCSS et les variables.
4. **Un seul plugin**, qui fonctionne sur Moodle et s'adapte à IOMAD lorsqu'il le détecte.

Public visé : organismes de formation, entreprises et établissements qui veulent une plateforme présentable à leurs apprenants et à leurs clients.

## Architecture

Le dépôt contient un seul plugin, le thème `theme_epure` (dossier `theme/epure`) : rendu, réglages, accessibilité, préférences de l'utilisateur, vocabulaire, et adaptation à IOMAD.

IOMAD est détecté par le thème lui-même (présence de `local/iomad`) : sans IOMAD, les réglages et les fonctions propres à IOMAD restent masqués.

Un plugin compagnon `local_epure` a existé dans les versions 0.1 à 0.3 ; il a été fusionné dans le thème en 0.4, qui reprend ses réglages à la mise à jour.

## Compatibilité

| | Moodle 4.5 LTS | Moodle 5.0 | Moodle 5.1+ |
|---|---|---|---|
| Statut | Cible principale | Supporté | Supporté |
| PHP | 8.1 à 8.3 | 8.2 à 8.4 | 8.2 et plus |
| Bootstrap | 4.6 | 5.3 (couche de compatibilité BS4) | 5.3 |
| Particularité | — | — | Code de Moodle sous `public/` |

Règles pour rester compatible :

- n'utiliser que des classes communes à Bootstrap 4 et 5, ou des classes préfixées `epure-` ;
- passer par les variables SCSS et les variables CSS plutôt que par les utilitaires Bootstrap ;
- tester chaque modification sur 4.5 et 5.x dans l'intégration continue.

IOMAD suit les versions de Moodle ; on cible IOMAD 4.5 et 5.x.

## Réglages du thème

Administration du site › Apparence › Épure. Avec IOMAD, chaque entreprise peut surcharger la couleur et le logo.

| Réglage | Détail | Ce que le thème en déduit |
|---|---|---|
| Couleur de marque | Pastilles prédéfinies, code hexadécimal libre, ou couleur extraite du logo | Survol, fonds teintés, focus, couleur de texte et de lien ajustée pour atteindre le contraste AA, variante sombre |
| Logo | Téléversement (PNG, JPG, WebP, SVG), fonds transparents pris en charge ; les couleurs principales sont proposées automatiquement, avec une pipette | Placement dans l'en-tête, la connexion et le favicon |
| Logo pour l'en-tête en couleur | Variante facultative, souvent blanche sur fond transparent | Utilisée quand l'en-tête prend la couleur de marque |
| Couleur de l'en-tête | Blanc avec soulignement de la couleur de marque, ou rempli de la couleur de marque | Textes et icônes de l'en-tête dans la couleur la plus lisible |
| Police | Polices embarquées (IBM Plex Sans, Inter, Source Sans 3, Figtree, Lato), polices de lisibilité (Atkinson Hyperlegible, Lexend, OpenDyslexic), ou police de l'établissement téléversée en `.woff2` ou `.woff` | Échelle typographique complète |
| Arrondis | Net, doux, arrondi | Cartes, boutons, champs |
| Mode d'affichage | Clair, sombre, ou au choix de l'utilisateur | Tous les composants |
| Page de connexion | Écran partagé ou formulaire centré, accroche, texte d'accompagnement, image de fond facultative | Voile de la couleur de marque dont l'opacité garantit un texte lisible (AA) quelle que soit l'image |
| Pied de page | Mentions légales, accessibilité, contact | — |
| SCSS personnalisé | Pour les cas particuliers | — |

Toutes les polices sont servies par Moodle lui-même, **sans appel à un service externe**. Il n'y a pas d'option Google Fonts : charger des polices depuis les serveurs de Google pose un problème RGPD. Pour une police qui n'est pas fournie, l'administrateur téléverse ses fichiers `.woff2` ou `.woff`.

Licences des polices : toutes sous SIL Open Font License 1.1, compatible avec la diffusion du thème.

## Vocabulaire

Les mots qui désignent les objets de la plateforme sont réglables. Le français demande de gérer le genre (« Toutes mes formations », « Non commencées ») et l'élision (« Gestionnaire d'établissement »).

| Objet | Choix proposés | Portée |
|---|---|---|
| Cours | cours, formations, parcours, modules, autre | Plateforme |
| Inscrits | étudiants, apprenants, stagiaires, participants, collaborateurs, autre | Plateforme |
| Enseignants | enseignants, formateurs, tuteurs, intervenants, professeurs, coachs, autre | Plateforme |
| Entreprise (IOMAD) | entreprise, client, établissement, organisation, filiale, agence, autre | Par entreprise |
| Département (IOMAD) | département, service, équipe, site, pôle, agence, unité, autre | Par entreprise |

Le vocabulaire s'applique **à tout Moodle**, pas seulement aux pages du thème : menus, tableau de bord, liste des cours, participants, rôles, rapports, notifications, ainsi qu'aux écrans d'IOMAD.

Mise en œuvre :

- il s'appuie sur le mécanisme natif des **paquets de langue locaux** de Moodle (`fr_local`, `en_local`), en écrivant par l'outil « Personnalisation de la langue » : aucune modification du cœur ni de `config.php` ;
- un simple remplacement de mots ne suffit pas en français (« le cours » deviendrait « le formation ») : le plugin réécrit chaque chaîne du paquet de langue installé en régénérant les déterminants, l'élision et les accords selon le singulier, le pluriel et le genre du mot choisi. Il couvre ainsi toutes les chaînes de Moodle, de ses plugins et d'IOMAD, sans liste à maintenir ;
- les personnalisations déjà faites par l'administrateur dans l'outil de personnalisation sont conservées, jamais écrasées ;
- l'opération est réversible : revenir au vocabulaire par défaut supprime les chaînes ajoutées par le plugin ;
- le vocabulaire propre à une entreprise IOMAD s'applique aux utilisateurs de cette entreprise. Les paquets de langue étant communs à tout le site, il est appliqué au chargement des chaînes par un gestionnaire de chaînes que le plugin active à chaque page (crochet `after_config`), sans modifier `config.php`. Une langue dérivée par entreprise a été écartée : elle serait apparue dans le menu des langues.


## Accessibilité

Référentiels visés : **WCAG 2.2 niveau AA, RGAA 4.1.2, EN 301 549**.

Ce que le thème garantit :

- contrastes AA calculés et corrigés automatiquement, quelle que soit la couleur choisie, en clair et en sombre ;
- navigation complète au clavier, focus toujours visible et jamais masqué ;
- lien d'évitement « Aller au contenu » ;
- structure de titres et zones de page (en-tête, navigation, contenu, pied de page) ;
- texte agrandissable à 200 % et affichage sans défilement horizontal dès 320 px ;
- cibles cliquables d'au moins 24 × 24 px ;
- information jamais portée par la couleur seule ;
- respect du réglage système « réduire les animations ».

Préférences de l'utilisateur (bouton **Aa** dans l'en-tête, raccourci Alt + A), enregistrées dans son profil Moodle :

- taille du texte : 90, 100, 115 ou 130 % ;
- police : celle du thème, Atkinson Hyperlegible, ou OpenDyslexic ;
- espacement du texte renforcé ;
- contraste renforcé ;
- liens soulignés ;
- animations réduites.

Le thème fournit aussi un **modèle de déclaration d'accessibilité** conforme au format français (état de conformité, contenus non accessibles, contact, voies de recours), à compléter par l'établissement.

Limite assumée : un thème ne rend pas une plateforme conforme à lui seul. Les contenus des cours (PDF, vidéos, images) comptent, et un audit manuel avec lecteur d'écran reste nécessaire avant de déclarer la conformité.

Contrôle continu : chaque modification passe un audit automatique axe-core dans l'intégration continue.

## Écrans

1. **Connexion** : écran partagé avec visuel de marque, formulaire clair, bouton de connexion unique (SSO) si configuré.
2. **Tableau de bord de l'apprenant** : reprendre où l'on en était, échéances, formations en cours, attestations obtenues.
3. **Mes cours** : cartes avec couverture, durée, progression, filtres et recherche.
4. **Page de cours** : bannière, progression, bouton « Continuer », sommaire latéral, modules repliables avec état de chaque activité.
5. **Déclaration d'accessibilité.**
6. **Tableau de bord IOMAD** : le tableau de bord d'IOMAD lui-même (`blocks/iomad_company_admin`), mis en forme par le thème : onglets, icônes et sélecteur d'entreprise aux couleurs de la marque, contrastes et navigation au clavier.

## Jalons

### V0.1 — Fondations (terminé)

- [x] Dépôt, licence, feuille de route
- [x] `theme_epure` installable, enfant de Boost
- [x] Palette accessible calculée à partir d'une seule couleur, avec tests
- [x] Réglages : couleur (contraste affiché), police, police téléversée, arrondis, SCSS personnalisé
- [x] Polices embarquées, servies par Moodle
- [x] En-tête blanc ou couleur de marque, logo avec transparence et variante pour l'en-tête en couleur
- [x] Détection d'IOMAD
- [x] Intégration continue sur Moodle 4.5, 5.0 et 5.1

### V0.2 — Identité et connexion (terminé)

- [x] Toutes les pages à la largeur des pages d'administration (0.2.5)

- [x] Extraction des couleurs du logo et pipette dans la page de réglages
- [x] Page de connexion : écran partagé avec visuel de marque, accroche, image de fond avec voile calculé pour rester lisible ; ou formulaire centré
- [x] Liens soulignés dans le texte, pour ne jamais dépendre de la seule couleur
- [ ] En-tête, navigation et pied de page : reporté en V0.4 avec le parcours de l'apprenant

### V0.3 — Accessibilité (livré en 0.9.0)

- [x] Préférences de l'utilisateur (bouton Aa, raccourci Alt + A) enregistrées dans le profil, appliquées dès l'affichage de la page
- [x] Lien d'évitement, focus, cibles minimales
- [x] Modèle de déclaration d'accessibilité (onglet Accessibilité des réglages, page publique, mention en bas de chaque page)
- [x] Audit axe-core dans l'intégration continue (tests Behat)

### V0.4 — Parcours de l'apprenant

- [x] Mes cours par rôle : sections « que j'anime » et « que je suis », cartes adaptées (progression, prochaine activité, échéance ; participants, à corriger, accès directs) — livré en 0.7.0
- [x] Page de cours : bannière (image, catégorie, progression, prochaine activité, échéance, bouton « Continuer » ; chiffres et accès directs pour l'enseignant), progression de l'apprenant dans chaque section — livré en 0.10.0
- [ ] Tableau de bord de l'apprenant
- [ ] Mode sombre

### V0.5 — Vocabulaire et IOMAD

- [x] Couleur et logo par entreprise, à partir des réglages natifs d'IOMAD (couleur des titres, logo, CSS personnalisé) — livré en 0.2.2
- [x] Vocabulaire de la plateforme (cours, étudiants, enseignants ; français et anglais), appliqué à tout Moodle par l'outil de personnalisation de la langue — livré en 0.3.0
- [x] Vocabulaire par entreprise IOMAD (entreprise, département), pour toutes les entreprises et pour chacune, appliqué par un gestionnaire de chaînes activé par le thème, sans modifier config.php — livré en 0.4.0
- [x] Mise en forme du tableau de bord d'IOMAD : en-tête de l'entreprise, onglets, actions en cartes regroupées par intention — livré en 0.5.0
- [x] Logo, couleur et vocabulaire de chaque entreprise dans sa fiche IOMAD (Créer / Modifier l'entreprise › Apparence) — livré en 0.6.0
- [x] Accès direct aux catégories de cours de l'entreprise depuis le tableau de bord — livré en 0.9.0
- [ ] Chiffres clés de l'entreprise en tête du tableau de bord (utilisateurs, cours, licences)

### V1.0 — Publication

- [ ] Audit d'accessibilité manuel
- [ ] Documentation d'installation et d'utilisation
- [ ] Publication sur moodle.org/plugins

## Questions ouvertes

- Traductions : le répertoire moodle.org/plugins n'accepte que l'anglais dans le plugin, les autres langues passent par AMOS. Le français est inclus pendant le développement et sera transféré dans AMOS avant la publication, par Eric Falcon, qui a déjà traduit IOMAD.
- Nom : « Épure » (`theme_epure`) n'est pas utilisé dans le répertoire des plugins Moodle.
- Modèle de diffusion : gratuit sur moodle.org, ou gratuit avec services payants (installation, personnalisation, support). La licence est GPL dans tous les cas.
