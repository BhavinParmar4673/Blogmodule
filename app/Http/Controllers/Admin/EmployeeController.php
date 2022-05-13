<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Traits\DatatableTrait;

class EmployeeController extends Controller
{
    use DatatableTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'Employees';
        return $this->view('admin.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title'] = 'Create Employee';
        return $this->view('admin.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->name = $request->title;
        $employee->designation = $request->designation;
        $employee->qualification = $request->qualification;
        $employee->description = $request->description;
        $employee->is_active = now()->format('Y-m-d H:i:s');
        $employee->save();

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $employee->addMediaFromRequest('file')->toMediaCollection('employee');
        }

        return redirect()->route('admin.employee.index')->with('success', 'Employee Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
    }

    public function dataListing(Request $request)
    {

        // Listing columns to show
        $columns = array(
            0 => 'id',
            1 => 'name',
            4 => 'status',
            5 => 'action',
        );

        $totalData = Employee::count(); // table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $contactCollection = Employee::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")->orWhere('designation', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $contactCollection->count();

        $contactCollection = $contactCollection->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($contactCollection as $key => $item) {
            // dd($item);
            $row['id'] = $item->id;
            $row['name'] = $item->name;
            $row['designation'] = $item->designation;
            $row['qualification'] = $item->qualification ?? 'N/A';
            $row['status'] = $this->status($item->is_active, $item->id, route('admin.employee.status', ['id' => $item->id]));
            $row['action'] =  '<a href="' . route('admin.employee.edit', $item->id) . '"  class="edit btn btn-primary btn-sm">
            <i class="fas fa-edit"></i>
            </a>
            <a href="javascript:void(0);" data-url="' . route('admin.employee.destroy', $item->id) . '"
                data-id=' . $item->id . '  class="delete btn btn-danger btn-sm">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>';
            $data[] = $row;
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        return response()->json($json_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $this->data['title'] = 'Edit Employee';
        $this->data['employee'] = $employee;
        return $this->view('admin.employee.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $employee->name = $request->title;
        $employee->designation = $request->designation;
        $employee->qualification = $request->qualification;
        $employee->description = $request->description;
        $employee->save();

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $employee->clearMediaCollection('employee');
            $employee->addMediaFromRequest('file')->toMediaCollection('employee');
        }

        return redirect()->route('admin.employee.index')->with('success', 'Employee Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(['success' => 'Employee deleted successfully.'], 200);
    }

    public function exists(Request $request)
    {
        $id = $request->get('id');
        $count = Employee::when($id != null, function ($query) use ($request) {
            return $query->where('id', '!=', $request->id);
        })->where('name', $request->title)->count();
        if ($count > 0) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function changeStatus(Request $request, $id)
    {
        $employee = Employee::findOrFail($request->id);
        $employee->is_active  = $request->status == 'true' ? null :  date('Y-m-d H:i:s');

        if ($employee->save()) {
            $statusCode = 200;
        }

        $status = $request->status == 'true' ? 'active' : 'deactivate';
        $message = "Employee $status successfully.";

        return response()->json([
            'success' => true,
            'message' => $message
        ], $statusCode ?? 400);
    }
}