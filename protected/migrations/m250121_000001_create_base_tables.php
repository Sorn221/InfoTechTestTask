<?php

class m250121_000001_create_base_tables extends CDbMigration
{
    public function up()
    {
        // 1. Таблица пользователей
        $this->createTable('user', [
            'id' => 'pk',
            'username' => 'varchar(128) NOT NULL',
            'password' => 'varchar(128) NOT NULL',
            'email' => 'varchar(128)',
            'phone' => 'varchar(20)', // для SMS уведомлений
            'created_at' => 'timestamp DEFAULT CURRENT_TIMESTAMP',
        ]);
        
        $this->createIndex('idx_user_username', 'user', 'username', true);
        
        // 2. Таблица авторов
        $this->createTable('author', [
            'id' => 'pk',
            'name' => 'varchar(255) NOT NULL',
            'created_at' => 'timestamp DEFAULT CURRENT_TIMESTAMP',
        ]);
        
        // 3. Таблица книг
        $this->createTable('book', [
            'id' => 'pk',
            'title' => 'varchar(255) NOT NULL',
            'year' => 'int(4) NOT NULL',
            'description' => 'text',
            'isbn' => 'varchar(20)',
            'cover_image' => 'varchar(255)', // путь к файлу
            'created_at' => 'timestamp DEFAULT CURRENT_TIMESTAMP',
        ]);
        
        $this->createIndex('idx_book_year', 'book', 'year');
        
        // 4. Таблица связи книга-автор
        $this->createTable('book_author', [
            'book_id' => 'int(11) NOT NULL',
            'author_id' => 'int(11) NOT NULL',
        ]);
        
        $this->addPrimaryKey('pk_book_author', 'book_author', 'book_id, author_id');
        
        $this->addForeignKey('fk_book_author_book', 'book_author', 'book_id', 'book', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_book_author_author', 'book_author', 'author_id', 'author', 'id', 'CASCADE', 'CASCADE');
        
        // 5. Таблица подписок
        $this->createTable('subscription', [
            'id' => 'pk',
            'user_id' => 'int(11) NOT NULL',
            'author_id' => 'int(11) NOT NULL',
            'created_at' => 'timestamp DEFAULT CURRENT_TIMESTAMP',
        ]);
        
        $this->createIndex('idx_subscription_user_author', 'subscription', 'user_id, author_id', true);
        $this->addForeignKey('fk_subscription_user', 'subscription', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_subscription_author', 'subscription', 'author_id', 'author', 'id', 'CASCADE', 'CASCADE');
    }
    
    public function down()
    {
        echo "m000001_create_base_tables cannot be reverted.\n";
        return false;
        
        $this->dropTable('subscription');
        $this->dropTable('book_author');
        $this->dropTable('book');
        $this->dropTable('author');
        $this->dropTable('user');
    }
}