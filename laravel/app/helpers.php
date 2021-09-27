<?php

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

if(!function_exists('getEmployeeListViewWithParams')){
    function getEmployeeListViewWithParams(LengthAwarePaginator $pagination): View
    {
        return view('index.content', [
            'employees' => Employee::getPreparedPaginatedItems($pagination->items()),
            'perPage' => $pagination->perPage(),
            'pagesQuantity' => $pagination->lastPage(),
            'currentPage' => $pagination->currentPage(),
            'departments' => Department::allWithoutTimestamps()
        ]);
    }
}if(!function_exists('validatePreparedXmlOrFail')){
    function validatePreparedXmlOrFail(array $preparedXML): void
    {
        Validator::make($preparedXML, [
            '*.department_id' => 'bail|required|integer',
            '*.first_name' => 'bail|required|string',
            '*.last_name' => 'bail|required|string',
            '*.middle_name' => 'bail|required|string',
            '*.birthdate' => 'bail|required|date',
            '*.position' => 'bail|required|string',
            '*.salary_type' => 'bail|required|string|in:hourly,monthly',
            '*.work_hours' => 'bail|required|float',
            '*.salary' => 'bail|required|float',
        ])->validate();
    }
}
