<?php

namespace JobBoard\Models\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Job
 *
 * Class to define Job entity.
 *
 * @package JobBoard\Models\Entities
 */
class Job extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'poster_id'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * BelongsTo Relation definition to access related poster Model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poster()
    {
        return $this->belongsTo(Poster::class, "poster_id", "id");
    }
}
