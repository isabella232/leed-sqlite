leed-sqlite
===========

SQLite version of Leed: https://github.com/ldleman/Leed

----

Application : Leed (Light Feed)
Version : 1.0 Alpha
Auteur : Valentin CARRUESCO aka Idleman (idleman@idleman.fr)
Dépot SVN : http://hades.idleman.fr/leed
Licence : CC by-nc-nd (http://creativecommons.org/licenses/by-nc-nd/2.0/fr/) Nb : les travaux dérivés peuvent être autorisés avec accord de l'auteur

==================
== PRESENTATION ==
==================

	Leed (contraction de Light Feed) est un agrégatteur RSS libre et minimaliste qui permet la consultation de flux RSS de manière rapide et non intrusive.

	Toutes les tâches de traitements de flux sont effectuées de manière invisible par une tâche synchronisée (Cron), ainsi, l'utilisateur ne subit pas les lenteurs dues à la récupération et au traitement de chacuns des flux suivis.

	A noter que Leed est compatible toutes résolutions, sur pc, tablettes et smartphone et fonctionne sous tous les navigateurs.

	Le script est également compatible avec les fichiers d'exports/imports OPML ce qui rend la migration de tous les agrégateurs réspectant le standard OPML simple et rapide.

================
== PRE-REQUIS ==
================

	- Serveur Apache conseillé (Non testé sur les autres serveurs types Nginx ...)
	- PHP 5.3 minimum
	- Extension SQLite 3 pour PHP5
	- SQLite 3

==================
== INSTALLATION ==
==================

	1. Récuperez le projet sur le dépot SVN de la version courante : http://hades.idleman.fr/leed
	2. Placez le projet dans votre repertoire web et appliquez une permission chmod 775 (nb si vous êtes sur un hebergement ovh, préférez un 0755 ou vous aurez une erreur 500) sur le dossier et son contenu
	3. Depuis votre navigateur, accedez à la page d'installation install.php (ex : http://votre.domaine.fr/leed/install.php) et suivez les instructions.
	4. Une fois l'installation terminée, supprimez le fichier install.php par mesure de sécurité
	5. Mettez en place un cron (sudo crontab -e pour ouvrir le fichier de cron) et placez y un appel vers la page http://votre.domaine.fr/leed/action.php?action=synchronize ex : 

	0 * * * * wget -q -O /var/www/leed/logsCron http://127.0.0.1/leed/action.php?action=synchronize

	Pour mettre à jour vos flux toutes les heures à la minute 0 (il est conseillé de ne pas mettre une fréquence trop rapide pour laisser le temps au script de s'executer).
	6. Le script est installé, merci d'avoir choisis Leed, l'agrégatteur RSS libre et svelte :p.

=================
== MISE A JOUR ==
=================

	Pour faire une mise à jour d'une version de Leed sur une autre, copiez le fichier database.db de votre ancienne installation vers votre nouvelle installation.

	Vous ne devez pas relancer l'installation (install.php).

	Dans certain cas, il est possible que les mises a jours concernent également la structure de la base de donnée, vous ne pourrez donc pas utiliser la technique ci dessous et devrez utiliser le module d'export/import puis rééfectuer l'installation.

================
== LIBRAIRIES ==
================

	Responsive / Cross browser : Initializr (www.initializr.com)
	Javascript : JQuery (www.jquery.com)
