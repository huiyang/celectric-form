<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    
    protected $fillable =['order_id','item_des','model','po_qty','order_qty','sell_price','cost','currency_price','currency_cost','total_price','total_cost','supplier','supplier_po_num','term_2','leadtime','margin','margin_percent','invoice_no','delivery_stat','remark','expected_delivery_date'];
    protected $table ="items";
    protected $casts = [
        'expected_delivery_date' => 'date',
    ];

    public static function boot() {
        parent::boot();

        static::updated(function($model) {
            $model->order->recalculateTotal()->save();
        });

        static::deleted(function($model) {
            $model->order->recalculateTotal()->save();
        });
    }
    
    public function order(){
        return $this->belongsTo(Orders::class);
    }
    
    public function supplierModel(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function getConvertedTotalPriceAttribute() {
        return currency($this->total_price, $this->currency_price, null, false);
    }

    public function getConvertedTotalCostAttribute() {
        return currency($this->total_cost, $this->currency_cost, null, false);
    }

    public function getDisplaySellPriceAttribute() {
        return currency_format($this->sell_price, $this->currency_price);
    }

    public function getDisplayCostAttribute() {
        return currency_format($this->cost, $this->currency_cost);
    }

    public function getDisplayTotalPriceAttribute() {
        return currency_format($this->total_price, $this->currency_price);
    }

    public function getDisplayTotalCostAttribute() {
        return currency_format($this->total_cost, $this->currency_cost);
    }
}
