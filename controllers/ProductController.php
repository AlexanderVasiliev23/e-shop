<?php

namespace app\controllers;

use Yii;
use app\models\Product;

class ProductController extends AppController
{
    public function actionView()
    {
        $id = Yii::$app->request->get('id');

        $product = Product::findOne($id);

        $this->setMeta('E-shopper | ' . $product->name, $product->keywords, $product->description);

        $hitProducts = Product::find()
            ->where(['hit' => 1])
            ->limit(8)
            ->all();

        $data = [
            'product'       => $product,
            'hitProducts'   => $hitProducts
        ];

        return $this->render('view', $data);
    }
}