<?php

namespace app\models;

use app\controllers\NewsController;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\caching\DbCache;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "news".
 *
 * @property int $id id
 * @property string $label News label
 * @property string|null $content News content
 * @property string|null $img_path Path yo img
 * @property int|null $category_id Category
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
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
            [['label'], 'required'],
            [['content'], 'string'],
            [['category_id'], 'integer'],
            [['label', 'img_path'], 'string', 'max' => 255],
            [['date_c'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'label' => 'News label',
            'content' => 'News content',
            'img_path' => 'Path yo img',
            'category_id' => 'Category',
        ];
    }

    /**
     * @param $label
     *
     * @return array
     */
    public static function searchNewsByLabel($label): array
    {
        return self::find()->filterWhere(['like', 'label', $label])->all();
    }

    public static function findById($id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    /**
     * @param int $categoryId
     * @param array $sort
     *
     * @return ActiveDataProvider
     */
    public static function findByCategoryProvider(int $categoryId, array $sort): ActiveDataProvider
    {
        if (!empty($sort) && $sort['type'] === Categories::SORT_BY_COMMENTS) {
            $query = self::find()
                ->innerJoin('comments', '`comments`.`news_id` = `news`.`id`')
                ->select(['COUNT(comments.news_id) AS cnt', 'news.id', 'news.label', 'news.content', 'news.img_path', 'news.category_id', 'news.date_c'])
                ->groupBy('comments.news_id')
                ->orderBy("cnt " . $sort['direction']);
        } else {
            $query = self::find()->where(['category_id' => $categoryId]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => self::getOrder($sort),
            ],
        ]);
    }

    /**
     * @param array $sort
     *
     * @return array
     */
    public static function getOrder(array $sort): array
    {
        $order = ['date_c' => SORT_DESC];

        if (!empty($sort)) {
            switch ($sort['type']) {
                case Categories::SORT_BY_DATE:
                case Categories::SORT_BY_COMMENTS:
                    $order = ['date_c' => $sort['direction']];
                    break;
            }
        }

        return $order;
    }

    /**
     * @return ActiveDataProvider
     */
    public static function findFavoriteNewsProvider(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => self::find()->where(['id' => NewsController::getFavoriteNews()]),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'date_c' => SORT_DESC
                ],
            ],
        ]);
    }

    /**
     * @return bool
     */
    public function isFavorite(): bool
    {
        $cookieNews = json_decode(Yii::$app->request->cookies->get(NewsController::FAVORITE_NEWS_COOKIE)->value);

        return in_array($this->id, $cookieNews);
    }

    /**
     * @return Categories
     */
    public function getCategory(): Categories
    {
        return Categories::find()->where(['id' => $this->category_id])->one();
    }
}
