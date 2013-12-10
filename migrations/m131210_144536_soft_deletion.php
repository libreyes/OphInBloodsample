<?php

class m131210_144536_soft_deletion extends CDbMigration
{
	public function up()
	{
		$this->addColumn('ophinbloodsample_sample_type','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophinbloodsample_sample_type_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('ophinbloodsample_sample_type','deleted');
		$this->dropColumn('ophinbloodsample_sample_type_version','deleted');
	}
}
