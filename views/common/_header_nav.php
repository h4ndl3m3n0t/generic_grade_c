<?php

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

    NavBar::begin([

        'brandLabel' => $brandLabel,
        'brandUrl' => $brandUrl,
        'options' => [
            'class' => 'navbar-expand-lg navbar-dark shadow-sm',
        ],
        'innerContainerOptions' => [
            'class' => 'container-fluid'
        ]
    ]);


    echo Nav::widget([
        'options' => ['class' => 'ml-auto'],
        'encodeLabels' => false,
        'items' => $items,
    ]);

NavBar::end();
?>
