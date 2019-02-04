<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use App\Model\Tax;

class PurchaseReceived extends Model
{
    protected $table = 'purchase_received';
    protected $fillable = [
        'purchase_recieved_id', 'qty', 'price', 'freight', 'tax', 'token', 'sub_total', 'grand_total', 'date_due'
    ];
   
    protected $appends = ['vatable_sales', 'vat_exempt_sales', 'zero_rated_sales', 'vat_amount'];
    public function items(){
        return $this->belongsToMany('App\Model\Item', 'item_purchase_recieved', 'purchase_received_id', 'item_id')
                    ->withPivot('id', 'qty', 'price', 'freight', 'sub_total')
                    ->withTimestamps();
    }

    public function purchase(){
=======

class PurchaseReceived extends Model
{

    protected $table = 'purchase_received';
    protected $fillable = [
        'purchase_received_id', 'qty', 'price', 'freight', 'tax', 'token', 'sub_total', 'grand_total',
    ];

    public function items()
    {
        return $this->belongsToMany('App\Model\Item', 'item_purchase_received', 'purchase_received_id', 'item_id')
            ->withPivot('id', 'qty', 'price', 'freight', 'sub_total')
            ->withTimestamps();
    }

    public function purchase()
    {
>>>>>>> 9c9e82789c8429b36cd293e9d2c5d423280aee5c

        return $this->hasOne('App\Model\Purchase', 'id', 'purchase_id');
    }

<<<<<<< HEAD
    public function purchasable(){
=======
    public function purchasable()
    {
>>>>>>> 9c9e82789c8429b36cd293e9d2c5d423280aee5c

        return $this->morphTo();
    }

<<<<<<< HEAD
    public function getDiscountAttribute($val){
        return (float)$val;
    }
    public function getGrandTotalAttribute($val){
        return (float)$val;
    }

    public function getvatableSalesAttribute(){
       
       return (float) $this->items->filter(function($i){
            return $i->tax_type_id === 1;
        })->map(function($item){
            return $item->pivot->price * $item->pivot->qty;
        })->first();

    }

    public function getvatExemptSalesAttribute(){
       return (float) $this->items->filter(function($i){
            return $i->tax_type_id === 2;
        })->map(function($item){
            return $item->pivot->price * $item->pivot->qty;
        })->first();
    }
    public function getzeroRatedSalesAttribute(){
        return (float)$this->items->filter(function($i){
            return $i->tax_type_id === 3;
        })->map(function($item){
            return $item->pivot->price * $item->pivot->qty;
        })->first();
    }
    public function getvatAmountAttribute(){
        return (float) number_format( $this->getvatableSalesAttribute() * (Tax::where('default', 1)->first()->percent/100), 2, '.', '') ;
=======
    public function getGrandTotalAttribute($val)
    {
        return (float) $val;
>>>>>>> 9c9e82789c8429b36cd293e9d2c5d423280aee5c
    }
}