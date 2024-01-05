# Guide d'utilisation

Ce modèle regroupe des outils pour vous permettre de créer rapidement un template compatible avec Breeze.

## Sommaire

- [Mise en place et installation](#mise-en-place-et-installation)

- [Structure du template](#structure-du-template)

- [Développement et utilisation des outils](#développement-et-utilisation-des-outils)

  - [Outils nécessaires](#outils-nécessaires)

  - [Phase de développement](#phase-de-développement)

    - [Les informations du site](#les-informations-du-site)

    - [Les pages](#les-informations-du-site)

    - [Les menus](#les-menus)

    - [Les médias](#les-médias)

    - [Les sections](#les-sections)

    - [Les widgets](#les-widgets)

- [Contribution](#contribution)

- [Translations](#translations)

---

## Mise en place et installation

Vous pouvez installer ce template en le clonant directement depuis ce repo:

```sh
git clone https://github.com/BreezeCMS/breeze-template.git
```

ou passer par [Breeze CLI](https://github.com/BreezeCMS/breeze-cli), l'outil en ligne de commande dédié au développement avec Breeze:

```sh
breeze create my-new-template
```

> Cette commande installe également les dépendances

Après cela, si vous avez opté pour la première méthode d'installation, installez les dépendances du modèle de template avec la commande suivante:

```sh
pnpm install
```

> Il est recommandé d'utiliser le gestionnaire de dépendances [pnpm]('https://pnpm.io/'), intégré par défaut au template mais vous pouvez le modifier si vous le souhaitez

Après la mise en place du template il est nécessaire de vous procurer la dernière version de Breeze que vous pouvez trouver [ici](https://github.com/BreezeCMS/breeze/blob/master/README.md#installation).

Le package téléchargé comporte trois dossiers:

- breeze
- breeze-server
- breeze-plugins

Ajoutez ces trois dossiers à la racine de votre projet. Il est conseillé de créer un lien virtualhost pointant sur le répertoire de votre projet comme par exemple:
**mon-projet.local**

Ouvrez votre administration à cette adresse: **mon-projet.local/breeze** et fournissez le lien de votre projet et les paramètres de votre base de données pour finaliser la configuration de votre projet.

Pour finir lancer le serveur de développement avec la commande suivante:

- Avec [Breeze CLI](https://github.com/BreezeCMS/breeze-cli)

```sh
breeze serve
```

ou

```sh
pnpm serve
```

## Structure du template

Mis à part les éléments propres au framework Vue JS sur lequel est basé le modèle de template, vous avez quelques dossiers et fichiers supplémentaires, nécessaires au fonctionnement du template.

| Chemin                   | Type    | Description                                                                                                                                                     |
| ------------------------ | ------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| /breeze-ssr              | Dossier | Ce dossier permet de charger des données depuis le serveur pour alimenter les moteurs de recherche et les médias sociaux                                        |
| /sections                | Dossier | Ce dossier contient les sections du template                                                                                                                    |
| /widgets                 | Dossier | Ce dossier contient les widgets du template                                                                                                                     |
| /template                | Dossier | Ce dossier contient les informations relatives au template et ses images d'aperçu                                                                               |
| /.cli-version            | Fichier | Ce fichier contient la version de Breeze CLI qui a initialisé votre template                                                                                    |
| /.maintenance            | Fichier | En rendant ce fichier visible, c'est à dire en le renommant 'maintenance' vous activez le mode maintenance dans l'administration du site en phase de production |
| /build-index.php         | Fichier | Le fichier qui deviendra l'index du build, une fois généré                                                                                                      |
| /htaccess-http           | Fichier | Le contenu du fichier .htaccess en phase de développement                                                                                                       |
| /htaccess-https          | Fichier | Le contenu du fichier .htaccess en phase de développement avec le SSL activé                                                                                    |
| /index.php               | Fichier | Point d'entrée du template en phase de développement                                                                                                            |
| /src/components/sections | Dossier | Dossier contenant les composants des sections du template                                                                                                       |
| /src/views/Container.vue | Fichier | Fichier de centralisation des sections des pages du template                                                                                                    |
| /src/composables         | Dossier | Ce dossier contient la logique réutilisable que vous pouvez intégrer dans les composants des sections du template                                               |
| /src/stores              | Dossier | Ce dossier contient des appels à diverses sections de votre base de données                                                                                     |
| /src/utils               | Dossier | Dossier contenant un ensemble de fonctions qui peuvent vous être utiles dans la phase de développement                                                          |
| /src/i18n                | Dossier | Dossier contenant les fichiers de gestion multilingue                                                                                                           |

## Développement et utilisation des outils

### Outils nécessaires

- L'outil en ligne de commandes [Breeze CLI](https://github.com/)
- Un serveur PHP et une base de données MySQL
- Le package de [Breeze](https://github.com/)

### Phase de développement

Le développement d'un template compatible avec Breeze s'articule autour de deux éléments fondamentaux: les sections et les widgets. Outre ces deux éléments vous devrez également gérer les informations du site, les pages, les menus, les médias au niveau de votre site et de son administration.

#### Les informations du site

#### Les pages

#### Les menus

#### Les médias

#### Les sections

#### Les widgets

## Contribution

Les Pull requests sont les bienvenues. Pour les changements majeurs, veuillez d'abord ouvrir un issue pour discuter de ce que vous souhaitez changer.

## Translations

- [Anglais](README.md)
- [Français](README.fr.md)

<p align="center">
  &copy; <a href="https://edpage.net" target="_blank" rel="noopener noreferrer">edPage</a> 2022
</p>
