<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Item extends Model
{

    protected $table = 'items';
    protected $fillable = [
      'itemable_id', 'itemable_type', 'sku', 'barcode', 'name', 'desc', 'price', 'qty', 'tax', 'package_id', 'minimum', 'maximum', 'reorder_level'
    ];
   

    protected $appends = ['pivot_date_approved', 'pivot_date_delivery', 'pivot_price', 'total_amount']; 

    public function chartAccount(){
        return $this->hasOne('App\Model\ChartAccount', 'id', 'chart_account_id');
    }
    public function itemable(){

    	return $this->morphTo();
    }

    public function logistics()
    {
        return $this->vendorable('App\Model\Logistic');
    }

    public function branches()
    {
        return $this->vendorable('App\Model\Branch');
    }

    public function commissaries()
    {
        return $this->vendorable('App\Model\Commissary');
    }

    public function otherVendors()
    {
        return $this->vendorable('App\Model\OtherVendor');

    }

    public function accessRights()
    {
        return $this->morphToMany('App\Model\AccessRight', 'accessable');
    }

    public function package(){

        return $this->hasOne('App\Model\Package', 'id', 'package_id');
    }

    public function vendorable($model){

        return $this->morphedByMany($model,'vendorable')
                    ->withPivot(['id','rank', 'dis_percentage', 'start_date', 'end_date', 'price', 'volume', 'remarks', 'created_by', 'approved_by', 'freight']);

    }

    public function purchases(){
        return $this->belongsToMany('App\Model\Purchase', 'item_purchase', 'item_id', 'purchase_id')
                    ->withPivot('id', 'qty', 'price', 'freight', 'approved_by', 'date_approved', 'date_delivery', 'token')
                    ->withTimestamps();
    }

    public function scopeRelTable($query){

        return $query->with(['package', 'logistics', 'otherVendors', 'branches', 'commissaries', 'purchases', 'chartAccount']);
    }

    public function getPivotDateApprovedAttribute(){

        return $this->purchases->map(function($purchase){

            if($purchase->pivot->date_approved != null){
                return Carbon::parse($purchase->pivot->date_approved)->toDayDateTimeString();
            }
                
        })->first();
        
    }

    public function getPivotPriceAttribute(){

        return (float)$this->pivot['price'];
        
    }

    public function getTotalAmountAttribute(){

        return (float)$this->pivot['price'] * (float)$this->pivot['qty'];
        
    }

    public function getPivotDateDeliveryAttribute(){

        return Carbon::parse($this->pivot['date_delivery'])->toDayDateTimeString();
        
    }
    
   
}
