<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $employees = Employee::query()->paginate();

        return EmployeeResource::collection($employees);
    }

    public function store(StoreEmployeeRequest $request)
    {
        $user = User::create(['email' => $request->email, 'password' => $request->password]);

        $employee = Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_id' => $user->id,
            'country_id' => $request->country_id,
            'position_id' => $request->position_id
        ]);

        return new EmployeeResource($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return EmployeeResource
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return EmployeeResource
     */
    public function update( UpdateEmployeeRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $employee->update($request->validated());

        return new EmployeeResource($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function activate($id) {
        $employee = Employee::findOrFail($id);

        $employee->active = true;

        $employee->update();

        return new EmployeeResource($employee);
    }

    public function deactivate($id) {
        $employee = Employee::findOrFail($id);

        $employee->active = false;

        $employee->update();

        return new EmployeeResource($employee);
    }
}
