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

        $this->setMeta('E-shopper');

        return $this->render('index', $data);
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');

        $products = Product::find()
            ->where(['category_id' => $id])
            ->all();

        $category = Category::findOne($id);

        $data = [
            'products'  => $products,
            'category'  => $category
        ];

        $this->setMeta('E-shopper | ' . $category->name, $category->keywords, $category->description);

        return $this->render('view', $data);
    }
}