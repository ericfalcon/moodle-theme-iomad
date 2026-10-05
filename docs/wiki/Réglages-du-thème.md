Les réglages se trouvent dans Administration du site › Présentation › Thèmes › Épure.

## Réglages généraux

| Réglage | Effet |
|---|---|
| Couleur de marque | Toute la palette en est déduite : survols, fonds teintés, couleur des liens. Les couleurs sont ajustées automatiquement pour respecter les contrastes AA des WCAG 2.2, et le contraste obtenu est affiché sous le réglage. |
| Police | Polices fournies : IBM Plex Sans, Inter, Source Sans 3, Figtree, Lato, et pour la lisibilité Atkinson Hyperlegible, Lexend, OpenDyslexic. Ou votre propre police téléversée. |
| Police téléversée | Nom de la police et fichiers `.woff2` ou `.woff` (normal obligatoire, gras facultatif). Vérifiez que la licence de la police autorise l'usage sur un site web. |
| Arrondis | Net, doux ou arrondi : cartes, boutons et champs. |

Sous la couleur de marque, le thème propose les **couleurs du logo** enregistré, y compris les couleurs d'accent qui occupent peu de place (lettrage fin, petit emblème) : cliquez sur une pastille, ou directement sur un point du logo (pipette), puis enregistrez. Seuls les codes hexadécimaux sont acceptés, car la palette accessible en est calculée.

Toutes les polices sont servies par votre propre site. Le thème ne fait **aucun appel à Google Fonts** ni à un autre service externe.

## Page Mes cours

Les cours que vous **animez** et ceux que vous **suivez** sont présentés en deux sections (« Formations que j'anime », « Formations que je suis », avec vos mots de vocabulaire). Avec un seul rôle, la page affiche une liste unique.

| Carte d'un cours suivi | Carte d'un cours animé |
|---|---|
| Progression, prochaine activité à faire, prochaine échéance, bouton Commencer / Continuer / Revoir, mention Terminé | Bandeau et badge de rôle, participants, apprenants actifs cette semaine, devoirs à corriger, accès directs Participants, Notes, Paramètres |

Une recherche (insensible aux accents) et des filtres En cours, À venir, Passés complètent la page. Les cours favoris viennent en premier, puis les plus récemment consultés ; les cours que vous avez masqués restent masqués. Un enseignant est reconnu à sa capacité de voir toutes les notes du cours (`moodle/grade:viewall`). Avec IOMAD, qui remplace le bloc de Moodle par le sien (« Mes cours » avec les onglets disponibles, en cours, terminés), la même présentation s'applique, avec en plus une section « Formations disponibles » et le bouton de téléchargement des certificats d'IOMAD. Réglage « Mes cours par rôle » (Réglages généraux) : décochez pour retrouver le bloc de Moodle ou d'IOMAD.

## En-tête

| Réglage | Effet |
|---|---|
| Couleur de l'en-tête | Blanc avec soulignement de la couleur de marque, ou rempli de la couleur de marque. Les textes et icônes prennent la couleur la plus lisible. |
| Logo | Affiché dans l'en-tête et sur la page de connexion. Les fonds transparents sont pris en charge (SVG, PNG, WebP). Sans logo, ceux d'Apparence › Logos sont utilisés. |
| Logo pour l'en-tête en couleur | Facultatif : une version lisible sur la couleur de marque, souvent blanche sur fond transparent. |

## Page de connexion

| Réglage | Effet |
|---|---|
| Disposition | Écran partagé : un visuel de la couleur de marque à côté du formulaire de Moodle (sur téléphone, seul le formulaire s'affiche). Ou formulaire centré. |
| Accroche et texte d'accompagnement | Affichés sur le visuel. Sans accroche, une phrase par défaut est utilisée. |
| Image de fond | Facultative. Un voile de la couleur de marque est posé dessus, avec l'opacité nécessaire pour que le texte reste lisible (contraste AA) quelle que soit l'image. |

Le formulaire lui-même reste celui de Moodle : il suit chaque version (4.5, 5.0, 5.1) et les méthodes d'authentification configurées.

## Pied de page

En bas de chaque page, page de connexion comprise : le nom du site, un texte libre (par exemple l'adresse de l'établissement), puis les liens **Mentions légales**, **Données personnelles**, **Accessibilité : …** (une fois la déclaration publiée) et **Contact**, et des liens libres. Il se règle dans l'onglet **Pied de page** des réglages du thème ; avec IOMAD, chaque entreprise peut avoir ses propres texte et liens (fiche de l'entreprise › Apparence). Laissés vides, les liens « Données personnelles » et « Contact » reprennent ceux de Moodle quand il en a (politiques du site, formulaire du support).

## Réglages avancés

SCSS initial (pour redéfinir des variables) et SCSS ajouté à la fin de la feuille de style.
