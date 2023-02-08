<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m230207_072044_create_news_table extends Migration
{
    const TABLE_NAME = '{{%news}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('id'),
            'label' => $this->string()->notNull()->comment('News label'),
            'content' => $this->text()->comment('News content'),
            'img_path' => $this->string()->comment('Path yo img'),
            'category_id' => $this->integer()->comment('Category'),
            'date_c' => $this->dateTime()->comment('Дата создания'),
        ]);
        $this->addCommentOnTable(self::TABLE_NAME, 'News table');
        $this->createIndex('news_category_id_index', self::TABLE_NAME, [
            'category_id',
        ]);
        $this->createIndex('news_id_index', self::TABLE_NAME, [
            'id',
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
