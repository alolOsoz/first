<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected $fillable = ['photo', 'name_ar', 'name_en', 'price', 'details_ar', 'details_en', 'status', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function scopeInactive($query)
    {
        return $query->where('status', 0);

    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OfferScope());
    }

//mutators
    public function setNameEnAttribute($val)
    {
        $this->attributes['name_en'] = strtoupper($val);
    }

}
