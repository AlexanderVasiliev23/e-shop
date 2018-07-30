<?php

namespace app\controllers;

use Yii;
use app\models\Cart;
use app\models\Product;

class CartController extends AppController
{
    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');

        $product = Product::findOne($id);

        if (empty($product))
        {
            return false;
        }
        else
        {
            echo '<pre>';
            print_r($product);
            echo '</pre>';
        }
    }
}