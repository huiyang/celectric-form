<?php

namespace App\Http\Controllers;

abstract class DataTableController extends Controller
{
    public function index() {
        return datatables()->of($this->builder())
            ->addColumn('action', [$this, 'getActionColumnHtml'])
            ->toJson();
    }

    public function getActionColumnHtml($model) {
        $htmls = [];

        foreach ($this->getActions($model) as $action) {
            $url = $action['url'] ?? '#';
            $url = str_replace('"', '\'', $url);

            if (isset($action['confirm'])) {
                $onclick = 'return confirm(\''.($action['confirm'] ?? 'Are you sure?').'\')';
            }
            $htmls[] = '
                <a onclick="'.($onclick ?? '').'" href="'.($url).'" class="btn btn-xs '.($action['class'] ?? 'btn-primary').'" id="'.$model->id.'">
                    <i class ="'.($action['icon'] ?? '').' fa-fw"></i> '.$action['label'].'
                </a>
            ';
        }
        return implode('&nbsp;' ,$htmls);
    }

    protected function getActions($model) {
        return [];
    }
}