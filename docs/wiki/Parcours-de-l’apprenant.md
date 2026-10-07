Ce que voient les apprenants et les enseignants, du tableau de bord jusqu’aux activités.

## Tableau de bord de l'apprenant

Pour un utilisateur qui suit des cours, le tableau de bord commence par un aperçu, au-dessus des blocs de Moodle :

- **Reprendre où vous en étiez** : le dernier cours visité et pas encore terminé, avec son image, sa progression, sa prochaine activité et un bouton pour continuer ;
- **En cours** : les autres cours en cours, avec leur progression, et un lien vers « Mes cours » ;
- **À venir** : les prochaines échéances de tous ses cours (devoirs à rendre, tests qui ferment…) ;
- **Terminé** : les cours terminés, avec leur date, et un lien vers ses attestations quand la plateforme en délivre (IOMAD, Certificate, Custom certificate).

L'aperçu se désactive dans l'onglet Pages et navigation du thème (« Aperçu de l'apprenant sur le tableau de bord ») ; avec IOMAD, chaque entreprise peut faire un autre choix dans sa fiche.

## Page de cours

En tête de chaque cours, une **bannière** reprend l'image du cours (ou un motif généré), sa catégorie et son titre, avec le fil d'Ariane et les actions habituelles de Moodle. Ensuite, selon le rôle :

- **apprenant** : sa progression, la prochaine activité à faire, la prochaine échéance, et un bouton **Continuer** qui y mène ;
- **enseignant** : les participants, les apprenants actifs cette semaine, les devoirs à corriger, et des accès directs (participants, notes, paramètres) ;
- **visiteur** (invité, utilisateur non inscrit) : l'image, la catégorie et le titre seulement.

Pour l'apprenant, le titre de chaque section indique combien de ses activités il a terminées (« 2/5 », coche une fois la section terminée). La bannière se désactive dans l'onglet Pages et navigation du thème (« Bannière des cours ») ; avec IOMAD, chaque entreprise peut faire un autre choix dans sa fiche.

## Catalogue des cours

La page des cours (`/course/index.php`) devient un **catalogue** : les sous-catégories en pastilles avec leur nombre de cours, puis les cours de la catégorie et de ses sous-catégories en **cartes** (image, catégorie, nom, résumé, enseignants). Chaque carte indique si l'utilisateur est **inscrit**, ou comment entrer dans le cours (**inscription libre**, **accès invité**). La barre de Moodle reste en haut (menu des catégories, recherche, actions de gestion). Les résultats de la recherche de cours s'affichent avec les mêmes cartes.

Avant l'inscription, la page d'inscription d'un cours le **présente** : bannière avec l'image et un bouton vers les options d'inscription, résumé, **programme** (sections et nombre d'activités), enseignants, dates, contenu par type d'activité et champs personnalisés du cours. Les sections et activités cachées n'y figurent pas.

Avec IOMAD, le catalogue ne montre que les catégories et les cours qu'IOMAD autorise à l'utilisateur. Le catalogue et la présentation se désactivent dans l'onglet Pages et navigation du thème (« Catalogue des cours »).

## Pages d'activité

Dans Moodle 4 et 5, avec le sommaire latéral, les liens vers l'activité précédente et suivante ont disparu. Épure les rétablit sur chaque page d'activité :

- **en haut**, une bande avec le cours (lien de retour), la position de l'activité (« Activité 3 sur 12 »), la progression de l'apprenant et un bouton **Mode lecture** ;
- **en bas**, l'activité précédente et la suivante en cartes (icône, nom, section) ; après la dernière, une carte ramène au cours. Les étiquettes et les activités invisibles pour l'utilisateur sont ignorées.

Le **mode lecture** masque les panneaux latéraux et centre le contenu ; il est gardé dans le profil de l'utilisateur, et la touche Échap le quitte. Le bouton **Marquer comme terminé** est agrandi et prend la couleur de la marque. Ces ajouts se désactivent dans l'onglet Pages et navigation du thème (« Pages d'activité »).
