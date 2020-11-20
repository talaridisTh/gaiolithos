<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleAjaxController extends Controller
{
    //
    public function initDatatableRole()
    {
        return Datatables::of(Role::query())
            ->addColumn("checkbox", function ($data) {
                return ("
                    <div class='pretty p-default p-round p-smooth p-plain'>
                        <input type='checkbox' class='checkbox-single' />
                         <div class='state p-info-o'>
                             <label> </label>
                         </div>
                     </div>
                ");
            })
            ->editColumn('action', function ($data) {
                return ("
                    <a href='/show/$data->id' class='action-icon text-info'> <i class='mdi mdi-pencil'></i></a>
                    <a href='javascript: void(0);' data-delete='role_$data->id' class='action-icon js-delete-datatable text-danger'> <i class='mdi mdi-delete'></i></a>
                ");
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at->diffForHumans();
            })
            ->rawColumns(["checkbox", "action"])
            ->make(true);
    }
}
