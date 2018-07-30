<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use yii\web\HttpException;

class ProductController extends AppController
{
    public function actionView($id)
    {
        $product = Product::findOne($id);

        if (empty($product))
        {
            throw new HttpException(404, 'Такого товара нет');
        }


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