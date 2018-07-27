<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Category;

/**
 * Виджет для отображения списка категорий товаров в виде дерева
 *
 * Class MenuWidget
 * @package app\components
 */
class MenuWidget extends Widget
{
    /**
     * Вид для отображения категорий
     *
     * @var
     */
    public $tpl;

    /**
     * Данные (массив категорий из БД)
     *
     * @var
     */
    public $data;

    /**
     * Сформированное дерево категорий
     *
     * @var
     */
    public $tree;

    /**
     * Готовый HTML
     *
     * @var
     */
    public $menuHtml;

    /**
     * Инициализация виджета
     */
    public function init()
    {
        parent::init();

        if ($this->tpl === null)
        {
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
    }

    /**
     * Запуск виджета
     *
     * @return string
     */
    public function run()
    {
        $menu = Yii::$app->cache->get('menu');

        if ($menu) return $menu;

        $this->data = Category::find()
            ->indexBy('id')
            ->asArray()
            ->all();

        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);

        Yii::$app->cache->set('menu', $this->menuHtml, 60);

        return $this->menuHtml;
    }

    /**
     * Сформировать дерево
     *
     * @return array
     */
    private function getTree()
    {
        $tree = [];

        foreach ($this->data as $id => &$node)
        {
            if ( ! $node['parent_id'] )
            {
                $tree[$id] = &$node;
            }
            else
            {
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
            }
        }

        return $tree;
    }

    /**
     * Сформировать HTML
     *
     * @param $tree
     * @return string
     */
    private function getMenuHtml($tree)
    {
        $str = '';

        foreach ($tree as $category)
        {
            $str .= $this->catToTemplate($category);
        }

        return $str;
    }

    /**
     * Сформировать HTML разметку для каждого элемента дерева
     *
     * @param $category
     * @return string
     */
    private function catToTemplate($category)
    {
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }
}