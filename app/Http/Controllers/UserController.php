<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserRequestCreate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller {

    public function index()
    {

        return view("dashboard.user.user-main");
    }


    public function create()
    {
        return view("dashboard.user.user", [
            "roles" => Role::all()
        ]);
    }

    public function store(UserCreateRequest $request)
    {

        $user = new User([
            "name" => $request->first_name . "-" . $request->last_name,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "profile" => $request->profile,
            "password" => Hash::make($request->password),
            "phone" => $request->phone,
            "description" => $request->description,
            "slug" => Str::slug($request->first_name . $request->last_name, "-"),
            "status" => $request->status ? 1 : 0,
            "avatar" => "replaceMe"
        ]);
        $user->save();

        return redirect()->back();
    }

    public function show($user)
    {

        return view("dashboard.user.user", [
            "roles" => Role::all(),
            "user"=>User::findOrFail($user)
        ]);
    }

}
