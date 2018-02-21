<?php

use yii\db\Migration;

class m170902_120113_alter_indexes_and_fk_in_articles_comments_table extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('fk-articles_comments-id_user', 'articles_comments');
        $this->dropIndex('idx-articles_comments-id_user', 'articles_comments');
        $this->dropColumn('articles_comments', 'id_user');
    }

    public function safeDown()
    {
        $this->addColumn('articles_comment', 'id_user', 'integer');
        $this->createIndex('idx-articles_comments-id_user', 'articles_comments', 'id_user');
        $this->addForeignKey('fk-articles_comments-id_user', 'articles_comments', 'id_user', 'user', 'id');
        
        return true;
    }
}