<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Position;
use App\Enums\PermissionsEnum;
use App\Http\Resources\PositionResource;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;

class PositionController extends ApiController
{
    public function index()
    {
        $this->authorize(PermissionsEnum::POSITION_INDEX->value);

        $positions = Position::query()->paginate();

        return PositionResource::collection($positions);
    }

    public function store(StorePositionRequest $request)
    {
        $this->authorize(PermissionsEnum::POSITION_STORE->value);

        $position = Position::create($request->validated());

        return new PositionResource($position);
    }

    public function show($id)
    {
        $this->authorize(PermissionsEnum::POSITION_SHOW->value);

        $position = Position::findOrFail($id);

        return new PositionResource($position);
    }

    public function update(UpdatePositionRequest $request, $id)
    {
        $this->authorize(PermissionsEnum::POSITION_UPDATE->value);

        $position = Position::findOrFail($id);

        $position->update($request->validated());

        return new PositionResource($position);
    }

    public function destroy($id)
    {
        $this->authorize(PermissionsEnum::POSITION_DESTROY->value);
    }
}
