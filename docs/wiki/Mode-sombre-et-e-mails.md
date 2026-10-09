## Mode sombre

Le réglage **Mode sombre** (onglet Apparence du thème) vaut *Jamais*, *Automatique, selon l'appareil* ou *Toujours*. Avec IOMAD, chaque entreprise peut faire un autre choix dans sa fiche. Chaque utilisateur peut aussi choisir son affichage dans ses préférences (bouton « Aa ») : comme le site, clair, sombre, ou selon son appareil.

Les couleurs sombres sont calculées à partir de la couleur de marque, avec les mêmes contrastes AA ; l'en-tête aux couleurs de la marque garde sa couleur. Les pages de Moodle et d'IOMAD (tableaux de bord, cours, formulaires, menus, tableaux) passent en sombre ; l'éditeur de texte garde l'apparence de son propre thème.

## E-mails aux couleurs de la marque

Les e-mails HTML du site (notifications, messages, forums, devoirs, e-mails d'IOMAD…) reçoivent :

- le **logo** en tête (sinon le nom du site) et un **filet de la couleur de marque** ;
- le message dans une carte, ses liens dans la couleur de marque ;
- un **pied** avec le nom du site, le texte du pied de page et un lien « Gérer mes notifications ».

Avec IOMAD, ce sont le logo, la couleur, le nom et le texte du pied de page de **l'entreprise du destinataire**. Le gabarit utilise des tableaux et des styles en ligne, que lisent les logiciels de messagerie, et s'adapte aux écrans étroits. Épure remplace pour cela le gabarit `core/email_html` de Moodle, y compris pour les e-mails envoyés par les tâches planifiées. Les e-mails se désactivent dans l'onglet Identité du thème (« E-mails aux couleurs de la marque ») : ils reprennent alors la présentation de Moodle.

## Installation et mises à jour : « Moodle travaille… »

Sur les pages d'installation et de mise à jour (mise à jour de Moodle, nouveaux réglages, plugins, installation depuis un fichier ZIP, vérification de l'environnement), un clic sur « Continuer », « Installer le plugin » ou « Mettre à jour la base de données maintenant » affiche, après une demi-seconde, une fenêtre « Moodle travaille… Ne fermez pas et ne rechargez pas cette page ». Elle évite un second clic et est annoncée aux lecteurs d'écran. Le script est écrit dans la page, sans le chargeur JavaScript de Moodle, pour fonctionner aussi pendant une mise à jour.
