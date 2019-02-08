<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%xsystem_users}}', [
            'id' => $this->primaryKey(),
            // 'username' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'profession' => $this->string()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'file' => $this->string()->null(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        // $this->insert('{{%xsystem_users}}', [
        //     'name'      => 'Daniel Sosa',
        //     'profession'      => 'Programador',
        //     'auth_key'      => '6-Oj7UlbBzGErKAjXidC-QNhtATWbctw',
        //     'password_hash' => '$2y$13$GbyLKMHbbu/dWxnafz9znudqQUKdcwpqhlePxhD1xoJloE2./EqBC',
        //     'email'         => 'jdsosa@gmail.com',
        //
        //     'status'     => 10,
        //     'created_at' => 0,
        //     'updated_at' => 0,
        // ]);
    }

    public function down()
    {
        $this->dropTable('{{%xsystem_users}}');
    }
}
