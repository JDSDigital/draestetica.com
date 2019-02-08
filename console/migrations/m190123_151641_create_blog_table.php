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
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('xblog_tags', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createTable('xblog_authors', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'profession' => $this->string()->notNull(),
            'file' => $this->string()->null(),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createTable('xblog_articles', [
            'id' => $this->primaryKey(),
            'tag_id' => $this->integer()->null(),
            'author_id' => $this->integer()->null(),
            'title' => $this->string()->notNull(),
            'summary' => $this->string()->notNull(),
            'article' => $this->text()->notNull(),
            'file' => $this->string()->null(),
            'source' => $this->string()->null(),

            'views' => $this->integer()->notNull()->defaultValue(0),
            'featured' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex(
            'idx-xblog_articles-tag_id',
            'xblog_articles',
            'tag_id'
        );

        $this->createIndex(
            'idx-xblog_articles-author_id',
            'xblog_articles',
            'author_id'
        );

        $this->addForeignKey(
            'fk-xblog_articles-tag_id',
            'xblog_articles',
            'tag_id',
            'xblog_tags',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-xblog_articles-author_id',
            'xblog_articles',
            'author_id',
            'xblog_authors',
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

        $this->dropForeignKey(
            'fk-xblog_articles-author_id',
            'xblog_articles'
        );

        $this->dropIndex(
            'idx-xblog_articles-tag_id',
            'xblog_articles'
        );

        $this->dropIndex(
            'idx-xblog_articles-author_id',
            'xblog_articles'
        );

        $this->dropTable('xblog_articles');
        $this->dropTable('xblog_authors');
        $this->dropTable('xblog_tags');
    }
}
