Voir aussi le [[rapport de pré-audit|Pré-audit-d’accessibilité]].

Le thème vise les WCAG 2.2 niveau AA, le RGAA 4.1.2 et l'EN 301 549 : contrastes calculés, focus clavier toujours visible, lien d'évitement, cibles d'au moins 24 × 24 px, liens soulignés dans le texte, respect du réglage « réduire les animations ».

**Préférences d'affichage.** Le bouton **Aa** de l'en-tête (raccourci Alt + A) ouvre un panneau où chaque utilisateur connecté choisit :

- la taille du texte : petite, normale, grande ou très grande (90, 100, 115 ou 130 %) ;
- une police de lecture : celle du site, Atkinson Hyperlegible ou OpenDyslexic ;
- un texte plus espacé (valeurs du critère WCAG 1.4.12), un contraste renforcé, des liens soulignés, des animations réduites.

Le changement est immédiat, puis enregistré dans les préférences de son profil Moodle : il vaut sur toutes les pages et tous ses appareils, dès le premier affichage. Ces préférences sont déclarées à l'API de confidentialité et exportées avec les données de l'utilisateur.

**Affichage par défaut.** Les visiteurs non connectés, les invités et les utilisateurs qui n'ont pas choisi leur affichage ont celui du site. Il se règle dans l'onglet **Accessibilité** des réglages du thème, partie Préférences d'affichage : taille du texte, police de lecture, texte plus espacé, contraste renforcé, liens soulignés, animations réduites. Une préférence choisie par l'utilisateur l'emporte sur celle du site.

**Bouton « Aa ».** Il se désactive dans le même onglet : les utilisateurs ne peuvent plus changer leur affichage, et les préférences déjà choisies continuent de s'appliquer.

**Déclaration d'accessibilité.** L'onglet **Accessibilité** des réglages du thème la remplit au format français (RGAA) : état de conformité, entité, taux de conformité, auditeur et date de l'audit, non-conformités, dérogations, contenus non soumis, contact (par défaut, le courriel du support). Tant qu'aucun état n'est choisi, rien n'est publié. Une fois l'état choisi :

- la déclaration est publiée à l'adresse `/theme/epure/accessibility.php`, lisible sans compte. Elle liste aussi les mesures d'accessibilité prises par le thème (contrastes, clavier, structure, agrandissement, préférences d'affichage, tests automatiques), et les voies de recours auprès du Défenseur des droits ; une adresse électronique saisie comme contact devient un lien ;
- la mention « Accessibilité : partiellement conforme » (selon l'état) apparaît en bas de chaque page, et un lien dans le pied de page.

Un thème ne rend pas une plateforme conforme à lui seul : les contenus des cours comptent aussi, et un audit manuel reste nécessaire avant de déclarer la conformité.
