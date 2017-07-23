<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User  user
 * @property Group group
 * @property integer id
 */
class Membership extends Model
{
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
