<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'region_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function region(){
        return $this->belongsTo(Region::class);
    }
}
