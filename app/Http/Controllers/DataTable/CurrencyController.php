<?php
namespace App\Http\Controllers\DataTable;

use App\Models\Currency;
use App\Http\Controllers\DataTableController;

class CurrencyController extends DataTableController {
    public function builder()
    {
        return Currency::query();
    }

    public function getActions($model)
    {
        return [
            [
                'icon' => 'fa fa-edit',
                'label' => 'Edit',
                'url' => route('currency.edit', ['currency' => $model]),
            ],
            [
                'icon' => 'fa fa-remove',
                'label' => 'Delete',
                'class' => 'btn-danger',
                'url' => 'javascript:submitDelete('.$model->id.', "'.route('currency.destroy', ['currency' => $model]).'");',
                'confirm' => 'Are you sure you want to delete this currency?',
            ]
        ];
    }
}