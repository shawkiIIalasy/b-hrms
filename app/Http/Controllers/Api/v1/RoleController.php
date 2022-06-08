<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Role;
use App\Enums\PermissionsEnum;
use App\Http\Resources\RoleResource;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;

class RoleController extends ApiController
{
    public function index()
    {
        $this->authorize(PermissionsEnum::ROLE_INDEX->value);

        $roles = Role::query()->paginate();

        return RoleResource::collection($roles);
    }

    public function store(StoreRoleRequest $request)
    {
        $this->authorize(PermissionsEnum::ROLE_STORE->value);

        $role = Role::create($request->validated());

        return new RoleResource($role);
    }

    public function show($id)
    {
        $this->authorize(PermissionsEnum::ROLE_SHOW->value);

        $role = Role::findOrFail($id);

        return new RoleResource($role);
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $this->authorize(PermissionsEnum::ROLE_UPDATE->value);

        $role = Role::findOrFail($id);

        $role->update($request->validated());

        return new RoleResource($role);
    }

    public function destroy($id)
    {
        $this->authorize(PermissionsEnum::ROLE_DESTROY->value);
    }
}
