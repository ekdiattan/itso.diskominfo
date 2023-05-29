<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request) {
            $role = DB::table('roles')->where('role', 'ilike', '%'.$request->search2.'%')->paginate(10);
        }else{
            $role = DB::table('roles')->where('role', true)->paginate(10);
        }
        return view('home.master.role.index', ['roles'=> $role, 'title' => 'Role']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.master.role.create', ['title' => 'Role']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Role::create($request->all());
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan data!');
        return redirect('/role');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        return view('home.master.role.edit', ['role' => $role, 'title' => 'Role']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $role = Role::find($id);
        // return view('home.role.edit', ['role' => $role]);
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
        $role = Role::find($id);
        $role->update($request->all());
        $request->accepts('session');
        session()->flash('success', 'Berhasil Mengupdate data!');

        return redirect('/role')->with('success', 'Berhasil Mengupdate Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $role = Role::find($id);
        $role->delete();
        session()->flash('success', 'Role Berhasil dihapus');
        
        return redirect('/role')->with('success', 'Role berhasil dihapus');
    }
}