@extends("layouts.dashboard")

@section("content")
    <div class="container-fluid my-4 table-responsive">

        <select id="activeFilter">
            <option value="">Όλες οι Καταστάσεις</option>
            <option value="1">Ενεργοί</option>
            <option value="0">Μη Ενεργοί</option>
        </select>

        <x-user.bulkAction></x-user.bulkAction>
        <table id="user-main-datatable" class="table dt-responsive nowrap w-100 tables-hover-effect">
            <thead>
            <tr>
                <th>
                    <div class="pretty p-icon p-jelly ">
                        <input type="checkbox" class="js-checkbox-all" />
                        <div class="state p-info-o">
                            <i class="icon mdi mdi-check-all"></i>
                            <label></label>
                        </div>
                    </div>
                </th>
                <th>Όνομα</th>
                <th>Επώνυμο</th>
                <th>E-mail</th>
                <th>Τηλέφωνο</th>
                <th>Ρόλος</th>
                <th>Κατάσταση</th>
                <th>Δημιουργήθηκε</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Όνομα</th>
                <th>Όνομα</th>
                <th>Επώνυμο</th>
                <th>E-mail</th>
                <th>Τηλέφωνο</th>
                <th>Ρόλος</th>
                <th>Κατάσταση</th>
                <th>Δημιουργήθηκε</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection


@section("script")
    <script src="/assets/js/vendor/jquery.dataTables.min.js"></script>
    <script src="/assets/js/vendor/dataTables.bootstrap4.js"></script>
    <script src="{{mix("js/dashboard/user/user-main.js")}}"></script>
@endsection


