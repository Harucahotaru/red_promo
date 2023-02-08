<?php

namespace app\controllers;

use app\models\Categories;
use Yii;
use yii\web\Controller;

class CategoriesController extends Controller
{
    public function actionIndex(int $categoryId)
    {
        $sort = [];

        $sortParameters = Yii::$app->request->post();
        if (!empty($sortParameters['type']) && !empty($sortParameters['direction'])) {
            $sort = $sortParameters;
        }

        return $this->render('index', [
            'category' => Categories::findOne(['id' => $categoryId]),
            'sort' => $sort,
        ]);
    }

    /**
     * @return string
     */
    public function actionSearch(): string
    {
        $searchedCategories = [];
        $searchString = Yii::$app->request->get('string');
        if (!empty($searchString)) {
            $categories = Categories::searchCategoriesByName($searchString);

            /** @var Categories $item */
            foreach ($categories as $item) {
                $searchedCategories[] = ['value' => 'Категория - ' . $item->name, 'url' => "/categories/$item->id"];
            }
        }
        return json_encode($searchedCategories);
    }
}