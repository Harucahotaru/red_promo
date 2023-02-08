<?php

namespace app\widgets;

use yii\base\Widget;

class Comments extends Widget
{
    public ?int $newsId = null;

    public function run()
    {
        return $this->render('comments\index', ['newsId' => $this->newsId]);
    }
}