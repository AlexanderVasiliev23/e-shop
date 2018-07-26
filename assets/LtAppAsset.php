<?php

namespace app\assets;

use yii\web\View;
use yii\web\AssetBundle;

class LtAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        "js/html5shiv.js",
        "js/respond.min.js"
    ];
    public $jsOptions = [
        'condition' => 'lte IE9',
        'position'  => View::POS_HEAD
    ];
}