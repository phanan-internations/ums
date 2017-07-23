<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Models\Group;

class GroupController extends Controller
{
    /**
     * @var Group
     */
    private $group;

    /**
     * GroupController constructor.
     *
     * @param Group $group
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Group::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGroupRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        $group = $this->group->create([
            'name' => $request->name,
        ]);

        return response()->json($group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        /** @var Group $group */
        $group = Group::with('users')->findOrFail($id);

        if ($group->users->count()) {
            abort(403, 'The group is not empty and therefore cannot be deleted.');
        }

        Group::destroy($id);

        return response()->json();
    }
}
