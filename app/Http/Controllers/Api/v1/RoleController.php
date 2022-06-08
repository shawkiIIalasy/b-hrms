<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;

class RoleController extends ApiController
{
    public function index()
    {
        $this->authorize('role-index');

        $roles = Role::query()->paginate();

        return RoleResource::collection($roles);
    }

    public function store(StoreRoleRequest $request)
    {
        $this->authorize('role-store');

        $role = Role::create($request->validated());

        return new RoleResource($role);
    }

    public function show($id)
    {
        $this->authorize('role-show');

        $role = Role::findOrFail($id);

        return new RoleResource($role);
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $this->authorize('role-update');

        $role = Role::findOrFail($id);

        $role->update($request->validated());

        return new RoleResource($role);
    }

    public function destroy($id)
    {
        $this->authorize('role-delete');

    }
}
