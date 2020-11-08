<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use function App\Helpers\greekToEnglish;

class UserController extends Controller {

    public function test(Request  $request)
    {


        $name = $request->file("files")[0];
        $user = new User();
        $user->addMedia($name)->toMediaCollection('images');

    }
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

        $user = auth()->user();
        $user->addMedia($request->avatar)->toMediaCollection();

        return redirect()->back();

        $user = new User([
            "name" => $request->first_name . "-" . $request->last_name,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "profile" => $request->profile,
            "password" => Hash::make($request->password),
            "phone" => $request->phone,
            "slug" => Str::slug($request->first_name . $request->last_name, "-"),
            "status" => $request->status ? 1 : 0,

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
