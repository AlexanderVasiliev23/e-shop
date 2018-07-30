<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
use yii\web\HttpException;

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

        $query = Product::find()->where(['category_id' => $id]);

        $category = Category::findOne($id);

        if (empty($category))
        {
            throw new HttpException(404, 'Такой категории нет');
        }

        $pages = new Pagination([
            'totalCount'        => $query->count(),
            'pageSize'          => 3,
            'forcePageParam'    => false,
            'pageSizeParam'     => false
        ]);

        $products = $query
            ->limit($pages->limit)
            ->offset($pages->offset)
            ->all();



        $data = [
            'products'  => $products,
            'category'  => $category,
            'pages'     => $pages
        ];

        $this->setMeta('E-shopper | ' . $category->name, $category->keywords, $category->description);

        return $this->render('view', $data);
    }
}