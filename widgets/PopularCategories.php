<?php

namespace app\widgets;

use yii\base\Widget;

class PopularCategories extends Widget
{
    public function run()
    {
        return $this->render('popular-categories\index', []);
    }
}