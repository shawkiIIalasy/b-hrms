<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Http\Resources\PositionResource;
use App\Models\Position;

class PositionController extends ApiController
{
    public function index()
    {
        $this->authorize('position-index');

        $positions = Position::query()->paginate();

        return PositionResource::collection($positions);
    }

    public function store(StorePositionRequest $request)
    {
        $this->authorize('position-store');

        $position = Position::create($request->validated());

        return new PositionResource($position);
    }

    public function show($id)
    {
        $this->authorize('position-show');

        $position = Position::findOrFail($id);

        return new PositionResource($position);
    }

    public function update(UpdatePositionRequest $request, $id)
    {
        $this->authorize('position-update');

        $position = Position::findOrFail($id);

        $position->update($request->validated());

        return new PositionResource($position);
    }

    public function destroy($id)
    {
        $this->authorize('position-delete');

    }
}
