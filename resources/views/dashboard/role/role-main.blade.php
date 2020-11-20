@extends("layouts.dashboard")

@section("content")
    <x-message.swal msg="create" icon="success"></x-message.swal>

    <div class="container-fluid my-4 table-responsive">

        <div class="text-right mb-3">
            <button type="button" class="btn btn-radius btn-primary mr-2" data-toggle="modal"
                    data-target="#create-role-modal">Δημιουργία
            </button>
            <div class="dropdown d-inline">
                <button type="button" data-name="Επιλογές" hidden class="dropdown-toggle btn btn-radius btn-warning js-bulkaction-setting" data-toggle="dropdown">
                    Επιλογές
                </button>
                <div class="dropdown-menu mt-2 dropdown-menu-animated" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item js-multiple-delete" href="#">Μαζική διαγραφεί </a>
                </div>
            </div>
        </div>

        <table id="role-main-datatable" class="table dt-responsive nowrap w-100 tables-hover-effect">
            <thead>
            <tr>
                <th>
                    <div class="pretty p-icon p-jelly ">
                        <input type="checkbox" class="js-checkbox-all"/>
                        <div class="state p-info-o">
                            <i class="icon mdi mdi-check-all"></i>
                            <label></label>
                        </div>
                    </div>
                </th>
                <th>Όνομα</th>
                <th>Δημιουργήθηκε</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th></th>
                <th>Όνομα</th>
                <th>Δημιουργήθηκε</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    </div>

    <div class="modal fade" id="create-role-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Δημιουργία Ρόλου</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{route('role.store')}}" method="post">
                        @csrf
                        <label for="role-create-modal">Ονομα Ρόλου</label>
                        <input type="text" name="name" id="role-create-modal"
                               class="form-control @error('first_name') border-danger @enderror">
                        @error("name")
                        <div class="invalid-feedback d-block">{{$message}}</div>
                        @enderror

                        <div class="w-100">
                            <button class="js-create-role w-100 btn btn-primary btn-sm my-2">Δημιουργία</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection



@section("script")
    <script src="/assets/js/vendor/jquery.dataTables.min.js"></script>
    <script src="/assets/js/vendor/dataTables.bootstrap4.js"></script>
    <script src="{{mix("js/dashboard/role/role-main.js")}}"></script>

    <x-message.error-modal value=#create-role-modal></x-message.error-modal>

@endsection
