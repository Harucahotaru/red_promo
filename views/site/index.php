<?php

/** @var yii\web\View $this */

use kartik\typeahead\Typeahead;

$this->title = 'Main news page';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="py-4">
        <h3>Поиск</h3>
        <?= Typeahead::widget([
            'name' => 'search',
            'options' => ['placeholder' => 'I search ...'],
            'pluginOptions' => ['highlight' => true],
            'scrollable' => true,
            'pluginEvents' => [
                "typeahead:select" => 'function(event, response) {
                 location.href=response.url
                }',
            ],
            'dataset' => [
                [
                    'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                    'display' => 'value',
                    'minLength' => 3,
                    'remote' => [
                        'url' => '/news/search' . '?string=%QUERY',
                        'wildcard' => '%QUERY'
                    ]
                ],
                [
                    'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                    'display' => 'value',
                    'minLength' => 3,
                    'remote' => [
                        'url' => '/categories/search' . '?string=%QUERY',
                        'wildcard' => '%QUERY'
                    ]
                ],
            ]
        ]); ?>
    </div>
    <div class="py-4">
        <h3>Favorite news</h3>
        <div>
            <?=\app\widgets\FavoriteNews::widget()?>
        </div>
    </div>
    <div class="py-4">
        <h3>Popular categories</h3>
        <div>
            <?=\app\widgets\PopularCategories::widget()?>
        </div>
    </div>
</div>
