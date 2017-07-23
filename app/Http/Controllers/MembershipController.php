<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemoveMembershipRequest;
use App\Http\Requests\StoreMembershipRequest;
use App\Models\Group;
use App\Models\Membership;
use App\Models\User;

class MembershipController extends Controller
{
    /**
     * @var Membership
     */
    private $membership;

    /**
     * @var Group
     */
    private $group;

    /**
     * @var User
     */
    private $user;

    /**
     * MembershipController constructor.
     *
     * @param Membership $membership
     * @param Group      $group
     * @param User       $user
     */
    public function __construct(Membership $membership, Group $group, User $user)
    {

        $this->membership = $membership;
        $this->group = $group;
        $this->user = $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMembershipRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembershipRequest $request)
    {
        $existing = $this->membership
            ->where('user_id', $request->user_id)
            ->where('group_id', $request->group_id)
            ->first();
        if ($existing) {
            abort(403, 'Membership already exists.');
        }

        $membership = $this->membership->create([
            'group_id' => $this->group->findOrFail($request->group_id)->id,
            'user_id' => $this->user->findOrFail($request->user_id)->id,
        ]);

        return response()->json($membership);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param integer $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Membership::destroy($id);

        return response()->json();
    }
}
