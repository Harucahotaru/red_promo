<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%coments}}`.
 */
class m230207_072113_create_comments_table extends Migration
{
    const TABLE_NAME = '{{%comments}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('Id'),
            'username' => $this->string()->comment('Username'),
            'content' => $this->text()->comment('Content'),
            'news_id' => $this->integer()->comment('Parent news'),
            'date_c' => $this->dateTime()->comment('Дата создания'),
        ]);
        $this->addCommentOnTable(self::TABLE_NAME, 'Comments table');
        $this->createIndex('comments_news_id_index', self::TABLE_NAME, [
            'news_id',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
