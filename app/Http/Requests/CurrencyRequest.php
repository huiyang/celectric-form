<?php
namespace App\Http\Requests;

use App\Models\Currency;
use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest {
    public $model;

    public function __construct() {
        $this->model = request()->currency ?? Currency::make();
    }
    
    public function rules() {
        return [
            'name' => 'required',
            'code' => 'required',
            'exchange_rate' => 'required',
            'symbol' => 'required',
            'format' => 'required',
        ];
    }
}