#
# TABLE STRUCTURE FOR: admin
#

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `adminId` int(9) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `adminName` varchar(100) DEFAULT null,
  `adminUser_name` varchar(100) DEFAULT null,
  `adminPhone` varchar(255) DEFAULT null,
  `adminEmail` varchar(100) DEFAULT null,
  `adminAddress` varchar(255) DEFAULT null,
  `amdminImage` varchar(255) DEFAULT NULL,
  `adminPassword` varchar(255) DEFAULT null,
  `adminCreated_at` timestamp(),
) ENGINE=InnoDB DEFAULT CHARSET=utf8_general_ci;

#
# TABLE STRUCTURE FOR: category
#

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `catId` int(9) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `catName` varchar(100) DEFAULT null,
  `catSlug` varchar(255) DEFAULT null,
  `catAuthor` int(9) unsigned DEFAULT null,
  `catImage` varchar(255) DEFAULT NULL,
  `catCreated_at` timestamp(),
  'catUpdated_at' timestamp(),
) ENGINE=InnoDB DEFAULT CHARSET=utf8_general_ci;

#
# TABLE STRUCTURE FOR: comment
#

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment` (
  `commentId`int(9) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `comment` varchar(255) DEFAULT NULL,
  `commentsPostId` int(9) unsigned DEFAULT NULL,
  `postPublisherId` int(9) unsigned DEFAULT NULL,
  'commentStatus' int(1)  DEFAULT NULL
  'comment_on' timestamp(),
) ENGINE=InnoDB DEFAULT CHARSET=utf8_general_ci;

#
# TABLE STRUCTURE FOR: posts
#

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `postId` int(9) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `postTitle` varchar(255)DEFAULT NULL,
  `postSlug` varchar(255)DEFAULT NULL,
  `postPublisher` int(9) unsigned NULL,
  `postCategory` int(9) unsigned NULL,
  `postStatus` int(9) unsigned DEFAULT NULL,
  `postImage` varchar(255)DEFAULT NULL,
  `post` varchar(255)DEFAULT NULL,
  `postCreated_at` timestamp(),
  `postUpdated_at` timestamp(),
) ENGINE=InnoDB DEFAULT CHARSET=utf8_general_ci;

#
# TABLE STRUCTURE FOR: publisher
#

DROP TABLE IF EXISTS `publisher`;

CREATE TABLE `publisher` (
  `publisherId` int(9) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `publisherUser_name` varchar(100) DEFAULT NULL,
  `pbulisherName` varchar(100) DEFAULT NULL,
  `publisherEmail` varchar(100) DEFAULT NULL,
  `publisherPassword` varchar(255) DEFAULT NULL,
  `publisherPhone` varchar(255) DEFAULT NULL,
  `publisherCountry` varchar(255) DEFAULT NULL,
  `publisherStatus` int(1) unsigned DEFAULT NULL,
  `publisherImage` varchar(255) DEFAULT NULL,
  `publisherCreated_at` timestamp(),
) ENGINE=InnoDB DEFAULT CHARSET=utf8_general_ci;

# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `userId` int(9) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `userName` varchar(100) DEFAULT null,
  `userEmail` varchar(100) DEFAULT null,
  `userPhone` varchar(255) DEFAULT null,
  `userPassword` varchar(255) DEFAULT null,
  `userStatus` int(1) unsigned DEFAULT NULL,
  `userImage` varchar(255) DEFAULT NULL,
  `userCreated_at` timestamp(),
) ENGINE=InnoDB DEFAULT CHARSET=utf8_general_ci;