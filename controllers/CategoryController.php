<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;

class CategoryController extends AppController
{
    public function actionIndex()
    {
        $hitProducts = Product::find()
            ->where(['hit' => '1'])
            ->limit(6)
            ->all();

        $data = [
            'hitProducts' => $hitProducts
        ];

        return $this->render('index', $data);
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');

        $products = Product::find()
            ->where(['category_id' => $id])
            ->all();

        $data = [
            'products' => $products
        ];

        return $this->render('view', $data);
    }
}