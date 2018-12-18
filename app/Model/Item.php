<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $table = 'items';
    protected $fillable = [
      'itemable_id', 'itemable_type', 'sku', 'barcode', 'name', 'desc', 'price', 'qty', 'package_id', 'minimum', 'maximum', 'reorder_level'
    ];

    public function branches()
    {
        return $this->morphedByMany('App\Model\Branch', 'vendorable')->withPivot('id','rank', 'dis_percentage', 'start_date', 'end_date', 'price', 'volume', 'remarks', 'created_by', 'approved_by');
    }

    public function logistics()
    {
        return $this->morphedByMany('App\Model\Logistic', 'vendorable')->withPivot('id','rank', 'dis_percentage', 'start_date', 'end_date', 'price', 'volume', 'remarks', 'created_by', 'approved_by');
    }

    public function commissaries()
    {
        return $this->morphedByMany('App\Model\Commissary', 'vendorable')->withPivot('id','rank', 'dis_percentage', 'start_date', 'end_date', 'price', 'volume', 'remarks', 'created_by', 'approved_by');
    }

    public function package(){

        return $this->hasOne('App\Model\Package', 'id', 'package_id');
    }

    public function scopeRelTable($query){

        return $query->with(['package', 'branches', 'commissaries', 'logistics']);
    }
}