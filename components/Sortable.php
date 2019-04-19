<?php

namespace app\components;

use app\assets\SortableAsset;
use yii\base\Widget;

/**
 * Implementa el plugin de jQuery Sortable.
 */
class Sortable extends Widget
{
    public $view;
    public $list_id;
    public $sortable1;
    public $sortable2;
    public $item_view;

    public function init()
    {
        parent::init();
        if (empty($this->view) || empty($this->item_view) || empty($this->sortable1) || empty($this->sortable2 || empty($this->item_view))) {
            throw new \Exception('Falta algún parametro de configuración', 1);
        }
        SortableAsset::register($this->view);
    }

    public function run()
    {
        $list_id = $this->list_id;
        $sortable1 = $this->sortable1;
        $sortable2 = $this->sortable2;
        $sortable1_action = $sortable1['accion'];
        $sortable2_action = $sortable2['accion'];
        $html = "<ul id='sortable1' data-accion=' $sortable1_action ' class='connectedSortable'>";
        foreach ($sortable1['items'] as $item) {
            $id = $item->id;

            $html .= "<li data-list='$list_id' data-item='$id'  data-url_accion='$sortable1_action' class='ui-state-default'>";

            $html .= $this->render($this->item_view, ['model' => $item]);

            $html .= '</li>';
        }
        $html .= '</ul>'
        .
        "<ul id='sortable2' data-accion='$sortable2_action' class='connectedSortable'>";

        foreach ($sortable2['items'] as $item) {
            $id = $item->id;

            $html .= "<li data-list='$list_id' data-item='$id' data-url_accion='$sortable2_action' class='ui-state-default'>";

            $html .= $this->render($this->item_view, ['model' => $item]);

            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }
}
