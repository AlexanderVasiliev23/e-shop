<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Category;

class TestController extends Controller
{
    public $layout = 'test';

    public function actionIndex()
    {
        $categories = Category::find()->with('products')->all();

        $data = [
            'categories' => $categories
        ];

        return $this->render('index', $data);
    }
}