<?php

namespace app\widgets;

use yii\base\Widget;

class FavoriteNews extends Widget
{
    public function run()
    {
        return $this->render('favorite-news\index', []);
    }
}