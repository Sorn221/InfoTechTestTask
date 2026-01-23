<?php

class m250121_000002_create_rbac_tables extends CDbMigration
{
    public function up()
    {
        // Таблицы для RBAC (авторизации)
        $this->createTable('auth_item', [
            'name' => 'varchar(64) NOT NULL',
            'type' => 'int(11) NOT NULL',
            'description' => 'text',
            'bizrule' => 'text',
            'data' => 'text',
        ]);
        
        $this->addPrimaryKey('pk_auth_item', 'auth_item', 'name');
        
        $this->createTable('auth_item_child', [
            'parent' => 'varchar(64) NOT NULL',
            'child' => 'varchar(64) NOT NULL',
        ]);
        
        $this->addPrimaryKey('pk_auth_item_child', 'auth_item_child', 'parent, child');
        $this->addForeignKey('fk_auth_item_child_parent', 'auth_item_child', 'parent', 'auth_item', 'name', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_auth_item_child_child', 'auth_item_child', 'child', 'auth_item', 'name', 'CASCADE', 'CASCADE');
        
        $this->createTable('auth_assignment', [
            'itemname' => 'varchar(64) NOT NULL',
            'userid' => 'varchar(64) NOT NULL',
            'bizrule' => 'text',
            'data' => 'text',
        ]);
        
        $this->addPrimaryKey('pk_auth_assignment', 'auth_assignment', 'itemname, userid');
        $this->addForeignKey('fk_auth_assignment_item', 'auth_assignment', 'itemname', 'auth_item', 'name', 'CASCADE', 'CASCADE');
    }
    
    public function down()
    {
        $this->dropTable('auth_assignment');
        $this->dropTable('auth_item_child');
        $this->dropTable('auth_item');
    }
}