<?php

namespace JobBoard\Models\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Poster
 *
 * Class to define Poster entity.
 *
 * @package JobBoard\Models\Entities
 *
 * @property string $email
 * @property bool $spam
 * @property bool $approved
 */
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
