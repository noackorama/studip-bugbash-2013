<?php

class InitPersonalNotifications extends Migration
{

    function description()
    {
        return 'inserts two tables for personal notifications';
    }

    function up()
    {
        $db = DBManager::get();
        $db->exec("
            CREATE TABLE IF NOT EXISTS `personal_notifications` (
                `personal_notification_id` int(11) NOT NULL AUTO_INCREMENT,
                `url` varchar(512) NOT NULL DEFAULT '',
                  `text` text NOT NULL,
                  `avatar` varchar(256) NOT NULL DEFAULT '',
                  `html_id` varchar(64) NOT NULL DEFAULT '',
                  `mkdate` int(11) unsigned NOT NULL DEFAULT '0',
                  PRIMARY KEY (`personal_notification_id`)
        ) ENGINE=MyISAM;");
        $db->exec("
            CREATE TABLE IF NOT EXISTS `personal_notifications_user` (
            `personal_notification_id` int(10) unsigned NOT NULL,
             `user_id` binary(32) NOT NULL,
             `seen` tinyint(1) NOT NULL DEFAULT '0',
             PRIMARY KEY (`personal_notification_id`,`user_id`),
             KEY `user_id` (`user_id`,`seen`)
        ) ENGINE=MyISAM");
    }

    function down()
    {
        $db = DBManager::get();
        $db->exec("DROP TABLE IF EXISTS `personal_notifications` ");
        $db->exec("DROP TABLE IF EXISTS `personal_notifications_user` ");
    }
}
