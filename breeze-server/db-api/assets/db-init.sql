-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 27 juin 2022 à 17:43
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `${dbname}`
--

CREATE DATABASE IF NOT EXISTS `${dbname}` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `${dbname}`;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}access`
--

CREATE TABLE `${prefix}access` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `scopes` text NOT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}ad`
--

CREATE TABLE `${prefix}ad` (
  `id` int(11) NOT NULL,
  `pid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `display` tinyint(1) NOT NULL,
  `data` json NOT NULL,
  `broadcast_start` date DEFAULT NULL,
  `broadcast_end` date DEFAULT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}ad_id`
--

CREATE TABLE `${prefix}ad_id` (
  `id` varchar(255) NOT NULL,
  `reusable` tinyint(4) NOT NULL,
  `params` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}e_commerce_category`
--

CREATE TABLE `${prefix}e_commerce_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `display` int(11) NOT NULL,
  `preview` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}e_commerce_order`
--

CREATE TABLE `${prefix}e_commerce_order` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `billing` json NOT NULL,
  `expedition` json NOT NULL,
  `products` json NOT NULL,
  `fees` json NOT NULL,
  `custom_fields` json NOT NULL,
  `promo_code` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}e_commerce_product`
--

CREATE TABLE `${prefix}e_commerce_product` (
  `id` int(11) NOT NULL,
  `previews` json NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `categories` json NOT NULL,
  `short_description` text NOT NULL,
  `long_description` text NOT NULL,
  `display` int(11) NOT NULL,
  `stock_status` int(11) NOT NULL,
  `selling_price` float NOT NULL,
  `promo_price` float NOT NULL,
  `amount_available` float NOT NULL,
  `amount_total` float NOT NULL,
  `single_selling` int(11) NOT NULL,
  `shipping` int(11) NOT NULL,
  `features` json NOT NULL,
  `attached_document` varchar(255) NOT NULL,
  `shelf` int(11) NOT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}e_commerce_promo`
--

CREATE TABLE `${prefix}e_commerce_promo` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `value` float NOT NULL,
  `allow_free_shipping` int(11) NOT NULL,
  `expiration_date` date NOT NULL,
  `min_expense` float NOT NULL,
  `max_expense` float NOT NULL,
  `single_use` int(11) NOT NULL,
  `products` json NOT NULL,
  `excluded_products` json NOT NULL,
  `categories` json NOT NULL,
  `excluded_categories` json NOT NULL,
  `total_use_limit` int(11) NOT NULL,
  `user_use_limit` int(11) NOT NULL,
  `use_by` json NOT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}e_commerce_shelf`
--

CREATE TABLE `${prefix}e_commerce_shelf` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}media`
--

CREATE TABLE `${prefix}media` (
  `id` int(11) NOT NULL,
  `name` mediumtext NOT NULL,
  `link` mediumtext NOT NULL,
  `sender` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `mime` varchar(255) NOT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}medias_backup`
--

CREATE TABLE `${prefix}medias_backup` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `medias_date` varchar(255) DEFAULT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}menu`
--

CREATE TABLE `${prefix}menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `locations` mediumtext NOT NULL,
  `insert_by` int(11) NOT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}menu_item`
--

CREATE TABLE `${prefix}menu_item` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `target` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `publish` int(11) NOT NULL,
  `display` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `menu` int(11) NOT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}menu_location`
--

CREATE TABLE `${prefix}menu_location` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `menu` int(11) NOT NULL,
  `insert_by` int(11) NOT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}newsletter_campaign`
--

CREATE TABLE `${prefix}newsletter_campaign` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `recipients` text NOT NULL,
  `launches` int(11) NOT NULL DEFAULT '0',
  `launch_dates` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}newsletter_email`
--

CREATE TABLE `${prefix}newsletter_email` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}news_article`
--

CREATE TABLE `${prefix}news_article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `categories` json NOT NULL,
  `tags` json NOT NULL,
  `summary` text NOT NULL,
  `featured_image` varchar(255) NOT NULL,
  `allow_comment` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `insert_by` int(11) NOT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edit_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}news_category`
--

CREATE TABLE `${prefix}news_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `display` int(11) NOT NULL,
  `preview` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}news_comment`
--

CREATE TABLE `${prefix}news_comment` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `author` int(11) NOT NULL,
  `article` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}news_tag`
--

CREATE TABLE `${prefix}news_tag` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}notification`
--

CREATE TABLE `${prefix}notification` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `type` int(11) NOT NULL,
  `recipients` json NOT NULL,
  `received_in_app` json NOT NULL,
  `received_in_email` json NOT NULL,
  `removed_in_app` json NOT NULL,
  `params` json NOT NULL,
  `triggered_by` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `target` varchar(255) NOT NULL,
  `removable` tinyint(1) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}page`
--

CREATE TABLE `${prefix}page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `featured_image` varchar(255) NOT NULL,
  `top_sections` json NOT NULL,
  `bottom_sections` json NOT NULL,
  `display` int(11) NOT NULL,
  `is_home` int(11) NOT NULL,
  `insert_by` int(11) NOT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edit_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}section`
--

CREATE TABLE `${prefix}section` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `widgets` json NOT NULL,
  `news_categories` json NOT NULL,
  `e_commerce_categories` json NOT NULL,
  `last_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}session`
--

CREATE TABLE `${prefix}session` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `session_ip` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pages` json NOT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}setting`
--

CREATE TABLE `${prefix}setting` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `${prefix}setting`
--

INSERT INTO `${prefix}setting` (`id`, `name`, `value`) VALUES
(1, 'DATE_FORMAT', 'DD MMM YYYY'),
(2, 'E_COMMERCE_MODULE', '1'),
(3, 'NEWS_MODULE', '1'),
(4, 'SUBSCRIPTION_MODULE', '1'),
(5, 'NEWSLETTER_MODULE', '1'),
(6, 'COMPRESS_THRESHOLD', '1'),
(7, 'COMPRESS_IMAGES', '1'),
(8, 'WEBSITE_CURRENCY', '1'),
(9, 'NOTIFICATION_EMAIL', ''),
(10, 'ADMIN_FOLDER', 'breeze'),
(11, 'CUSTOM_THUMBNAILS', ''),
(12, 'DISPLAY_TRASH', '1'),
(13, 'KEEP_DELETED_FILES', '1'),
(14, 'THUMBNAILS_FORMAT', '1'),
(15, 'IMAGE_PROCESSING_LIBRARY', 'gd'),
(16, 'ENABLE_EMAIL_NOTIFICATIONS', '1'),
(17, 'ENABLE_ADMIN_NOTIFICATIONS', '1'),
(18, 'DISCOURAGE_INDEXING', '0'),
(19, 'NEWSLETTER_EMAIL', 'blckntr@gmail.com'),
(20, 'SU_PASSWORD', 'antediluvien'),
(21, 'SHOW_USERS_PASSWORDS', '0'),
(22, 'CHANGE_NEW_ACCOUNTS_PASSWORDS', '1'),
(23, 'GOOGLE_MAPS_API_KEY', 'AIzaSyCa3_TcrIj5iuKn-UazcjvEi4mj9I5Rk7g'),
(24, 'AD_MODULE', '1'),
(25, 'ALLOW_DEV_MODE', '1'),
(26, 'ALLOW_DEV_MODE', '0'),
(27, 'ADS_MODULE', '0'),
(28, 'LANG_LIST', '[{\"code\":\"FR\",\"label\":\"Français\"},{\"label\":\"Anglais\",\"code\":\"EN\"}]');

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}subscription_account`
--

CREATE TABLE `${prefix}subscription_account` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `auth_code` int(11) NOT NULL,
  `auth_status` int(11) NOT NULL,
  `hash_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `data` json NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}tables_backup`
--

CREATE TABLE `${prefix}tables_backup` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `tables` mediumtext NOT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}user`
--

CREATE TABLE `${prefix}user` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `access` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `hash_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `${prefix}user`
--

INSERT INTO `${prefix}user` (`id`, `uid`, `name`, `email`, `access`, `status`, `hash_id`, `password`, `avatar`, `last_login`, `insert_datetime`) VALUES
(1, 'admin', 'admin', 'blckntr@gmail.com', 0, 1, '269e7fbc-1fe2-4b67-bd7f-f6afb15ccf81', 'admin', NULL, '2022-06-27 02:57:13', '2022-05-04 18:08:59');

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}website_info`
--

CREATE TABLE `${prefix}website_info` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `${prefix}website_info`
--

INSERT INTO `${prefix}website_info` (`id`, `name`, `value`) VALUES
(1, 'FAVICON', ''),
(2, 'MAIN_LOGO', ''),
(3, 'FOOTER_LOGO', ''),
(4, 'TITLE', ''),
(5, 'HEADER_TEXT', ''),
(6, 'NAME', ''),
(7, 'DESCRIPTION', ''),
(8, 'ADDRESS', ''),
(9, 'EMAIL', ''),
(10, 'PHONE', ''),
(11, 'POSTAL_BANK', ''),
(12, 'FACEBOOK', ''),
(13, 'WHATSAPP', ''),
(14, 'INSTAGRAM', ''),
(15, 'TWITTER', ''),
(16, 'META_KEYS', ''),
(17, 'WEBSITE_URL', ''),
(18, 'FOOTER_IMAGE', ''),
(19, 'DISCORD', ''),
(20, 'LINKEDIN', ''),
(21, 'YOUTUBE', ''),
(22, 'TWITCH', ''),
(23, 'LOCATION', '');

-- --------------------------------------------------------

--
-- Structure de la table `${prefix}widget`
--

CREATE TABLE `${prefix}widget` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `wid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `data` json NOT NULL,
  `type` int(11) NOT NULL,
  `display` int(11) NOT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `${prefix}access`
--
ALTER TABLE `${prefix}access`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}ad`
--
ALTER TABLE `${prefix}ad`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}ad_id`
--
ALTER TABLE `${prefix}ad_id`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}e_commerce_category`
--
ALTER TABLE `${prefix}e_commerce_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}e_commerce_order`
--
ALTER TABLE `${prefix}e_commerce_order`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}e_commerce_product`
--
ALTER TABLE `${prefix}e_commerce_product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}e_commerce_promo`
--
ALTER TABLE `${prefix}e_commerce_promo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}e_commerce_shelf`
--
ALTER TABLE `${prefix}e_commerce_shelf`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}media`
--
ALTER TABLE `${prefix}media`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}medias_backup`
--
ALTER TABLE `${prefix}medias_backup`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}menu`
--
ALTER TABLE `${prefix}menu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}menu_item`
--
ALTER TABLE `${prefix}menu_item`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}menu_location`
--
ALTER TABLE `${prefix}menu_location`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}newsletter_campaign`
--
ALTER TABLE `${prefix}newsletter_campaign`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}newsletter_email`
--
ALTER TABLE `${prefix}newsletter_email`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}news_article`
--
ALTER TABLE `${prefix}news_article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}news_category`
--
ALTER TABLE `${prefix}news_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}news_comment`
--
ALTER TABLE `${prefix}news_comment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}news_tag`
--
ALTER TABLE `${prefix}news_tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}notification`
--
ALTER TABLE `${prefix}notification`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}page`
--
ALTER TABLE `${prefix}page`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}section`
--
ALTER TABLE `${prefix}section`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}session`
--
ALTER TABLE `${prefix}session`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}setting`
--
ALTER TABLE `${prefix}setting`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}subscription_account`
--
ALTER TABLE `${prefix}subscription_account`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}tables_backup`
--
ALTER TABLE `${prefix}tables_backup`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}user`
--
ALTER TABLE `${prefix}user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}website_info`
--
ALTER TABLE `${prefix}website_info`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `${prefix}widget`
--
ALTER TABLE `${prefix}widget`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `${prefix}access`
--
ALTER TABLE `${prefix}access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}ad`
--
ALTER TABLE `${prefix}ad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}e_commerce_category`
--
ALTER TABLE `${prefix}e_commerce_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}e_commerce_order`
--
ALTER TABLE `${prefix}e_commerce_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}e_commerce_product`
--
ALTER TABLE `${prefix}e_commerce_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}e_commerce_promo`
--
ALTER TABLE `${prefix}e_commerce_promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}e_commerce_shelf`
--
ALTER TABLE `${prefix}e_commerce_shelf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}media`
--
ALTER TABLE `${prefix}media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}medias_backup`
--
ALTER TABLE `${prefix}medias_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}menu`
--
ALTER TABLE `${prefix}menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}menu_item`
--
ALTER TABLE `${prefix}menu_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}menu_location`
--
ALTER TABLE `${prefix}menu_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}newsletter_campaign`
--
ALTER TABLE `${prefix}newsletter_campaign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}newsletter_email`
--
ALTER TABLE `${prefix}newsletter_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}news_article`
--
ALTER TABLE `${prefix}news_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}news_category`
--
ALTER TABLE `${prefix}news_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}news_comment`
--
ALTER TABLE `${prefix}news_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}news_tag`
--
ALTER TABLE `${prefix}news_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}notification`
--
ALTER TABLE `${prefix}notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}page`
--
ALTER TABLE `${prefix}page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}section`
--
ALTER TABLE `${prefix}section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}session`
--
ALTER TABLE `${prefix}session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}setting`
--
ALTER TABLE `${prefix}setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `${prefix}subscription_account`
--
ALTER TABLE `${prefix}subscription_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}tables_backup`
--
ALTER TABLE `${prefix}tables_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `${prefix}user`
--
ALTER TABLE `${prefix}user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `${prefix}website_info`
--
ALTER TABLE `${prefix}website_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `${prefix}widget`
--
ALTER TABLE `${prefix}widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
