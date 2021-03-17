<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable =['sales_person','cust_name','term','po_number','pr_date','quotation_number','delivery_date','grand_total_price','grand_total_cost'];
    
    public function items(){
        return $this->hasMany(Items::class,'order_id');
    }
}
