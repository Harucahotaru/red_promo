<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "categories".
 *
 * @property int $id Id
 * @property string|null $name Category name
 */
class Categories extends \yii\db\ActiveRecord
{

    public const SORT_BY_DATE = 1;

    public const SORT_BY_COMMENTS = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'date_c',
                ],
                'value' => function () {
                    return Yii::$app->formatter->asDate('now', 'php:Y-m-d H:i:s');
                },
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['date_c'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'name' => 'Category name',
        ];
    }

    /**
     * @param $categoryName
     *
     * @return array
     */
    public static function searchCategoriesByName($categoryName): array
    {
        return self::find()->filterWhere(['like', 'name', $categoryName])->all();
    }

    /**
     * @return array
     */
    public static function getSortList(): array
    {
        return [
            self::SORT_BY_DATE => 'By date added',
            self::SORT_BY_COMMENTS => 'By popularity',
        ];
    }

    /**
     * @return ActiveDataProvider
     */
    public static function findPopularCategoriesProvider(): ActiveDataProvider
    {
        $query = self::find()
            ->select(['categories.id', 'categories.name', 'categories.date_c', 'COUNT(comments.id) AS cnt'])
            ->leftJoin('news', '`news`.`category_id` = `categories`.`id`')
            ->leftJoin('comments', '`comments`.`news_id` = `news`.`id`')
            ->groupBy('categories.id')
            ->orderBy('cnt DESC')
            ->limit(5);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
    }
}