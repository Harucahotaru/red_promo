<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "comments".
 *
 * @property int $id Id
 * @property string|null $username Username
 * @property string|null $content Content
 * @property int|null $news_id Parent news
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
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
            [['date_c'], 'safe'],
            [['content'], 'string'],
            [['news_id'], 'integer'],
            [['username'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'username' => 'Username',
            'content' => 'Content',
            'news_id' => 'Parent news',
        ];
    }

    /**
     * @param int $newsId
     * @return ActiveDataProvider
     */
    public static function findByNewsProvider(int $newsId): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => self::find()->where(['news_id' => $newsId]),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'date_c' => SORT_DESC,
                ]
            ],
        ]);
    }
}
