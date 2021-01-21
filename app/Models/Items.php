<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable =['order_id','item_des','model','po_qty','order_qty','sell_price','cost','total_price','total_cost','supplier','term_2','leadtime','margin','margin_percent','invoice_no','delivery_stat','remark'];
    protected $table ="items";
    
    public function order(){
        return $this->belongsTo(Orders::class);
    }
}
