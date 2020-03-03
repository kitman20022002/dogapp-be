<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //
    protected $fillable = [
        'name', 'domain'
    ];

    /**
     * Get all of the users that belong to the store.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'store_users');
    }
}
