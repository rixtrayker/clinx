<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Auth;

class
 extends Controller
{
    public $model;
    public $module;
    public $rules;

    // protected $protect_methods = [
    //     'create' => ['store'],    // protects store() method on create.user (create.alias)
    //     'view'   => ['index', 'create', 'show', 'edit'],     // protects index(), create(), show(), edit() methods on view.user permission.
    //     'update' => ['update'],
    //     'delete' => ['destroy']
    // ];

    public function __construct(Role $model)
    {
        // parent::__construct();
        $this->module = 'roles';
        $this->model = $model;
        $this->rules = [
            'name' => 'required|unique:roles,name',
            'description' => 'required'
        ];
    }

    public function index()
    {
        // Auth::guard('admin')->user()->can('view.role');
        $rows = $this->model->latest();
        $rows = $rows->get();
        return view('admin.' . $this->module . '.index', ['rows' => $rows, 'module' => $this->module]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
