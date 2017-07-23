<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string password
 * @property string api_token
 */
class Administrator extends Model
{
    protected $hidden = ['password', 'created_at', 'updated_at'];
}
