<?php

namespace app\controllers;

use app\models\News;
use Yii;
use yii\web\Controller;

class NewsController extends Controller
{

    const FAVORITE_NEWS_COOKIE = 'favorite_news';
    /**
     * @return string
     */
    public function actionSearch(): string
    {
        $searchedNews = [];
        $searchString = Yii::$app->request->get('string');
        if (!empty($searchString)) {
            $news = News::searchNewsByLabel($searchString);

            /** @var News $item */
            foreach ($news as $item) {
                $searchedNews[] = ['value' => 'Новость - ' . $item->label, 'url' => "/news/view/$item->id"];
            }
        }
        return json_encode($searchedNews);
    }

    public function actionView(int $newsId): string
    {
        return $this->render('_view', [
            'news' => News::findById($newsId)
        ]);
    }

    public function actionAddFavorite(): \yii\web\Response
    {
        $newCookies = [];
        $cookies = Yii::$app->request->cookies->get(self::FAVORITE_NEWS_COOKIE);
        if (!empty($cookies)) {
            $newCookies = array_merge($newCookies, json_decode($cookies->value));
        }
        $postCookie = (int)Yii::$app->request->post('news_id');

        if (!in_array($postCookie, $newCookies)) {
            $newCookies = array_merge($newCookies, (array)$postCookie);
        } else {
            $newCookies = array_diff($newCookies, (array)$postCookie);
        }

        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => self::FAVORITE_NEWS_COOKIE,
            'value' => json_encode($newCookies),
        ]));

        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }

    /**
     * @return array
     */
    public static function getFavoriteNews(): array
    {
        return json_decode(Yii::$app->request->cookies->get(self::FAVORITE_NEWS_COOKIE)->value);
    }
}