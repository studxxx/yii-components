<?php

class m150226_150922_config_table extends CDbMigration
{
	public function safeUp()
	{
        $this->execute(
          "CREATE TABLE IF NOT EXISTS `config` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `param` varchar(128) NOT NULL,
            `value` text NOT NULL,
            `default` text NOT NULL,
            `label` varchar(255) NOT NULL,
            `type` varchar(128) NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `param` (`param`)
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8;"
        );
	}

	public function safeDown()
	{
        $this->dropTable('config');
	}
}