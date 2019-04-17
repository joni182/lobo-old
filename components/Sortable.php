<?php

namespace app\components;

use app\assets\SortableAsset;
use yii\base\Widget;
use yii\helpers\Url;

/**
 * Implementa el plugin de jQuery Sortable.
 */
class Sortable extends Widget
{
    public $view;
    public $sortable1;
    public $sortable2;

    public function init()
    {
        parent::init();
        if (empty($this->view) || empty($this->sortable1) || empty($this->sortable2)) {
            throw new \Exception('Falta algún parametro de configuración', 1);
        }
        SortableAsset::register($this->view);
    }

    public function run()
    {
        $sortable1 = $this->sortable1;
        $sortable2 = $this->sortable2;
        $sortable1_action = $sortable1['accion'];
        $sortable2_action = $sortable2['accion'];
        $html = <<<EOF
        <ul id="sortable1" data-accion=" $sortable1_action " class="connectedSortable">
EOF;
        foreach ($sortable1['items'] as $item) {
            $list_id = $sortable1['list_id'];
            $name = $sortable1['item']['name'];
            $name = $item->$name;
            $id = $item->id;
            $url_item = Url::to([$sortable1['item']['accion'], 'id' => $id]);
            $html .= <<<EOF
            <li data-list="$list_id" data-item="$id"  data-url_accion="$sortable1_action" class="ui-state-default">
                    <a href="$url_item" class="btn btn-warning btn-xs" style='margin:3px' data-toggle="tooltip" data-placement="right" title=" $item->descripcion">
                        $name
                    </a>
                </li>
EOF;
        }
        $html .= <<<EOF
        </ul>

        <ul id="sortable2" data-accion="$sortable2_action" class="connectedSortable">
EOF;
        foreach ($sortable2['items'] as $item) {
            $list_id = $sortable2['list_id'];
            $name = $sortable2['item']['name'];
            $name = $item->$name;
            $id = $item->id;
            $url_item = Url::to([$sortable2['item']['accion'], 'id' => $id]);
            $html .= <<<EOF
                <li data-list="$list_id" data-item="$id" data-url_accion="$sortable2_action" class="ui-state-default">
                    <a href="$url_item" class="btn btn-warning btn-xs" style='margin:3px' data-toggle="tooltip" data-placement="right" title="$item->descripcion">
                        $name
                    </a>
                </li>
EOF;
        }
        $html .= '</ul>';
        return $html;
    }
}
