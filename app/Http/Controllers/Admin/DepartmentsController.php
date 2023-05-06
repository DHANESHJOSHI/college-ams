<?php

namespace App\Http\Controllers\Admin;

use App\Departments;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLessonRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class DepartmentsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('department_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $department = Departments::all();
        return view('admin.departments.index', compact('department'));
    }


    public function create()
    {
        abort_if(Gate::denies('department_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('department_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Departments::create($request->all());
        return redirect()->route('admin.departments.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function show(Departments $departments)
    {
        abort_if(Gate::denies('department_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//        $departments->load('department_code', 'department_name');
        $departments = Departments::all();
        return view('admin.departments.show' , compact('departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function edit(Departments $departments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departments $departments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departments $departments)
    {
        abort_if(Gate::denies('departments_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $departments->delete();
        return redirect()->route('admin.departments.index');
    }

    public function massDestroy(MassDestroyLessonRequest $request)
    {
        Departments::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
