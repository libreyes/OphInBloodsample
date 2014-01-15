<?php

class m131205_103237_table_versioning extends CDbMigration
{
	public function up()
	{
		$this->execute("
CREATE TABLE `et_ophinbloodsample_sample_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`old_dna_no` int(10) unsigned NOT NULL,
	`blood_date` date DEFAULT NULL,
	`blood_location` varchar(255) DEFAULT '',
	`comments` text,
	`type_id` int(10) unsigned NOT NULL DEFAULT '1',
	`volume` float NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_et_ophinbloodsample_sample_lmui_fk` (`last_modified_user_id`),
	KEY `acv_et_ophinbloodsample_sample_cui_fk` (`created_user_id`),
	KEY `acv_et_ophinbloodsample_sample_ev_fk` (`event_id`),
	KEY `acv_ophinbloodsample_sample_type_fk` (`type_id`),
	CONSTRAINT `acv_et_ophinbloodsample_sample_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophinbloodsample_sample_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophinbloodsample_sample_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
	CONSTRAINT `acv_ophinbloodsample_sample_type_fk` FOREIGN KEY (`type_id`) REFERENCES `ophinbloodsample_sample_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('et_ophinbloodsample_sample_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophinbloodsample_sample_version');

		$this->createIndex('et_ophinbloodsample_sample_aid_fk','et_ophinbloodsample_sample_version','id');
		$this->addForeignKey('et_ophinbloodsample_sample_aid_fk','et_ophinbloodsample_sample_version','id','et_ophinbloodsample_sample','id');

		$this->addColumn('et_ophinbloodsample_sample_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophinbloodsample_sample_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophinbloodsample_sample_version','version_id');
		$this->alterColumn('et_ophinbloodsample_sample_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophinbloodsample_sample_type_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(128) NOT NULL,
	`display_order` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophinbloodsample_sample_type_lmui_fk` (`last_modified_user_id`),
	KEY `acv_ophinbloodsample_sample_type_cui_fk` (`created_user_id`),
	CONSTRAINT `acv_ophinbloodsample_sample_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophinbloodsample_sample_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophinbloodsample_sample_type_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophinbloodsample_sample_type_version');

		$this->createIndex('ophinbloodsample_sample_type_aid_fk','ophinbloodsample_sample_type_version','id');
		$this->addForeignKey('ophinbloodsample_sample_type_aid_fk','ophinbloodsample_sample_type_version','id','ophinbloodsample_sample_type','id');

		$this->addColumn('ophinbloodsample_sample_type_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophinbloodsample_sample_type_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophinbloodsample_sample_type_version','version_id');
		$this->alterColumn('ophinbloodsample_sample_type_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->addColumn('et_ophinbloodsample_sample','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophinbloodsample_sample_version','deleted','tinyint(1) unsigned not null');

		$this->addColumn('ophinbloodsample_sample_type','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophinbloodsample_sample_type_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('ophinbloodsample_sample_type','deleted');

		$this->dropColumn('et_ophinbloodsample_sample','deleted');

		$this->dropTable('et_ophinbloodsample_sample_version');
		$this->dropTable('ophinbloodsample_sample_type_version');
	}
}
