<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog`.
 */
class m190123_151641_create_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('xblog_tags', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ]);

        $this->createTable('xblog_articles', [
            'id' => $this->primaryKey(),
            'tag_id' => $this->integer()->null(),
            'title' => $this->string()->notNull(),
            'summary' => $this->string()->notNull(),
            'article' => $this->text()->notNull(),
            'file' => $this->string()->notNull(),
            'author' => $this->string()->null(),
            'source' => $this->string()->null(),

            'views' => $this->integer()->notNull()->defaultValue(0),
            'featured' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ]);

        $this->createIndex(
            'idx-xblog_articles-tag_id',
            'xblog_articles',
            'tag_id'
        );

        $this->addForeignKey(
            'fk-xblog_articles-tag_id',
            'xblog_articles',
            'tag_id',
            'xblog_tags',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-xblog_articles-tag_id',
            'xblog_articles'
        );

        $this->dropIndex(
            'idx-xblog_articles-tag_id',
            'xblog_articles'
        );

        $this->dropTable('xblog_articles');
        $this->dropTable('xblog_tags');
    }
}
