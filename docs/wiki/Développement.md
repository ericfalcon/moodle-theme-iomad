## Organisation du code

- **Styles** : `scss/epure.scss` importe, dans l'ordre de compilation, les fichiers de `scss/epure/` (un par sujet : en-tête, page de cours, activités, mode sombre…). Le mode sombre vient après les règles qu'il remplace.
- **IOMAD** : tout ce qu'Épure utilise d'IOMAD passe par la classe `theme_epure\iomad` : détection, API (entreprise de l'utilisateur, capacités, catégories), contexte d'entreprise, noms des tables et adresses des pages. IOMAD 5.1 a renommé ses tables (`company` devient `local_iomad_companies`…) et ses classes ; cette classe connaît les deux versions, si bien qu'un changement d'IOMAD se traite à un seul endroit.
- **Erreurs** : les erreurs inattendues (thème d'une entreprise, échéances, attestations…) sont signalées en mode débogage développeur, sans interrompre la page.

## Compatibilité testée

L'intégration continue teste Moodle 4.5 à 5.3 (PostgreSQL, et MariaDB pour 4.5 et 5.3) et IOMAD 4.5, 5.1 et 5.2. Les tests Behat couvrent les formats de cours thématique, hebdomadaire (avec une sous-section), activité unique et informel, avec l'audit axe-core.

## Performances

Mesures du 8 octobre 2026 sur Moodle 4.5, en apprenant, comparées au thème Boost (moyenne de 3 chargements, caches chauds, serveur de développement PHP : les durées sont indicatives, les écarts comptent).

| Page | Temps serveur Boost → Épure | HTML | Éléments DOM | Requêtes | LCP Boost → Épure |
|---|---|---|---|---|---|
| Tableau de bord | 212 → 344 ms | +14 % | +11 % | 29 → 32 | 1093 → 423 ms |
| Page de cours | 163 → 168 ms | +11 % | +12 % | 27 → 30 | 855 → 233 ms |
| Discussion de forum | 169 → 171 ms | +9 % | +16 % | 19 → 26 | 245 → 224 ms |
| Test (accueil) | 200 → 217 ms | +10 % | +16 % | 19 → 26 | 285 → 295 ms |

- Feuille de style : 173 Ko contre 158 Ko pour Boost (+9 %). JavaScript : identique (les modules d'Épure sont chargés à la demande).
- Aucun décalage de mise en page (CLS de 0 à 0,001).
- Le surcoût du tableau de bord vient de la vue d'ensemble de l'apprenant (progression de chaque cours, prochaine activité, échéances) : environ 80 ms pour quelques cours, en proportion du nombre de cours suivis. Elle se désactive dans Pages et navigation.
- Les requêtes en plus sont les polices du thème et ses images, mises en cache par le navigateur.

## Tests

Les variables de la palette sont exposées en propriétés CSS (`--epure-brand`, `--epure-brand-text`, `--epure-on-brand`, etc.) pour les SCSS personnalisés.

Tests :

```
vendor/bin/phpunit --testsuite theme_epure_testsuite
vendor/bin/behat --config <behat_dataroot>/behatrun/behat/behat.yml --tags @theme_epure
```

Les tests Behat passent l'audit axe-core de Moodle (« the page should meet accessibility standards ») sur le tableau de bord, le panneau des préférences, la déclaration d'accessibilité, la page de cours et les formats de cours.
