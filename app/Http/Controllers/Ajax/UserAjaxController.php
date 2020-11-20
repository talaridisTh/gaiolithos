<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserAjaxController extends Controller {

    //
    public function initDatatableUser()
    {
        return Datatables::of(User::query())
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
            ->addColumn("role", function ($data) {
                return $data->getRoleNames()->toArray();
            })
            ->editColumn("status", function ($data) {
                $checked = $data->status ? "checked" : "";

                return (
                    "<input type='checkbox' $data->status $checked id='switch-status-{$data->slug}' data-switch='user_$data->id' class='js-switch'  data-switch='bool'/>
                     <label for='switch-status-{$data->slug}'  data-on-label='On' data-off-label='Off'></label>"
                );
            })
            ->editColumn('action', function ($data) {
                return ("
                    <a href='/show/$data->id' class='action-icon text-info'> <i class='mdi mdi-pencil'></i></a>
                    <a href='javascript: void(0);' data-delete='user_$data->id' class='action-icon js-delete-datatable text-danger'> <i class='mdi mdi-delete'></i></a>
                ");
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at->diffForHumans();
            })
            ->rawColumns(['status', "checkbox", "action"])
            ->make(true);
    }

}
