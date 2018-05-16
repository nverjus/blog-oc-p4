<?php
require_once 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

try {
    $data = Yaml::parseFile('config/config.yml')['database'];
    $data['dms'] = strtolower($data['dms']);

    $dms = $data['dms'].':host='.$data['host'].';charset=utf8';

    $db = new \PDO($dms, $data['user'], $data['password']);
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    echo "Connected to dms\n";
} catch (PDOException $e) {
    echo $e->getMessage()."\n";
}
echo "Creating Database\n";

try {
    $sql = "DROP DATABASE IF EXISTS blog;";
    $db->exec($sql);

    $sql = "CREATE DATABASE blog";

    // use exec() because no results are returned
    $db->exec($sql);
    echo "Database purged\n";
} catch (PDOException $e) {
    echo $sql . "\n" . $e->getMessage()."\n";
}
$sql = "USE blog";

// use exec() because no results are returned
$db->exec($sql);

try {
    $sql = "DROP TABLE IF EXISTS Comment;";
    $db->exec($sql);

    $sql = "CREATE TABLE `Comment` (
    `id` int(11) NOT NULL,
    `author` varchar(50) NOT NULL,
    `content` text NOT NULL,
    `publicationDate` datetime NOT NULL,
    `isValidated` tinyint(1) NOT NULL DEFAULT '0',
    `postId` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

    // use exec() because no results are returned
    $db->exec($sql);
    echo "Table Comment created successfully\n";
} catch (PDOException $e) {
    echo $sql . "\n" . $e->getMessage()."\n";
}

try {
    $sql = "DROP TABLE IF EXISTS Post;";
    $db->exec($sql);

    $sql = "CREATE TABLE `Post` (
      `id` int(11) NOT NULL,
      `title` varchar(100) NOT NULL,
      `intro` varchar(255) NOT NULL,
      `content` text NOT NULL,
      `updateDate` datetime NOT NULL,
      `userId` int(11) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

    // use exec() because no results are returned
    $db->exec($sql);
    echo "Table Post created successfully\n";
} catch (PDOException $e) {
    echo $sql . "\n" . $e->getMessage()."\n";
}

try {
    $sql = "DROP TABLE IF EXISTS User;";
    $db->exec($sql);

    $sql = "CREATE TABLE `User` (
      `id` int(11) NOT NULL,
      `name` varchar(50) NOT NULL,
      `email` varchar(255) NOT NULL,
      `password` varchar(255) NOT NULL,
      `isValidated` tinyint(1) NOT NULL DEFAULT '0',
      `role` enum('member','admin') NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

    // use exec() because no results are returned
    $db->exec($sql);
    echo "Table User created successfully\n";
} catch (PDOException $e) {
    echo $sql . "\n" . $e->getMessage()."\n";
}

try {
    $sql = "ALTER TABLE `Comment`
    ADD PRIMARY KEY (`id`),
    ADD KEY `fk_comment_post` (`postId`);
  ALTER TABLE `Post`
    ADD PRIMARY KEY (`id`),
    ADD KEY `fk_post_user` (`userId`);
  ALTER TABLE `User`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `email` (`email`);
  ALTER TABLE `Comment`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
  ALTER TABLE `Post`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
  ALTER TABLE `User`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
  ALTER TABLE `Comment`
    ADD CONSTRAINT `fk_comment_post` FOREIGN KEY (`postId`) REFERENCES `Post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
  ALTER TABLE `Post`
    ADD CONSTRAINT `fk_post_user` FOREIGN KEY (`userId`) REFERENCES `User` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;";

    $db->exec($sql);
    echo "Constraints added successfully\n";
} catch (PDOException $e) {
    echo $sql . "\n" . $e->getMessage()."\n";
}

$db = null;
echo "Success\n";
