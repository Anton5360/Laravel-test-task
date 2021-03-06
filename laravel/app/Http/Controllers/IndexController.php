<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function employees(Request $request): View
    {
        return getEmployeeListViewWithParams(
            Employee::getPaginateEmployeeList($request)
        );
    }

    public function departmentEmployees(int $departmentID, Request $request): View
    {
        return getEmployeeListViewWithParams(
            Employee::getPaginateEmployeeList($request, $departmentID)
        );
    }

    public function uploadXML(Request $request): RedirectResponse
    {
        $request->validate([
            'xml' => 'required|file'
        ]);

        $file = $request->file('xml');

        if($file->extension() !== 'xml'){
            return redirect()->back()->withErrors(['error' => 'Error! Wrong file extension']);
        }

        if(!$preparedXML = getPreparedXmlFile($request->file('xml')->get())){
            return redirect()->back()->withErrors(['error' => 'Error! XML file is empty']);
        }


        validatePreparedXmlOrFail($preparedXML);


        Employee::insert($preparedXML);

        return redirect()->back()->with('success', 'Employee(s) was (were) uploaded successfully');
    }
}
