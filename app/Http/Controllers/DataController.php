<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Membership;
use App\Models\User;

class DataController extends Controller
{
    public function index()
    {
        return [
            'users' => User::all(),
            'groups' => Group::all(),
            'memberships' => Membership::all(),
        ];
    }
}
