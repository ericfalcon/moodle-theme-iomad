# Épure

Thème Moodle moderne, sobre et accessible, compatible **Moodle 4.5 LTS et 5.x**, avec ou sans **IOMAD**.

![Aperçu du thème](theme/epure/pix/screenshot.png)

## Contenu du dépôt

| Dossier | Composant | Rôle |
|---|---|---|
| [`theme/epure`](theme/epure) | `theme_epure` | Le thème : apparence, accessibilité, vocabulaire, adaptation à IOMAD |

Copiez `theme/epure` dans le dossier `theme` de votre Moodle (`public/theme` à partir de Moodle 5.1). IOMAD est détecté automatiquement : il n'y a pas d'autre plugin à installer.

Si vous aviez installé le plugin « Outils Épure » (`local_epure`) des versions 0.1 à 0.3 : mettez d'abord le thème à jour (il reprend vos réglages de vocabulaire), puis désinstallez ce plugin.

La feuille de route et les décisions de conception sont dans [ROADMAP.md](ROADMAP.md).

## Compatibilité

Moodle 4.5 LTS, 5.0 et 5.1, PHP 8.1 à 8.3, avec ou sans IOMAD. Chaque modification est vérifiée par l'intégration continue sur ces versions.

## Licence

GNU GPL v3 ou ultérieure, comme Moodle. Voir [LICENSE](LICENSE). Les polices fournies sont sous SIL Open Font License 1.1.
