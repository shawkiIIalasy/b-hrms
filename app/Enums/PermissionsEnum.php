<?php

namespace App\Enums;

enum PermissionsEnum: string
{
    case EMPLOYEE_INDEX = 'employee-index';
    case EMPLOYEE_UPDATE = 'employee-update';
    case EMPLOYEE_SHOW = 'employee-show';
    case EMPLOYEE_STORE = 'employee-store';
    case EMPLOYEE_DESTROY = 'employee-destroy';
    case EMPLOYEE_ACTIVATE = 'employee-activate';
    case EMPLOYEE_DEACTIVATE = 'employee-deactivate';

    case COUNTRY_INDEX = 'country-index';
    case COUNTRY_UPDATE = 'country-update';
    case COUNTRY_SHOW = 'country-show';
    case COUNTRY_STORE = 'country-store';
    case COUNTRY_DESTROY = 'country-destroy';

    case POSITION_INDEX = 'position-index';
    case POSITION_UPDATE = 'position-update';
    case POSITION_SHOW = 'position-show';
    case POSITION_STORE = 'position-store';
    case POSITION_DESTROY = 'position-destroy';

    case ROLE_INDEX = 'role-index';
    case ROLE_UPDATE = 'role-update';
    case ROLE_SHOW = 'role-show';
    case ROLE_STORE = 'role-store';
    case ROLE_DESTROY = 'role-destroy';

    case PERMISSION_INDEX = 'permission-index';
    case PERMISSION_UPDATE = 'permission-update';
    case PERMISSION_SHOW = 'permission-show';
    case PERMISSION_STORE = 'permission-store';
    case PERMISSION_DESTROY = 'permission-destroy';
}
