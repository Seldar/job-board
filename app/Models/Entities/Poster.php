<?php

namespace JobBoard\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

}
