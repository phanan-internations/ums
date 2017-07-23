<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer id
 */
class User extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * A user can belong to many groups.
     *
     * @return BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'memberships');
    }

    /**
     * @return HasMany
     */
    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }
}
