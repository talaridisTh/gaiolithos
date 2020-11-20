<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //
    public function index()
    {

        return view("dashboard.role.role-main");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required"
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->back()->with('create', 'Ο ρόλος' . $request->name . ' δημιουργήθηκε');
    }

}
