<?php

class m131206_150651_soft_deletion extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophinbloodsample_sample','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophinbloodsample_sample_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('et_ophinbloodsample_sample','deleted');
		$this->dropColumn('et_ophinbloodsample_sample_version','deleted');
	}
}
