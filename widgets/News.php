<?php

namespace app\widgets;

use yii\base\Widget;

class News extends Widget
{
    public ?int $categoryId = null;

    public ?array $sort = null;

    public function run()
    {
        return $this->render('news\index', [
            'categoryId' => $this->categoryId,
            'sort' => $this->sort,
        ]);
    }
}