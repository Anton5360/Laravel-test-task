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
}

if(!function_exists('validatePreparedXmlOrFail')){
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
            '*.work_hours' => 'bail|required|numeric',
            '*.salary' => 'bail|required|numeric',
        ])->validate();
    }
}

if(!function_exists('getPreparedXmlFile')){
    /**
     * @param string $xml
     * @return array|false
     */
    function getPreparedXmlFile(string $xml)
    {
        [$file, $preparedXML, $counter] = [
            simplexml_load_string($xml),
            [],
            0
        ];

        foreach($file as $employee){
            $xmlArray = json_decode(json_encode($employee),1);

            foreach($xmlArray as $key => $employeeInfo)
                $preparedXML[$counter][$key] = $employeeInfo;

            $counter++;
        }

        return $preparedXML ?: false;
    }
}
