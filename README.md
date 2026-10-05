# Épure

A modern, clean and accessible Moodle theme for **Moodle 4.5 LTS and 5.x**, with or without **IOMAD**.

![Theme preview](theme/epure/pix/screenshot.png)

Documentation: [English (theme README)](theme/epure/README.md) · [Français (wiki)](https://github.com/ericfalcon/moodle-theme-iomad/wiki) · [README en français](theme/epure/README.fr.md)

## Repository contents

| Folder | Component | Role |
|---|---|---|
| [`theme/epure`](theme/epure) | `theme_epure` | The theme: appearance, accessibility, vocabulary, IOMAD integration |
| [`docs/wiki`](docs/wiki) | — | Sources of the French wiki pages |

Copy `theme/epure` into the `theme` folder of your Moodle site (`public/theme` from Moodle 5.1 onwards), or install the ZIP file from Site administration › Plugins › Install plugins. IOMAD is detected automatically: there is no other plugin to install.

If you installed the "Épure tools" plugin (`local_epure`) of versions 0.1 to 0.3: first upgrade the theme (it takes over your vocabulary settings), then uninstall that plugin.

The roadmap and design decisions (in French) are in [ROADMAP.md](ROADMAP.md); the changes of each version in [CHANGES.md](CHANGES.md).

## Compatibility

Moodle 4.5 LTS, 5.0 and 5.1, PHP 8.1 to 8.3, with or without IOMAD. Every change is checked by continuous integration on these versions (PHPUnit, Behat with an axe-core accessibility audit, code checks).

## Licence

GNU GPL v3 or later, like Moodle. See [LICENSE](LICENSE). The bundled fonts are under the SIL Open Font License 1.1.
