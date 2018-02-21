<?php

use yii\db\Migration;

/**
 * Handles the creation of table `articles`.
 */
class m170820_143037_create_articles_table extends Migration
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
        
        $this->createTable('articles', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'status' => $this->integer(),
        ], $tableOptions);
        
        // Создание индексов для полей авторов
        $this->createIndex('idx-articles-created_by', 'articles', 'created_by');
        $this->createIndex('isx-articles-updated_by', 'articles', 'updated_by');
        
        // Создание внешних ключей для полей авторов к таблице пользователей user
        $this->addForeignKey('fk-articles-created_by', 'articles', 'created_by', 'user', 'id');
        $this->addForeignKey('fk-articles-updated_by', 'articles', 'updated_by', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-articles-updated_by', 'articles');
        $this->dropForeignKey('fk-articles-created_by', 'articles');
        
        $this->dropIndex('isx-articles-updated_by', 'articles');
        $this->dropIndex('idx-articles-created_by', 'articles');
        
        $this->dropTable('articles');
    }
}
