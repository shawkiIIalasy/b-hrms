<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Models\Employee;
use App\Enums\PermissionsEnum;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends ApiController
{
    public function index()
    {
        $this->authorize(PermissionsEnum::EMPLOYEE_INDEX->value);

        $employees = Employee::query()->paginate();

        return EmployeeResource::collection($employees);
    }

    public function store(StoreEmployeeRequest $request)
    {
        $this->authorize(PermissionsEnum::EMPLOYEE_STORE->value);

        $user = User::create(['email' => $request->email, 'password' => $request->password]);

        $user->assignRole([$request->role_id]);

        $employee = Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'user_id' => $user->id,
            'country_id' => $request->country_id,
            'position_id' => $request->position_id,
        ]);

        return new EmployeeResource($employee);
    }

    public function show($id)
    {
        $this->authorize(PermissionsEnum::EMPLOYEE_SHOW->value);

        $employee = Employee::findOrFail($id);

        return new EmployeeResource($employee);
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {
        $this->authorize(PermissionsEnum::EMPLOYEE_UPDATE->value);

        $employee = Employee::findOrFail($id);

        $employee->update($request->validated());

        return new EmployeeResource($employee);
    }

    public function destroy($id)
    {
        $this->authorize(PermissionsEnum::EMPLOYEE_DESTROY->value);
    }

    public function activate($id)
    {
        $this->authorize(PermissionsEnum::EMPLOYEE_ACTIVATE->value);

        $employee = Employee::findOrFail($id);

        $employee->active = true;

        $employee->update();

        return new EmployeeResource($employee);
    }

    public function deactivate($id)
    {
        $this->authorize(PermissionsEnum::EMPLOYEE_DEACTIVATE->value);

        $employee = Employee::findOrFail($id);

        $employee->active = false;

        $employee->update();

        return new EmployeeResource($employee);
    }
}
