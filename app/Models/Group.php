<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property integer id
 * @property Collection users
 */
class Group extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * A group can have many users.
     *
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'memberships');
    }

    /**
     * @return HasMany
     */
    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }
}
