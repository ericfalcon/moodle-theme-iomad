# Outils Épure (local_epure)

Plugin compagnon du thème [Épure](../../theme/epure), réservé à l'adaptation à **IOMAD**. Il est facultatif : le thème fonctionne seul, et il nécessite le thème (il utilise son moteur de vocabulaire).

## Vocabulaire IOMAD

Administration du site › Plugins › Plugins locaux › Outils Épure › Vocabulaire des entreprises.

Choisissez les mots pour « entreprise » et « département », en français et en anglais : pour toutes les entreprises, et au besoin pour chacune (« client » et « équipe » pour l'une, « agence » et « service » pour une autre). Une entreprise sans mots propres utilise ceux de toutes les entreprises.

Ils s'appliquent sur toutes les pages aux utilisateurs de l'entreprise, et à l'administrateur qui l'a sélectionnée dans le tableau de bord IOMAD. Les mêmes règles de grammaire s'appliquent : « Modifier l'entreprise » devient « Modifier le client », « Afficher les entreprises suspendues » « Afficher les clients suspendus ».

Fonctionnement : les paquets de langue sont communs à tout le site, les mots d'une entreprise ne peuvent donc pas y être écrits. Le plugin active, pour chaque page, un gestionnaire de chaînes (le mécanisme `$CFG->customstringmanager` de Moodle) qui applique les mots de l'entreprise de l'utilisateur au moment où les chaînes sont chargées, avec un cache par entreprise. Il n'est activé que si au moins une entreprise a ses propres mots, et **aucune modification de `config.php` n'est nécessaire**. Si `config.php` définit déjà un autre gestionnaire de chaînes, il est conservé et la page l'indique.

À venir : le tableau de bord des entreprises.

## Installation

Copiez le dossier `epure` dans le dossier `local` de votre Moodle (`public/local` à partir de Moodle 5.1), puis lancez la mise à jour.

## Licence

GNU GPL v3 ou ultérieure.
