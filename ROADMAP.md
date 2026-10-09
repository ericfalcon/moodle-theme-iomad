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
5. **Très personnalisable, mais pas trop.** Chaque évolution passe trois questions : résout-elle un vrai irritant de Moodle ou d'IOMAD ? Apporte-t-elle une valeur pédagogique ou métier ? Mérite-t-elle vraiment d'être dans Épure ? Le but n'est pas d'être le thème qui a le plus de fonctions, mais celui qui résout le plus de problèmes de Moodle sans paraître compliqué : « l'administrateur configure son identité, Épure s'occupe du reste ».
6. **Rien ne reste quand le thème n'est plus utilisé.** Les réglages et les effets d'Épure (vocabulaire, e-mails, attestations IOMAD, application web) cessent dès que le site ou l'entreprise quitte le thème.
7. **Qualiopi par les traces de Moodle.** Épure rend exploitables les traces pédagogiques que Moodle enregistre déjà (progression, assiduité, achèvements, résultats) ; il ne devient pas un logiciel qualité. La chaîne est : exigence qualité → trace nécessaire → donnée de Moodle → présentation exploitable. Épure est un outil de pilotage pédagogique dont les données peuvent aussi servir de preuves.
8. **Moodle reste Moodle.** Épure ne supprime ni activités, ni rôles, ni capacités, ni compatibilité avec l'écosystème. Il modernise la façon d'interagir, pas seulement l'apparence, sans chercher à imiter 360Learning.
9. **Ne pas obliger l'utilisateur à comprendre Moodle.** Chaque question technique devient une question d'utilisateur (« Calendrier » devient « Qu'est-ce qui se passe cette semaine ? »). Les options essentielles d'abord, les options avancées ensuite, pour l'administrateur comme pour le formateur.
10. **La couleur de marque identifie, ses dérivés structurent.** Moodle, IOMAD, H5P, les tests et les cartes utilisent les mêmes jetons calculés depuis la couleur de marque (fond teinté, bordure, survol, focus, texte), jamais des styles indépendants.
11. **Des indicateurs nommés honnêtement.** Un chiffre ne dit pas plus que ce qu'il mesure : « actifs cette semaine » n'est pas « engagés », la progression ne prouve pas l'atteinte des objectifs, et les indicateurs d'Épure ne prouvent pas seuls la conformité Qualiopi.

Quatre axes : l'expérience de l'apprenant, du formateur et de l'administrateur ; l'accessibilité et une personnalisation raisonnée ; un Moodle et un IOMAD cohérents ; le pilotage pédagogique et la qualité, notamment le nouveau référentiel Qualiopi.

Public visé : organismes de formation, entreprises et établissements qui veulent une plateforme présentable à leurs apprenants et à leurs clients.

## Architecture

Le dépôt contient un seul plugin, le thème `theme_epure` (dossier `theme/epure`) : rendu, réglages, accessibilité, préférences de l'utilisateur, vocabulaire, et adaptation à IOMAD.

IOMAD est détecté par le thème lui-même (présence de `local/iomad`) : sans IOMAD, les réglages et les fonctions propres à IOMAD restent masqués.

Un plugin compagnon `local_epure` a existé dans les versions 0.1 à 0.3 ; il a été fusionné dans le thème en 0.4, qui reprend ses réglages à la mise à jour.

## Compatibilité

| | Moodle 4.5 LTS | Moodle 5.0 | Moodle 5.1 à 5.3 |
|---|---|---|---|
| Statut | Cible principale | Supporté | Supporté (5.2 et 5.3 testés depuis 0.22.0) |
| PHP | 8.1 à 8.3 | 8.2 à 8.4 | 8.2 à 8.4 (8.3 minimum dès 5.2) |
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
- [x] Intégration continue sur Moodle 5.2 et 5.3, et sur MariaDB 11.4 — livré en 0.22.0

### V0.2 — Identité et connexion (terminé)

- [x] Toutes les pages à la largeur des pages d'administration (0.2.5)

- [x] Extraction des couleurs du logo et pipette dans la page de réglages
- [x] Page de connexion : écran partagé avec visuel de marque, accroche, image de fond avec voile calculé pour rester lisible ; ou formulaire centré
- [x] Liens soulignés dans le texte, pour ne jamais dépendre de la seule couleur
- [x] Pied de page : nom du site, texte, mentions légales, données personnelles, accessibilité, contact et liens libres, sur toutes les pages dont la connexion — livré en 0.14.0

### V0.3 — Accessibilité (livré en 0.9.0)

- [x] Préférences de l'utilisateur (bouton Aa, raccourci Alt + A) enregistrées dans le profil, appliquées dès l'affichage de la page
- [x] Lien d'évitement, focus, cibles minimales
- [x] Modèle de déclaration d'accessibilité (onglet Accessibilité des réglages, page publique, mention en bas de chaque page)
- [x] Audit axe-core dans l'intégration continue (tests Behat)

### V0.4 — Parcours de l'apprenant

- [x] Mes cours par rôle : sections « que j'anime » et « que je suis », cartes adaptées (progression, prochaine activité, échéance ; participants, à corriger, accès directs) — livré en 0.7.0
- [x] Page de cours : bannière (image, catégorie, progression, prochaine activité, échéance, bouton « Continuer » ; chiffres et accès directs pour l'enseignant), progression de l'apprenant dans chaque section — livré en 0.10.0
- [x] Tableau de bord de l'apprenant : cours à reprendre, cours en cours, échéances, cours terminés et attestations, au-dessus des blocs — livré en 0.11.0
- [x] Mode sombre : jamais, automatique selon l'appareil ou toujours, pour le site et par entreprise IOMAD, et au choix de chaque utilisateur (bouton Aa) — livré en 0.12.0
- [x] Pages d'activité : activité précédente et suivante en cartes, bande avec le cours, la position et la progression, mode lecture sans panneaux latéraux, bouton « Marquer comme terminé » plus visible — livré en 0.16.0
- [x] Catalogue des cours : sous-catégories en pastilles, cours en cartes (image, résumé, enseignants, inscrit / inscription libre / accès invité), recherche en cartes ; présentation du cours avant inscription (résumé, programme, enseignants, dates, contenu) — livré en 0.17.0
- [x] Barre de navigation mobile : tableau de bord, mes cours, catalogue, messages (non lus), profil ; pour le site et par entreprise IOMAD — livré en 0.18.0
- [x] Recherche rapide Ctrl+K : pages des menus, mes cours, activités, catalogue, pages de l'administration — livré en 0.19.0
- [x] E-mails aux couleurs de la marque : logo, filet de couleur, pied de page et lien vers les préférences ; par entreprise du destinataire avec IOMAD — livré en 0.20.0

### V0.5 — Vocabulaire et IOMAD

- [x] Couleur et logo par entreprise, à partir des réglages natifs d'IOMAD (couleur des titres, logo, CSS personnalisé) — livré en 0.2.2
- [x] Vocabulaire de la plateforme (cours, étudiants, enseignants ; français et anglais), appliqué à tout Moodle par l'outil de personnalisation de la langue — livré en 0.3.0
- [x] Vocabulaire par entreprise IOMAD (entreprise, département), pour toutes les entreprises et pour chacune, appliqué par un gestionnaire de chaînes activé par le thème, sans modifier config.php — livré en 0.4.0
- [x] Mise en forme du tableau de bord d'IOMAD : en-tête de l'entreprise, onglets, actions en cartes regroupées par intention — livré en 0.5.0
- [x] Logo, couleur et vocabulaire de chaque entreprise dans sa fiche IOMAD (Créer / Modifier l'entreprise › Apparence) — livré en 0.6.0
- [x] Accès direct aux catégories de cours de l'entreprise depuis le tableau de bord — livré en 0.9.0
- [x] Chiffres clés de l'entreprise en tête du tableau de bord (utilisateurs et actifs de la semaine, cours, licences utilisées, achèvements sur 30 jours) — livré en 0.13.0 ; sans IOMAD, chiffres de la plateforme en tête du tableau de bord des gestionnaires (0.14.0)

### V1.0 — Publication

- [x] Pré-audit d'accessibilité automatisé et au clavier (240 pages, Moodle 4.5, 5.1 et IOMAD), défauts corrigés, rapport dans le wiki — livré en 0.21.0
- [ ] Audit d'accessibilité manuel (RGAA) par un auditeur
- [x] Documentation : README en anglais, wiki en français — livré en 0.21.0
- [x] Passage en bêta — 0.21.0
- [x] Releases GitHub publiées automatiquement (tag, notes, zip) à chaque nouvelle version — 0.22.0
- [x] Réglages du thème et formulaire entreprise d'IOMAD organisés de la même façon, logos avant couleurs — 0.22.0
- [x] Indicateur « Moodle travaille » sur les pages de maintenance (validation d'un zip, mise à jour) — 0.22.0
- [x] Un autre thème reste tel qu'il est sans Épure (formulaire IOMAD d'origine, vocabulaire, e-mails) ; Épure disponible pour une entreprise quel que soit le thème du site — 0.22.2
- [x] Changement de thème d'une entreprise appliqué tout de suite, et pages dans le thème de l'entreprise sélectionnée, y compris pour l'administrateur — 0.22.2 et 0.22.3
- [x] Couleurs des icônes d'activités au choix (marque ou Moodle), par site et par entreprise ; H5P, tests et leçons aux couleurs de la marque — 0.23.0
- [x] Icônes d'activités masquables ; application Moodle aux couleurs de la marque ; forums, glossaires, devoirs, SCORM, livres, badges, attestations IOMAD et rapports aux couleurs de la marque — 0.24.0
- [x] Consolidation : compatibilité IOMAD 5.1 et 5.2 (classe `theme_epure\iomad`), formats de cours sur Moodle 5.1 à 5.3, SCSS découpé, erreurs signalées en débogage, mesures de performance — 0.25.0
- [x] Réglages rangés par sujet (Identité, Navigation, Cours, Accessibilité, Apparence, Mobile) et nouveaux réglages d'affichage ; application web installable ; sous-sections à leur place dans le parcours et dans la progression ; progression de l'apprenant en cache ; Behat sur IOMAD 4.5, 5.1 et 5.2 — 0.26.0
- [x] Couverture graphique et UX : arrondis cohérents d'un niveau à l'autre (sections, sous-sections, activités, pastilles), calendrier lisible, formulaires de paramètres allégés, atelier, feedback, messagerie et profil, carnet de notes en mode sombre — 0.27.0
- [x] Fin de la couverture graphique et UX : messagerie en bulles, sondage en cartes, graphiques aux couleurs de la marque, profil et préférences en menus, base de données, wiki et feedback au niveau du forum et du test, icônes de l'atelier en mode sombre — 0.28.0
- [ ] Publication sur moodle.org/plugins (après le transfert du français dans AMOS, voir Questions ouvertes)

### V0.29 — Rapports pour Moodle sans IOMAD

Repris des rapports d'IOMAD (`local/report_*`), lus dans les données de Moodle (`course_completions`, `user_lastaccess`, `grade_grades`, `user_enrolments`) au lieu de l'historique propre à IOMAD. Sur un site IOMAD, les pages renvoient vers les rapports d'IOMAD. Par ordre de priorité :

- [ ] **Synthèse d'achèvement par cours**, avec graphique : inscrits, jamais venus, en cours, terminés, taux d'achèvement, note moyenne ; un clic mène au détail natif (`report/completion`, `report/progress`). C'est le tableau de bord du responsable de formation, absent du cœur de Moodle.
- [ ] **Grille apprenants × cours**, filtrée par catégorie ou cohorte, pour repérer d'un coup d'œil qui décroche sur un parcours de plusieurs cours.
- [ ] **Connexions et inactifs** : première et dernière connexion, jamais connectés, inactifs depuis N jours, dernier accès par cours.
- [ ] **Achèvements par mois** : histogramme pour le bilan annuel.
- [ ] **Relevé de formation d'un apprenant** : tous ses cours (inscription, premier et dernier accès, progression, achèvement, note), exportable en PDF et CSV.
- [ ] Une page « Rapports » d'Épure qui les regroupe.

Choix techniques :

- pages du thème pour les synthèses et la grille (graphiques `core\chart_*`, exports `\core\dataformat`), le Report builder de Moodle ne sachant faire ni graphique ni grille croisée ; pour les listes, un rapport personnalisé préconfiguré sur la source « Participants » ou une source Report builder du thème ;
- mêmes définitions que les écrans d'Épure (« actif », « commencé », « terminé », progression et son cache) ;
- capacités de Moodle (`report/completion:view`, `moodle/site:viewreports`) en respectant les groupes séparés, ou capacités propres au thème (`db/access.php`) ;
- requêtes groupées, pagination et cache : pas une requête par cellule comme IOMAD ;
- RGPD : accès par capacité, champs d'identité de Moodle, fournisseur de confidentialité complété pour toute table ajoutée ;
- prévenir à l'écran que les connexions dépendent des journaux (durée de conservation) et qu'une réinitialisation de cours efface les achèvements.

Non repris (propres à IOMAD) : licences, entreprises, e-mails sortants, présence aux séances (`trainingevent`) ; la liste des utilisateurs, qui existe déjà dans Moodle.

### Méthode pour la suite (versions 1.x)

- [ ] **Audit UX par parcours** : apprenant, formateur, administrateur et IOMAD, qualité. Pour chacun : ce que fait Moodle, ce qu'Épure fait déjà, ce qui reste frustrant, ce qui apporterait de la valeur, ce qui serait inutile. Il en sort un cahier des charges UX et les 10 à 15 dernières améliorations ; cette feuille de route sert de grille au lieu d'empiler des idées.
- [ ] **Matrice Qualiopi × Moodle × IOMAD × Épure**, indicateur par indicateur : l'exigence du nouveau référentiel, ce que Moodle produit déjà, ce qu'IOMAD ajoute, ce qu'Épure fait et pourrait faire, la priorité, et si la valeur est pédagogique ou seulement documentaire.
- [ ] **Audit des rapports existants** avant tout nouvel indicateur : rapports de Moodle (notes, achèvement, participation, journaux), d'IOMAD (fait, voir V0.29) et Kopere Dashboard (fork ericfalcon/moodle-local-kopere_dashboard), pour ne pas refaire ce qu'un plugin couvre déjà.
- [ ] **Comparaison avec les thèmes concurrents** (Boost Union, Moove, Adaptable…) : accessibilité, modernité, Moodle natif, IOMAD, mobile, irritants résolus.
- [ ] **Un service de suivi pédagogique commun** : extraire peu à peu les calculs partagés (« actif », « commencé », « terminé », progression, corrections) pour que la bannière, Mes cours, le tableau de bord et les rapports donnent toujours les mêmes chiffres.

### Pilotage pédagogique et qualité

- [ ] **Nouveau référentiel Qualiopi** : d'après nos échanges, un décret du 1er août 2026 l'applique à partir du 1er novembre 2026, avec 7 critères et 33 indicateurs ; l'indicateur 12 ajoute la prévention des violences, du harcèlement et des discriminations, l'indicateur 19 demande de vérifier que les modules à distance sont effectivement suivis, l'indicateur 32 ajoute une analyse des risques. **À vérifier sur le texte officiel** (et sur le guide de lecture, pas encore paru) avant de s'y appuyer.
- [ ] **Synthèse pédagogique d'un cours**, depuis la bannière ou les raccourcis du formateur, en complément de la synthèse d'achèvement de la V0.29 : corrections en attente, apprenants sans activité depuis une durée réglable selon le rythme de la formation, progression médiane, activités problématiques (taux d'échec), chaque chiffre menant au rapport détaillé.
- [ ] **Évaluations en attente distinguées** : corrections manuelles (devoirs et tests), notées automatiquement, non réalisées, tentatives qui demandent une action ; aujourd'hui seuls les devoirs sont comptés.
- [ ] **Tableau de bord « À surveiller » du formateur**, qui nomme les apprenants : sans activité depuis 7 jours, en retard sur le parcours, progression bloquée, évaluations et messages en attente (indicateurs 11, 12 et 19).
- [ ] **État du groupe** : dans le rythme, en retard, bloqués, inactifs.
- [ ] **Suivi du distanciel** (indicateur 19) : par apprenant, progression, dernière activité, évaluation et situation en vert, orange ou rouge.
- [ ] **Vue de coordination** des intervenants d'une formation (indicateur 18).
- [ ] **Pilotage sur plusieurs cours** pour les responsables : apprenants à risque, échéances, évaluations en retard, progression par groupe, dans le respect du cloisonnement des entreprises IOMAD ; après validation de la synthèse d'un cours.
- [ ] **Comparaison des sessions et des périodes** : « les résultats s'améliorent-ils ? ».
- [ ] **Satisfaction structurée et consolidée** (indicateur 30) : questionnaires par apprenant, formation, session et formateur, consolidés automatiquement.
- [ ] **Évaluation pédagogique distincte de la satisfaction** : objectifs atteints, ressources, cohérence des évaluations, rythme, clarté ; résultats partagés avec l'équipe selon la boucle analyse → décision → modification → nouvelle mesure.
- [ ] **« Signaler une difficulté »** (indicateur 31) : catégorie, description, date, personne concernée, statut, traitement, résolution.
- [ ] **Tableau d'amélioration continue** (indicateur 32) : constat → analyse → action → responsable → échéance → mesure → efficacité ; puis une **analyse des risques qualité**.
- [ ] Plus tard : certifications et blocs de compétences (indicateurs 3, 7 et 16), formation en situation de travail, insertion et veille (25, 28, 29), fonctions propres aux CFA (20).
- [ ] **Validité et recyclage des formations** dans la grille apprenants × cours (durée de validité par un champ personnalisé de cours), pour les habilitations et formations réglementaires.
- [ ] **Temps passé** estimé depuis les journaux, souvent demandé pour prouver l'assiduité en formation à distance financée ; aucun rapport d'IOMAD ne le mesure.
- [ ] **Historique des achèvements** conservé après une réinitialisation de cours (table d'archive alimentée à chaque achèvement, comme IOMAD). À arbitrer : tout garder dans le thème, comme voulu, ou un plugin compagnon.
- L'accessibilité native d'Épure est un argument pour l'indicateur 26 (handicap) ; rien à développer.

### Expérience de l'apprenant

- [ ] **États normalisés** des cours, activités et ressources : à faire, en cours, terminé, verrouillé, échéance proche ou dépassée, réussite ou score, facultatif ; même couleur, même icône et même action partout (test, H5P, devoir, inscription, disponibilité).
- [ ] **État du parcours détaillé** : « 67 % → 8 activités terminées, 2 en cours, 1 en retard, 3 évaluations réussies, 1 à refaire ».
- [ ] **Chaîne objectifs → ressources → activités → évaluations**, avec un état « objectif atteint » (indicateurs 5, 6, 8 et 11).
- [ ] **Fiche formation complète** (indicateur 1) : objectifs, public, prérequis, durée, modalités, méthodes, programme, évaluation, accessibilité et handicap, certification, financement, délais d'accès, tarifs, résultats, contact ; la présentation du cours n'en a aujourd'hui qu'une partie.
- [ ] **Page « Comment va se dérouler ma formation ? »** (indicateur 9).
- [ ] **Positionnement initial** et analyse du besoin, puis exploitation du résultat (indicateurs 4 et 8).
- [ ] **Parcours individualisés** et adaptations, sans exposer les données sensibles liées au handicap (indicateurs 10, 13 à 15).
- [ ] **« Qu'est-ce que j'ai cette semaine ? »** : cours, échéances, devoirs, tests, sessions et activités de la semaine réunis.
- [ ] **Vue semaine du calendrier**, demandée par des clients : Moodle n'a que le mois, le jour et les événements à venir, tous pilotés par son JavaScript. Piste retenue : un plugin à part, éventuellement payant, plutôt que le thème. Il marcherait avec n'importe quel thème, garderait Épure léger, et Épure afficherait son lien quand il est installé (comme il détecte IOMAD). Le plugin reste sous licence GPL : on vend le téléchargement, les mises à jour et le support, mais un acheteur peut le redistribuer, et le répertoire moodle.org/plugins ne liste que des plugins téléchargeables gratuitement.
- [ ] **Notifications hiérarchisées** : ce qui demande une action d'abord (« test à terminer avant demain » avant « 3 nouveaux messages »), puis une **communication unifiée** (messagerie, forums, commentaires, annonces, notifications) qui montre ce qui demande l'attention.
- [ ] **Formulaires de Moodle repensés** au-delà de l'apparence (0.27.0) : regroupement, champs conditionnels, aide, erreurs, options essentielles d'abord.
- [ ] **Tableaux de Moodle et d'IOMAD utilisables sur téléphone** : tri, filtres, pagination et actions cohérents, sans tableaux de douze colonnes.
- [ ] **Petites finitions** : pages d'erreur (page introuvable, accès refusé, session expirée, activité inaccessible) aux couleurs d'Épure ; visites guidées de Moodle restylées ; identité de marque dans les exports PDF, les rapports et les pages imprimées ; modèle d'attestation aux couleurs de la marque pour `tool_certificate` (seules les attestations IOMAD l'ont).

### IOMAD

- [ ] **Chaîne entreprise → formation → groupe → apprenants → progression → résultats** dans une même vue, que les administrateurs reconstituent aujourd'hui à la main.
- [ ] **Rapports d'entreprise avec graphiques** aux couleurs de la marque de l'entreprise.
- Règle : les liens vers les rapports d'IOMAD n'apparaissent que si IOMAD est présent, selon les capacités et le périmètre de l'entreprise.

### Écarté

- Un « module Qualiopi », un « rapport » ou un « PDF Qualiopi » ; les dossiers administratifs (contrats, facturation, conventions, sous-traitants, CV des formateurs, veille réglementaire, RH, comptabilité) : « sinon on finit par recréer un ERP ». Les indicateurs Qualiopi organisationnels (21 à 25, 27, l'essentiel des 28 et 29) restent hors du thème.
- Éclater Épure en plusieurs plugins : tout reste dans un seul thème (la vue semaine, complément optionnel, fait exception).
- Les rapports propres à IOMAD (licences, entreprises, e-mails sortants, présence aux séances) pour Moodle seul.
- Un nouveau moteur de rapports qui concurrencerait Kopere ou remplacerait d'emblée les rapports de Moodle : on porte le contenu utile des rapports d'IOMAD et on renvoie vers les rapports existants.
- Les fonctions ajoutées « pour remplir le thème », un thème trop configurable (« 25 couleurs »), transformer Moodle en 360Learning.

## Questions ouvertes

- Rapports : s'adressent-ils d'abord aux formateurs et responsables pédagogiques, ou aussi aux directions d'organismes ?
- Traductions : le répertoire moodle.org/plugins n'accepte que l'anglais dans le plugin, les autres langues passent par AMOS. Le français est inclus pendant le développement et sera transféré dans AMOS avant la publication, par Eric Falcon, qui a déjà traduit IOMAD.
- Nom : « Épure » (`theme_epure`) n'est pas utilisé dans le répertoire des plugins Moodle.
- Modèle de diffusion : gratuit sur moodle.org, ou gratuit avec services payants (installation, personnalisation, support). La licence est GPL dans tous les cas.
