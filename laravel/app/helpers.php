<?php

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

if(!function_exists('getEmployeeListViewWithParams')){
    function getEmployeeListViewWithParams(LengthAwarePaginator $pagination): View
    {
        return view('index.layout', [
            'employees' => Employee::getPreparedPaginatedItems($pagination->items()),
            'perPage' => $pagination->perPage(),
            'pagesQuantity' => $pagination->lastPage(),
            'currentPage' => $pagination->currentPage(),
            'departments' => Department::allWithoutTimestamps()
        ]);
    }
}
