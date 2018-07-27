<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Category;

class TestController extends Controller
{
    public $layout = 'test';

    public function actionIndex()
    {
        $categories = Category::find()
            ->indexBy('id')
            ->asArray()
            ->all();

        $tree = $this->getTree($categories);

        $data = [
            'categories'    => $categories,
            'tree'          => $tree
        ];

        return $this->render('index', $data);
    }

    public function getTree($categories)
    {
        $tree = [];

        foreach ($categories as $id => &$category)
        {
            if ( ! $category['parent_id'] )
            {
                $tree[$id] = &$category;
            }
            else
            {
                $categories[$category['parent_id']]['children'][$category['id']] = &$category;
            }
            
        }



        return $tree;
    }
}
