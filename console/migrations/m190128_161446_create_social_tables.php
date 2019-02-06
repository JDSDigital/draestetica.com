<?php

use yii\db\Migration;

/**
 * Class m190128_161446_create_social_tables
 */
class m190128_161446_create_social_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('xsocial_access_codes', [
            'id' => $this->primaryKey(),
            'access_token' => $this->string()->null(),
        ], $tableOptions);

        $this->createTable('xsocial_instagram_images', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull(),
            'thumbnail' => $this->string()->notNull(),
            'low_resolution' => $this->string()->notNull(),
            'standard_resolution' => $this->string()->notNull(),
            'text' => $this->string()->notNull(),
            'created_time' => $this->integer()->notNull(),

            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createTable('xsocial_articles', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'summary' => $this->string()->notNull(),
            'article' => $this->text()->notNull(),
            'source' => $this->string()->null(),

            'views' => $this->integer()->notNull()->defaultValue(0),
            'featured' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createTable('xsocial_images', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->null(),
            'file' => $this->string()->null(),
            'cover' => $this->smallInteger()->notNull()->defaultValue(0),
            'uploaded_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex(
            'idx-xsocial_images-article_id',
            'xsocial_images',
            'article_id'
        );

        $this->addForeignKey(
            'fk-xsocial_images-article_id',
            'xsocial_images',
            'article_id',
            'xsocial_articles',
            'id',
            'CASCADE'
        );

        // $this->insert('xsocial_access_codes', [
        //     'access_token' => null
        // ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-xsocial_images-article_id',
            'xsocial_images'
        );

        $this->dropIndex(
            'idx-xsocial_images-article_id',
            'xsocial_images'
        );

        $this->dropTable('xsocial_articles');
        $this->dropTable('xsocial_images');
        $this->dropTable('xsocial_access_codes');
        $this->dropTable('xsocial_instagram_images');
    }
}
