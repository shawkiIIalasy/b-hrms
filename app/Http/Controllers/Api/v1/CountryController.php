<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Country;
use App\Enums\PermissionsEnum;
use App\Http\Resources\CountryResource;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;

class CountryController extends ApiController
{
    public function index()
    {
        $this->authorize(PermissionsEnum::COUNTRY_INDEX->value);

        $countries = Country::query()->paginate();

        return CountryResource::collection($countries);
    }

    public function store(StoreCountryRequest $request)
    {
        $this->authorize(PermissionsEnum::COUNTRY_STORE->value);

        $country = Country::create($request->validated());

        return new CountryResource($country);
    }

    public function show($id)
    {
        $this->authorize(PermissionsEnum::COUNTRY_SHOW->value);

        $country = Country::findOrFail($id);

        return new CountryResource($country);
    }

    public function update(UpdateCountryRequest $request, $id)
    {
        $this->authorize(PermissionsEnum::COUNTRY_UPDATE->value);

        $country = Country::findOrFail($id);

        $country->update($request->validated());

        return new CountryResource($country);
    }

    public function destroy($id)
    {
        $this->authorize(PermissionsEnum::COUNTRY_DESTROY->value);
    }
}
