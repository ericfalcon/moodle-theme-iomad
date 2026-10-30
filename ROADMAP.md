# Feuille de route — Épure

Ce document fige les décisions prises pendant la phase de conception. Il sert de référence pour le développement et pour les contributeurs.

La maquette interactive qui a servi à valider ces choix montre chaque écran décrit ici.

## Vision

Moodle « fait vieux » face aux plateformes payantes (360Learning, TalentLMS, LearnWorlds…). Épure lui donne le rendu d'une plateforme moderne, **sobre et professionnelle**, sans transformer l'administration en usine à réglages.

Principes :

1. **Peu de réglages, mais chacun change beaucoup de choses.** L'administrateur fait des choix ; le thème calcule le reste (palette, contrastes, variantes).
2. **Accessible par construction.** Les contrastes, le focus, la navigation au clavier et les préférences d'affichage ne dépendent pas de la bonne volonté de l'administrateur.
3. **Le moins de templates surchargés possible.** Chaque template surchargé est un coût à chaque mise à jour de Moodle. On privilégie le SCSS et les variables.
4. **Un thème complet et gratuit**, qui fonctionne sur Moodle et s'adapte à IOMAD lorsqu'il le détecte. Les fonctions de pilotage (rapports, suivi Qualiopi, calendrier semaine) pourront faire l'objet de **plugins séparés**, gratuits et sous GPL comme le thème, que le thème détecte.
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

Plugins complémentaires (possibles, pas d'offre payante) : des plugins séparés, gratuits et sous GPL comme tout code lié à Moodle. Ils fonctionnent avec n'importe quel thème ; Épure les détecte, comme IOMAD, et affiche leurs liens quand ils sont installés. Leurs données (rapports, historique) ne dépendent pas de l'apparence et restent quand on change de thème.

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
| Arrondis | Peu, moyennement ou très arrondis | Cartes, boutons, champs |
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

## Fait

Le détail de chaque version est dans `CHANGES.md`.

- **V0.1 à V0.3 — Fondations, identité, accessibilité** : thème enfant de Boost, palette accessible calculée depuis une couleur, polices embarquées, en-tête et logos, connexion en écran partagé, pied de page, préférences d'affichage (bouton Aa), déclaration d'accessibilité, audit axe-core en intégration continue (Moodle 4.5 à 5.3, MariaDB).
- **V0.4 — Parcours de l'apprenant** : Mes cours par rôle, bannière et progression du cours, tableau de bord de l'apprenant, mode sombre, pages d'activité, catalogue, barre de navigation mobile, recherche rapide Ctrl+K, e-mails aux couleurs de la marque.
- **V0.5 — Vocabulaire et IOMAD** : vocabulaire réglable appliqué à tout Moodle et par entreprise, tableau de bord d'IOMAD, logo, couleur et vocabulaire dans la fiche de l'entreprise, chiffres clés.
- **0.21 à 0.28 — Bêta et couverture graphique** : pré-audit d'accessibilité (240 pages), documentation, releases automatiques, réglages rangés par sujet, application web installable, icônes d'activités, H5P, tests, forums, devoirs, SCORM, livres, badges, attestations, carnet de notes, calendrier, formulaires, messagerie en bulles, sondage, profil, base de données, wiki, feedback, sélecteur d'activités, audit du bleu Moodle restant.
- **0.46 — Accessibilité des contenus** : à l'enregistrement d'un formulaire, les erreurs courantes des éditeurs (images sans texte alternatif, tableaux sans en-têtes, liens « cliquez ici », titres sautés) listées avec « Corriger », le vérificateur de TinyMCE et « Enregistrer quand même ». Sans compte ni inscription.
- **0.44 et 0.45 — Corriger** : « À corriger » compte aussi les tests à noter à la main et mène à la bonne page (liste des activités à corriger dans le bandeau du cours) ; interface de notation des devoirs plus lisible (statuts en pastilles, devoir et note en carte, navigation entre apprenants en boutons).
- **0.43 — Tableaux sur téléphone** : participants, vue d'ensemble des notes, journaux, rapports du générateur de rapports et rapports IOMAD en cartes, chaque valeur nommée par sa colonne.
- **0.42 — Vue simplifiée de l'apprenant** (réglage, site et entreprise, désactivé par défaut) : navigation du cours réduite à Cours, Notes et Badges, le reste sous « Plus » ; menu utilisateur allégé ; tiroir des blocs fermé ; aide discrète. « Badges » seulement quand le cours en a.
- **0.40 et 0.41 — Lecture et profil** : leçons lues comme un texte (environ 70 caractères par ligne, titres hiérarchisés) ; polices variables, deux fois plus légères ; profil ouvert par un résumé (cours, badges, attestations, connexion précédente, « Modifier le profil » bien visible), cartes secondaires sous « Plus d'informations ».
- **0.38 — États vides utiles** : « Pas encore de cours » avec le catalogue, « Aucune activité ne requiert d'action » avec le calendrier, cours tous terminés, éléments récents, notifications ; une phrase claire et l'étape suivante, dans le vocabulaire choisi. Vocabulaire par entreprise étendu aux cours, étudiants et enseignants (0.37.1).
- **0.37 — Mes réussites** : sur le tableau de bord, carte « Mes réussites » (derniers badges en vignettes, dernières attestations : Certificate, Custom certificate, IOMAD) ; la même galerie sur son propre profil, avec tous ses badges, publics ou non. Le profil des autres garde leurs badges publics.
- **0.36 — Mes notes** : total du cours en carte (note, barème, pourcentage, éléments notés), commentaire du formateur en bulle, une carte par note sur téléphone.
- **0.35 — Relire un test** : résultat en tête (note, réussi ou non, réponses correctes, fausses, sans réponse), « À revoir » pour ne garder que les questions ratées, détails en tuiles, état de chaque question en pastille, bonne réponse mise en avant.
- **0.34 — Passer un test sereinement** : questions en cartes (bandeau en haut, choix en lignes faciles à toucher), récapitulatif avec « Avant d’envoyer » en haut (questions sans réponse, marquées, boutons), confirmation d’envoi en bas de l’écran, légende du panneau des questions, minuteur calme toujours visible.
- **0.33 — Cette semaine** : sur le tableau de bord de l'apprenant, la semaine jour par jour dans tous ses cours (échéances avec leur état, séances et événements du calendrier), les activités en retard d'abord.
- **0.32 — État du parcours détaillé** : « 3 terminées · 1 en cours · 1 en retard » sous la barre de progression ; « Continuer » toujours à portée de pouce sur téléphone.
- **0.31 — « Continuer » plus intelligent** : échéance dans les 48 heures d'abord, puis l'activité commencée, puis celle qui suit la dernière terminée ; « 4 activités restantes · à rendre demain » ; le même choix sur le tableau de bord, la bannière et la page de cours.
- **0.30 — Progression par section** : barre de progression de chaque section sur la page de cours et dans l'index ; activité à reprendre et sa section mises en évidence.
- **0.29 — États des activités** : un état par activité pour l'apprenant (en retard, échéance proche, en cours, réussi ou non, terminé, à faire, verrouillé, facultatif), avec le même libellé, la même icône et la même couleur sur la page de cours, dans l'index et pour l'activité suivante du tableau de bord.
- **0.28.1 à 0.28.12 — Finitions** : réglages d'entreprise IOMAD complets (identité, connexion, fonctions, e-mails), police par entreprise, pages d'erreur, visites guidées, impression aux couleurs de la marque, bulles d'aide et notifications en mode sombre, en-tête IOMAD et panneau Aa sur téléphone, anneaux de focus aux couleurs de l'entreprise, aperçu de la couleur de marque fidèle au champ, thème de l'entreprise de l'utilisateur quand une autre entreprise a l'adresse du site.

## Épure, le thème (gratuit)

### Comment on avance

- **Un petit chantier par version.** Chaque version apporte un seul bénéfice visible, tient en une à deux semaines et peut être publiée seule. Un chantier trop gros est découpé.
- **L'apprenant d'abord, puis le formateur, puis l'administrateur.** On commence par ce qui aide à apprendre : savoir où l'on en est, quoi faire ensuite, comprendre ses résultats. L'apparence seule passe après.
- **Pas de nouveau réglage, sauf exception justifiée.** Un réglage au plus par version, désactivé par défaut.
- **Le technique se fait en continu** dans les versions de correctif (0.x.y), jamais comme une version à part.
- **Fini veut dire testé** sur Moodle 4.5 à 5.3 et IOMAD, en clair et en sombre, sur ordinateur et sur téléphone, avec l'audit axe-core vert.
- L'ordre compte plus que les numéros : une demande de client peut faire passer un chantier devant.

### 1. Savoir où j'en suis (apprenant)

- [x] **0.29 — États des activités unifiés** : à faire, en cours, terminé, verrouillé, échéance proche ou dépassée, réussi, facultatif. Même couleur, même icône et même libellé partout (page de cours, index, tableau de bord). C'est la base des chantiers suivants.
- [x] **0.30 — Progression par section** : dans l'index du cours et en tête de chaque section, une barre et « 3 sur 5 terminées » ; l'activité en cours et la section recommandée sont mises en évidence.
- [x] **0.31 — Carte « Continuer » plus intelligente**, sur le tableau de bord et la bannière du cours : une phrase actionnable (« 3 activités restantes · échéance dans 2 jours »). L'activité suivante est celle qui suit la dernière terminée, ou la dernière commencée et pas finie ; une échéance à moins de 48 heures passe devant (« À rendre demain »). Mêmes calculs que la progression par section.
- [x] **0.32 — État du parcours détaillé** : « 67 % → 8 activités terminées, 2 en cours, 1 en retard », sous la barre de progression du cours ; sur téléphone, bouton « Continuer » toujours visible en bas de la page de cours.
- [x] **0.33 — « Qu'est-ce que j'ai cette semaine ? »** dans le tableau de bord de l'apprenant : échéances, devoirs, tests et sessions des 7 prochains jours.

### 2. Comprendre mes résultats (apprenant)

- [x] **0.34 — Passer un test sereinement** : panneau des questions lisible (répondue, marquée, en cours), minuteur visible sans être anxiogène, récapitulatif clair avant de terminer.
- [x] **0.35 — Relire un test** : bonne réponse, rétroaction et note lisibles, question par question.
- [x] **0.36 — Mes notes** (rapport « Utilisateur » du carnet) : lecture par cours, note et barème, commentaire du formateur mis en avant, cartes sur téléphone.
- [x] **0.37 — Mes réussites** : sur le tableau de bord, une carte avec les derniers badges en vignettes et les attestations obtenues ; sur son propre profil, la même galerie. Sur le profil d'un autre, seuls ses badges publics.

### 3. Une plateforme plus simple (apprenant)

- [x] **0.38 — États vides utiles** : « aucun cours », « aucun devoir », « aucune notification » avec un message clair et l'action suivante.
- [-] **0.39 — Notifications hiérarchisées** : ce qui demande une action d'abord. Écartée : le tableau de bord de l'apprenant (« Cette semaine », en retard d'abord) le montre déjà.
- [x] **0.40 — Lecture confortable** : pages, livres et leçons sur une largeur de lecture d'environ 70 caractères, interlignage adapté ; polices variables quand elles existent, pour des fichiers plus légers.
- [x] **0.41 — Profil** : bouton « Modifier le profil » bien placé sur téléphone ; sur son propre profil, un résumé en haut (cours en cours, attestations, dernière connexion) ; cartes regroupées d'après les irritants relevés.
- [x] **0.42 — Vue simplifiée de l'apprenant** : un seul réglage, pour le site et par entreprise IOMAD, désactivé par défaut. Pour qui ne peut pas gérer les activités (`moodle/course:manageactivities`) : navigation du cours réduite à « Cours » et « Notes », plus « Badges » quand le cours a au moins un badge actif (le reste dans un menu discret), menu utilisateur réduit (Profil, Notes, Préférences, Déconnexion), tiroir des blocs fermé, bouton « ? » replié, options secondaires des activités sous « Plus ». Tout est regroupé, jamais retiré : chaque page reste accessible par son adresse et au clavier. L'aide du réglage prévient les formateurs que leurs apprenants ne voient plus tout.
- [x] **0.42 bis — Badges du cours** : avec Épure, l'onglet « Badges » du cours n'apparaît que si le cours a au moins un badge actif (Moodle l'affiche même vide), ou pour qui peut y créer des badges.
- [x] **0.43 — Tableaux sur téléphone** : participants, rapports et carnet en cartes plutôt qu'en tableaux à faire défiler.

### 4. Le formateur

- [x] **0.44 — Évaluations en attente** : les tests à corriger à la main rejoignent les devoirs dans les raccourcis du formateur.
- [x] **0.45 — Correction des devoirs** : panneau de notes, navigation entre apprenants et commentaires plus lisibles.
- [x] **0.46 — Accessibilité des contenus** : le vérificateur d'accessibilité de l'éditeur TinyMCE (intégré à Moodle, sans compte ni inscription) mis en avant pour les formateurs, avec des rappels des erreurs courantes (image sans texte alternatif, titres, contrastes, tableaux sans en-têtes). Brickfield, qui demande une inscription, reste une option s'il est déjà activé. Pas de scanner maison.
- [x] **0.47 — Mode édition du cours** (publiée en 0.49.0) : bandeau « Mode édition activé » avec « Terminer l'édition », boutons d'ajout bien visibles (toujours affichés entre les activités et les sections sur écran tactile), menus d'actions plus lisibles avec « Supprimer » à part, édition groupée mise en avant. Seul l'aspect change : le JavaScript de Moodle n'est pas touché.
- [x] **0.48 — Sélecteur de fichiers** : fenêtre, arborescence et boutons modernisés.
- [x] **0.52 — Formulaires longs** (paramètres du cours, des activités et des sections, formulaires du tableau de bord IOMAD) : les boutons d'enregistrement restent en bas de l'écran ; sur grand écran, un sommaire des sections à côté du formulaire ouvre et affiche chacune, les sections en erreur signalées. Les champs, leur ordre et l'enregistrement restent ceux de Moodle. Les sections deviennent des cartes, et les listes de liens (administration du site et du cours, catégories, rapports du cours, tableau de bord IOMAD) prennent partout la présentation des préférences. Le thème passe en maturité RC (version candidate).

- [x] **0.56 — Ajouter un bloc** (publiée en 0.53.0) : la fenêtre « Ajouter un bloc » avec une recherche en haut, une icône par bloc et un bouton « Ajouter » sur chaque ligne, présentée comme les listes des préférences (Moodle en fait une longue liste de liens sans recherche) ; en mode édition, un emplacement « Ajouter un bloc » en pointillés dans le tiroir des blocs, avec une phrase d'aide (« Chronologie, calendrier, badges… »), comme les boutons d'ajout du mode édition du cours. Sans nouveau réglage. Idée reprise du thème Retani Studio, vu sur r/moodle.
- [x] **0.57 — Résumé du cours sous son titre** (publiée en 0.53.0) : « 5 sections · 26 activités » dans la bannière du cours, pour le formateur, à côté de ses chiffres (participants, actifs, à corriger). Sans nouveau réglage.

### 5. S'informer et prendre en main

- [-] **0.49 — Fiche formation et « Comment va se dérouler ma formation ? »** (indicateurs Qualiopi 1 et 9). Déplacée : elle fera partie d'un plugin Qualiopi séparé (voir « Plugins complémentaires › Pilotage pédagogique et Qualiopi »).
- [x] **0.50 — Prise en main par rôle** : un message d'accueil et une visite guidée courte pour l'apprenant (tableau de bord), le formateur (page de cours) et le gestionnaire (tableau de bord), uniquement quand Épure est le thème actif. Ce sont des visites guidées de Moodle, créées une fois avec le thème et modifiables par l'administrateur, avec un filtre « Public d'Épure ».
- [x] **0.53 — Ma synthèse** (publiée en 0.54.0) : une page imprimable en PDF par l'apprenant (cours suivis, progression, notes, attestations). Un réglage, désactivé par défaut. Un relevé de formation plus complet relèverait d'un plugin de rapports.
- [-] **Recherche rapide** : recherches récentes dans Ctrl+K. Écartée : peu utile, la recherche rapide trouve déjà les cours, les activités et les pages d'administration en quelques lettres.

### 6. L'administrateur

- [x] **0.51 — Administration en cartes** : sur l'accueil, des cartes de tâches courantes (Utilisateurs, Cours, Apparence, Plugins, Rapports, Serveur, IOMAD) ; dans chaque onglet de l'administration, les rubriques en cartes. Rien n'est retiré de l'arborescence.
- [x] **0.54 — Déclaration d'accessibilité guidée** (publiée en 0.55.0) : un formulaire pas à pas et une version imprimable. Aucun état de conformité calculé automatiquement : c'est l'audit qui le donne.
- [ ] **0.55 — Modèle d'attestation aux couleurs de la marque pour `tool_certificate`** ; l'option « cadre d'attestation à la couleur de la marque » des entreprises IOMAD est conservée.

### En continu (versions de correctif)

- [ ] **Moins de surcharges** : déplacer ce qui peut l'être de `core_renderer` vers les hooks de Moodle (haut de page, pied de page, reste de l'en-tête), chacun limité au thème Épure et couvert par un test ; réduire les `!important` du SCSS.
- [ ] **Micro-interactions harmonisées** : mêmes durées et mêmes transitions partout, coupées par « réduire les animations ».
- [ ] Corrections remontées par les utilisateurs, en priorité celles qui gênent l'apprentissage.

### V1.0 — Publication

- [ ] Audit d'accessibilité manuel (RGAA) par un auditeur.
- [ ] Transfert du français dans AMOS, puis publication sur moodle.org/plugins.

### Après la V1.0

- [ ] **Vocabulaire dans d'autres langues**, une langue à la fois et à la demande de clients : espagnol, italien ou portugais d'abord (grammaire proche du français), allemand plus tard (déclinaisons, mots composés). Chaque langue demande un relecteur natif et un jeu de phrases de test.

## Plugins complémentaires (possibles)

Il n'y aura pas d'offre payante (« Épure Pro » est abandonné). Ce qui dépasse le thème (rapports, pilotage pédagogique, Qualiopi, calendrier semaine) pourra devenir des **plugins séparés**, gratuits et sous GPL, créés au besoin. Le thème les détecte et affiche leurs liens quand ils sont installés ; ils fonctionnent aussi avec un autre thème. Avant chaque fonction, on vérifie ce que Moodle, IOMAD et Kopere Dashboard font déjà, pour ne pas le refaire.

Ordre : le même principe que pour le thème, des petits plugins et la pédagogie d'abord. Le premier est le **pilotage pédagogique du formateur** (« À surveiller », suivi du distanciel) ; viennent ensuite les rapports, le calendrier semaine et les vues IOMAD.

### Rapports

Repris des rapports d'IOMAD, lus dans les données de Moodle ; sur un site IOMAD, renvoi vers les rapports d'IOMAD.

- [ ] **Synthèse d'achèvement par cours**, avec graphique : inscrits, jamais venus, en cours, terminés, taux d'achèvement, note moyenne ; un clic mène au détail natif (`report/completion`, `report/progress`).
- [ ] **Grille apprenants × cours**, filtrée par catégorie ou cohorte, avec la **validité et le recyclage** des formations réglementaires.
- [ ] **Achèvements par mois** : histogramme pour le bilan annuel.
- [ ] **Relevé de formation d'un apprenant** : tous ses cours, exportable en PDF et CSV.
- [ ] **Historique des achèvements** conservé après une réinitialisation de cours (table d'archive).
- [ ] **Temps passé** estimé depuis les journaux, pour prouver l'assiduité en formation à distance financée.
- [ ] Une page « Rapports » qui les regroupe.

Choix techniques : graphiques `core\chart_*` et exports `\core\dataformat` ; mêmes définitions que les écrans d'Épure (« actif », « commencé », « terminé ») grâce à un service de suivi commun ; capacités de Moodle en respectant les groupes séparés ; requêtes groupées, pagination et cache ; RGPD (accès par capacité, fournisseur de confidentialité pour toute table) ; prévenir que les connexions dépendent de la durée de conservation des journaux.

### Pilotage pédagogique et Qualiopi

- [ ] **Nouveau référentiel Qualiopi** : d'après nos échanges, un décret du 1er août 2026 l'applique à partir du 1er novembre 2026, avec 7 critères et 33 indicateurs (12 : prévention des violences et discriminations ; 19 : suivi effectif des modules à distance ; 32 : analyse des risques). **À vérifier sur le texte officiel** et sur le guide de lecture avant de s'y appuyer.
- [ ] **Fiche formation et « Comment va se dérouler ma formation ? »** (indicateurs 1 et 9), à partir de champs personnalisés de cours, sur la présentation du cours ; reprise de la 0.49 du thème. Épure l'affiche quand le plugin est installé.
- [ ] **Synthèse pédagogique d'un cours** : corrections en attente, apprenants sans activité depuis une durée réglable, progression médiane, activités problématiques.
- [ ] **Tableau de bord « À surveiller » du formateur** et **état du groupe** : sans activité, en retard, bloqués (indicateurs 11, 12 et 19).
- [ ] **Suivi du distanciel** (indicateur 19) : par apprenant, situation en vert, orange ou rouge.
- [ ] **Pilotage sur plusieurs cours** pour les responsables, dans le respect du cloisonnement des entreprises IOMAD ; **comparaison des sessions et des périodes**.
- [ ] **Vue de coordination** des intervenants (indicateur 18).
- [ ] **Satisfaction consolidée** (indicateur 30) et **évaluation pédagogique distincte de la satisfaction**.
- [ ] **« Signaler une difficulté »** (indicateur 31) et **tableau d'amélioration continue** puis analyse des risques (indicateur 32).
- [ ] Plus tard : positionnement initial (4 et 8), parcours individualisés (10, 13 à 15), objectifs → activités → évaluations (5, 6, 8, 11), certifications et blocs de compétences (3, 7, 16), fonctions propres aux CFA (20).
- L'accessibilité native d'Épure est un argument pour l'indicateur 26 (handicap) ; rien à développer.

### Calendrier

- [ ] **Vue semaine**, demandée par des clients : Moodle n'a que le mois, le jour et les événements à venir.

### IOMAD

- [ ] **Chaîne entreprise → formation → groupe → apprenants → progression → résultats** dans une même vue.
- [ ] **Rapports d'entreprise avec graphiques** aux couleurs de l'entreprise.
- Règle : les liens vers les rapports d'IOMAD n'apparaissent que si IOMAD est présent, selon les capacités et le périmètre de l'entreprise.

## Méthode

- [ ] **Audit des rapports existants** (Moodle, IOMAD, Kopere Dashboard) avant de créer un plugin de rapports.
- [ ] **Matrice Qualiopi × Moodle × IOMAD × Épure**, indicateur par indicateur, une fois le texte officiel vérifié.
- [ ] **Comparaison avec les thèmes concurrents** (Boost Union, Moove, Adaptable, RemUI…) : accessibilité, modernité, IOMAD, mobile, irritants résolus, et ce qu'ils vendent dans leur version payante.
- [ ] **Un service de suivi pédagogique commun** au thème et aux plugins complémentaires, pour que la bannière, Mes cours, le tableau de bord et les rapports donnent toujours les mêmes chiffres. Il naît avec les chantiers 0.29 à 0.32.

## Écarté

- **Connexions et inactifs** comme rapport d'Épure : Moodle le couvre déjà (bloc « Utilisateurs en ligne », filtre « Inactif depuis » des participants, filtres de la liste des utilisateurs) et IOMAD a son rapport des connexions.
- Un « module Qualiopi », un « PDF Qualiopi » ou les dossiers administratifs (contrats, facturation, conventions, CV des formateurs, veille réglementaire) : « sinon on finit par recréer un ERP ». Les indicateurs organisationnels (21 à 25, 27, l'essentiel des 28 et 29) restent hors d'Épure.
- Les rapports propres à IOMAD (licences, entreprises, e-mails sortants, présence aux séances) pour Moodle seul.
- Un nouveau moteur de rapports qui concurrencerait Kopere ou remplacerait d'emblée ceux de Moodle.
- Une offre payante « Épure Pro » (clé par site, abonnement ou licence à vie) : abandonnée au profit de plugins gratuits sous GPL, créés au besoin.
- Les cartes partout, l'aperçu au survol et la recherche dans le contenu des cours : peu utiles, coûteux à maintenir.
- Les fonctions ajoutées « pour remplir le thème », un thème trop configurable (« 25 couleurs »), transformer Moodle en 360Learning.

## Questions ouvertes

- Rapports : s'adressent-ils d'abord aux formateurs et responsables pédagogiques, ou aussi aux directions d'organismes ?
- Traductions : le répertoire moodle.org/plugins n'accepte que l'anglais dans le plugin, les autres langues passent par AMOS. Le français est inclus pendant le développement et sera transféré dans AMOS avant la publication, par Eric Falcon, qui a déjà traduit IOMAD.
- Nom : « Épure » (`theme_epure`) n'est pas utilisé dans le répertoire des plugins Moodle.
