

<?php

echo '<pre>';
//print_r($categories);
echo '</pre>';

echo '<pre>';
//print_r($tree);
echo '</pre>';

function printTree($tree)
{
    $output = '';

    $output .= '<ul>';

    foreach ($tree as $element)
    {
        $output .= "<li>{$element['name']}</li>";
        if (isset($element['children']))
        {
            $output .= printTree($element['children']);
        }
    }

    $output .= '</ul>';

    return $output;
}

echo printTree($tree);

?>


<!--<ul>-->
<!--    --><?php //foreach ($tree as $element) : ?>
<!--        --><?php //if(isset($element['name'])) : ?>
<!--            <li>--><?//= $element['name'] ?><!--</li>-->
<!--            --><?php //if(isset($element['children'])) : ?>
<!--                <ul>-->
<!--                    --><?php //foreach ($element['children'] as $child) : ?>
<!--                        --><?php //if(isset($child['name'])) : ?>
<!--                            <li>--><?//= $child['name'] ?><!--</li>-->
<!--                        --><?php //endif ?>
<!--                    --><?php //endforeach ?>
<!--                </ul>-->
<!--            --><?php //endif ?>
<!--        --><?php //endif ?>
<!--    --><?php //endforeach ?>
<!--</ul>-->