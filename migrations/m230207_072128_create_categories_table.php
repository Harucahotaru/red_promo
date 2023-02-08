<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m230207_072128_create_categories_table extends Migration
{
    const TABLE_NAME = '{{%categories}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('Id'),
            'name' => $this->string()->comment('Category name'),
            'date_c' => $this->dateTime()->comment('Дата создания'),

        ]);
        $this->addCommentOnTable(self::TABLE_NAME, 'Categories table');
        $this->createIndex('category_id_index', self::TABLE_NAME, [
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
