<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable =['order_id','item_des','model','po_qty','order_qty','sell_price','cost','currency_price','currency_cost','total_price','total_cost','supplier','supplier_po_num','term_2','leadtime','margin','margin_percent','invoice_no','delivery_stat','remark','expected_delivery_date'];
    protected $table ="items";
    
    public function order(){
        return $this->belongsTo(Orders::class);
    }
}
