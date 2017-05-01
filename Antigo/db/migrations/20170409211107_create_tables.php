<?php

use Phinx\Migration\AbstractMigration;

class CreateTables extends AbstractMigration
{
  public function up()
  {
    //When you want to create something in your database
    $this->table('user')
     ->addColumn('name', 'string')
     ->addColumn('email', 'string')
     ->addColumn('phone', 'string')
     ->addColumn('pass', 'string')
     ->save();
  }

  public function down(){
    //When you want to revert some change
    $this->dropTable('user');

  }

}
