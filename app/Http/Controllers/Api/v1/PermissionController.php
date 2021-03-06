<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Permission;
use App\Enums\PermissionsEnum;
use App\Http\Resources\PermissionResource;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionController extends ApiController
{
    public function index()
    {
        $this->authorize(PermissionsEnum::PERMISSION_INDEX->value);

        $permissions = Permission::query()->paginate();

        return PermissionResource::collection($permissions);
    }

    public function store(StorePermissionRequest $request)
    {
        $this->authorize(PermissionsEnum::PERMISSION_STORE->value);

        $permission = Permission::create($request->validated());

        return new PermissionResource($permission);
    }

    public function show($id)
    {
        $this->authorize(PermissionsEnum::PERMISSION_SHOW->value);

        $permission = Permission::findOrFail($id);

        return new PermissionResource($permission);
    }

    public function update(UpdatePermissionRequest $request, $id)
    {
        $this->authorize(PermissionsEnum::PERMISSION_UPDATE->value);

        $permission = Permission::findOrFail($id);

        $permission->update($request->validated());

        return new PermissionResource($permission);
    }

    public function destroy($id)
    {
        $this->authorize(PermissionsEnum::PERMISSION_DESTROY->value);
    }
}
