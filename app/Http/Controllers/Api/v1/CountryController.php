<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;

class CountryController extends ApiController
{
    public function index()
    {
        $this->authorize('country-index');

        $countries = Country::query()->paginate();

        return CountryResource::collection($countries);
    }

    public function store(StoreCountryRequest $request)
    {
        $this->authorize('country-store');

        $country = Country::create($request->validated());

        return new CountryResource($country);
    }

    public function show($id)
    {
        $this->authorize('country-show');

        $country = Country::findOrFail($id);

        return new CountryResource($country);
    }

    public function update(UpdateCountryRequest $request, $id)
    {
        $this->authorize('country-update');

        $country = Country::findOrFail($id);

        $country->update($request->validated());

        return new CountryResource($country);
    }

    public function destroy($id)
    {
        $this->authorize('country-delete');

    }
}
