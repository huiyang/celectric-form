<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Orders extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    
    protected $fillable =['sales_person','cust_name','term','po_number','pr_date','quotation_number','delivery_date','grand_total_price','grand_total_cost','customer_id'];
    
    public static function boot() {
        parent::boot();

        // static::created(function($model) {
        //     $model->recalculateTotal();
        // });

        static::updating(function($model) {
            $model->recalculateTotal();
        });
    }

    public function recalculateTotal() {
        $this->currency = currency()->getUserCurrency();
        $this->grand_total_price = $this->items->sum('convertedTotalPrice');
        $this->grand_total_cost = $this->items->sum('convertedTotalCost');
        
        return $this;
    }
    
    public function items(){
        return $this->hasMany(Items::class,'order_id');
    }
    
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function getDisplayTotalPriceAttribute() {
        return currency($this->grand_total_price, $this->getCurrency());
    }

    public function getDisplayTotalCostAttribute() {
        return currency($this->grand_total_cost, $this->getCurrency());
    }

    public function getDisplayTotalProfitAttribute() {
        return currency($this->grand_total_price - $this->grand_total_cost, $this->getCurrency());
    }

    public function getDisplayProfitPercentageAttribute() {
        if ($this->grand_total_price != 0) {
            return number_format(($this->grand_total_price - $this->grand_total_cost) / $this->grand_total_price * 100, 2) . '%';
        }
    }

    protected function getCurrency() {
        return $this->currency ?? currency()->getUserCurrency();
    }
}
