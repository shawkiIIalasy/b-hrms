<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\User;

class EmployeeController extends ApiController
{
    public function index()
    {
        $this->authorize('employee-index');

        $employees = Employee::query()->paginate();

        return EmployeeResource::collection($employees);
    }

    public function store(StoreEmployeeRequest $request)
    {
        $this->authorize('employee-store');

        $user = User::create(['email' => $request->email, 'password' => $request->password]);

        $employee = Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'user_id' => $user->id,
            'country_id' => $request->country_id,
            'position_id' => $request->position_id
        ]);

        return new EmployeeResource($employee);
    }

    public function show($id)
    {
        $this->authorize('employee-show');

        $employee = Employee::findOrFail($id);

        return new EmployeeResource($employee);
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {
        $this->authorize('employee-update');

        $employee = Employee::findOrFail($id);

        $employee->update($request->validated());

        return new EmployeeResource($employee);
    }

    public function destroy($id)
    {
        $this->authorize('employee-delete');

    }

    public function activate($id)
    {
        $this->authorize('employee-activate');

        $employee = Employee::findOrFail($id);

        $employee->active = true;

        $employee->update();

        return new EmployeeResource($employee);
    }

    public function deactivate($id)
    {
        $this->authorize('employee-deactivate');

        $employee = Employee::findOrFail($id);

        $employee->active = false;

        $employee->update();

        return new EmployeeResource($employee);
    }
}
