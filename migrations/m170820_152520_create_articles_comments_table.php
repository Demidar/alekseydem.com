<?php

use yii\db\Migration;

/**
 * Handles the creation of table `articles_comments`.
 */
class m170820_152520_create_articles_comments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('articles_comments', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer(),
            'id_article' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'text' => $this->text()->notNull(),
            'status' => $this->integer(),
        ], $tableOptions);
        
        // Создание индексов для полей авторов
        $this->createIndex('idx-articles_comments-created_by', 'articles_comments', 'created_by');
        $this->createIndex('idx-articles_comments-updated_by', 'articles_comments', 'updated_by');
        
        $this->createIndex('idx-articles_comments-id_user', 'articles_comments', 'id_user');
        $this->createIndex('idx-articles_comments-id_article', 'articles_comments', 'id_article');
        
        // Создание внешних ключей для полей авторов к таблице пользователей user
        $this->addForeignKey('fk-articles_comments-created_by', 'articles_comments', 'created_by', 'user', 'id');
        $this->addForeignKey('fk-articles_comments-updated_by', 'articles_comments', 'updated_by', 'user', 'id');
        
        $this->addForeignKey('fk-articles_comments-id_user', 'articles_comments', 'id_user', 'user', 'id');
        $this->addForeignKey('fk-articles_comments-id_article', 'articles_comments', 'id_article', 'articles', 'id');
        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-articles_comments-id_article', 'articles_comments');
        $this->dropForeignKey('fk-articles_comments-id_user', 'articles_comments');
        $this->dropForeignKey('fk-articles_comments-updated_by', 'articles_comments');
        $this->dropForeignKey('fk-articles_comments-created_by', 'articles_comments');
        
        $this->dropIndex('idx-articles_comments-id_article', 'articles_comments');
        $this->dropIndex('idx-articles_comments-id_user', 'articles_comments');
        $this->dropIndex('idx-articles_comments-updated_by', 'articles_comments');
        $this->dropIndex('idx-articles_comments-created_by', 'articles_comments');
        
        $this->dropTable('articles_comments');
    }
}
