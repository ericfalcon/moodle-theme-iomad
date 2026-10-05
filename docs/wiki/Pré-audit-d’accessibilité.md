Pré-audit réalisé le 5 octobre 2026 sur Épure 0.21.0 (bêta). Il s'agit d'un **contrôle automatisé et de vérifications au clavier**, pas d'un audit RGAA complet : il prépare l'audit manuel, qui reste nécessaire avant de déclarer la conformité.

## Méthode

- **Outil** : axe-core 4.13, règles WCAG 2.0, 2.1 et 2.2, niveaux A et AA (les règles « best practice » ne sont pas comptées).
- **Plateformes** : Moodle 4.5 LTS, Moodle 5.1 et IOMAD 4.5, avec des cours, des activités (page, test, devoir, forum) et des inscriptions de test.
- **Profils** : visiteur non connecté (page de connexion), apprenant, enseignant, administrateur ; avec IOMAD, apprenant d'une entreprise et administrateur.
- **Affichages** : clair et sombre sur ordinateur (1300 px), clair sur téléphone (390 px).
- **Pages** (240 pages contrôlées en tout) : connexion, tableau de bord, mes cours, catalogue, recherche de cours, page de cours, page d'inscription, pages d'activité (page, devoir, forum, test), calendrier, notes, profil, préférences, messagerie, déclaration d'accessibilité ; pour l'enseignant, participants, carnet de notes, évaluation d'un devoir ; pour l'administrateur, recherche de l'administration, réglages du thème, utilisateurs, gestion des cours ; avec IOMAD, tableau de bord IOMAD, gestion des cours IOMAD, fiche de l'entreprise.
- **Clavier** : ordre de tabulation de l'en-tête, lien d'évitement, focus visible sur chaque élément, panneau Aa (Alt + A), recherche rapide (Ctrl+K), fermeture par Échap et retour du focus.
- **Redimensionnement** : affichage à 320 px de large (équivalent d'un zoom à 400 %) sans défilement horizontal.

## Résultats

| Plateforme | Pages | Pages en défaut avant corrections | Après corrections |
|---|---|---|---|
| Moodle 4.5 | 83 | 24 | 0 |
| Moodle 5.1 | 83 | 3 (messagerie) | 0 |
| IOMAD 4.5 | 74 | 5 | 0 |

Les tests de navigation au clavier et de redimensionnement sont conformes après correction du focus (ci-dessous).

## Défauts trouvés et corrigés

| Défaut | Critère | Où | Correction |
|---|---|---|---|
| Onglets des réglages du thème mal structurés (éléments de liste dans une liste d'onglets) | WCAG 1.3.1, 4.1.2 | Réglages d'Épure (gabarit de Boost) | Gabarit des onglets remplacé : éléments de liste neutres, chaque onglet relié à son panneau |
| Messagerie masquée aux lecteurs d'écran (`aria-hidden="true"` sur toute la page) | WCAG 4.1.2 | Page Messages (défaut de Moodle) | Attributs retirés à l'affichage de la page, région nommée « Messages » |
| Textes illisibles en mode sombre (fonds blancs ou gris clair) | WCAG 1.4.3 | Carnet de notes, évaluation des devoirs, menu « Plus » des onglets | Fonds et textes du thème sombre appliqués à ces tableaux et à ce menu |
| Cibles de moins de 24 × 24 px | WCAG 2.5.8 | Tri et masquage des colonnes des tableaux, initiales des participants, liens de la recherche de l'administration, menu « Par page », icônes d'aide des en-têtes de tableau (IOMAD) | Taille minimale de 24 px et marge entre cibles voisines |
| Lien distingué seulement par sa couleur | WCAG 1.4.1 | Adresse e-mail du profil | Liens soulignés dans les listes de définitions |
| Contraste du bouton Rechercher dans l'en-tête de l'entreprise (4,35:1) | WCAG 1.4.3 | En-tête aux couleurs de l'entreprise (IOMAD) | Fond transparent : le contraste est celui de l'en-tête, AA |
| Focus peu visible sur les boutons, menus et champs (anneau pâle, ou de la couleur de l'en-tête) | WCAG 2.4.7, 1.4.11 | Menu utilisateur, listes déroulantes, champs de formulaire | Contour de focus du thème prioritaire partout, blanc dans l'en-tête de couleur |

## Ce que le pré-audit ne couvre pas

Un outil automatique ne contrôle qu'une partie des critères. Restent à vérifier par un auditeur, sur un échantillon de pages représentatif de votre plateforme :

- la pertinence des alternatives des images et des intitulés de liens et de boutons ;
- la hiérarchie des titres et la structure des contenus de cours ;
- la restitution par les lecteurs d'écran (NVDA, JAWS, VoiceOver) des composants interactifs : menus, tiroirs, éditeur de texte, tests, carnet de notes ;
- les contenus des cours (documents, vidéos, activités tierces), qui ne dépendent pas du thème ;
- les plugins tiers installés sur la plateforme ;
- les critères RGAA propres aux médias, aux formulaires complexes et aux délais (sessions, tests chronométrés).

Les résultats de l'audit manuel se reportent dans la déclaration d'accessibilité (onglet Accessibilité des réglages du thème).

## Reproduire le pré-audit

Les tests Behat du thème font passer l'audit axe de Moodle (« the page should meet accessibility standards ») à chaque modification, sur le tableau de bord, les préférences d'affichage, la déclaration d'accessibilité, la page de cours, les pages d'activité, le catalogue et la recherche rapide.
