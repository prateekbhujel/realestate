<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyMessage extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     *  Making an relation with property model
     */
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    } // End method


    /**
     *  Making an relation with user model
     */
    public function user()
    {
return $this->belongsTo(User::class, 'user_id', 'id');
    } // End method    
}
