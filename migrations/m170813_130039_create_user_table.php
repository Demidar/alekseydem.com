<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170813_130039_create_user_table extends Migration
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
        
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(32)->notNull(),
            'name' => $this->string(32),
            'surname' => $this->string(32),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'status' => $this->integer()->defaultValue(10),
            'email' => $this->string(),
            'created_at' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
