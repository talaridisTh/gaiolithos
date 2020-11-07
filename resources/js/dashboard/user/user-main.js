import {datatablelanguage} from "../../config.json"
import {onCheckbox, onSwitchDatatable, onBulkAction, filterButton, onDeleteDatatable} from "../main";
import select2 from "../../../theme/js/vendor/select2.min"

/* Instal Datatables
  */
const userMainTable = $("#user-main-datatable").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: "/user-main/datatable"
    },
    columns: [
        {data: "checkbox", name: "checkbox", orderable: false},
        {data: 'first_name', name: 'first_name'},
        {data: 'last_name', name: 'last_name'},
        {data: 'email', name: 'email'},
        {data: 'phone', name: 'phone'},
        {data: 'role', name: 'role'},
        {data: 'status', name: 'status', orderable: false},
        {data: 'created_at', name: 'created_at'},
        {data: 'action', name: 'action'}
    ],
    language: datatablelanguage,
    drawCallback: function () {
        onSwitchDatatable(".js-switch")
        onBulkAction(".js-checkbox-all", ".checkbox-single")
        onDeleteDatatable(".js-delete-datatable",userMainTable);
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        $(".dataTables_length").addClass("d-flex");

    }


})


/* Instal select2
  */
$(".custom-select").select2({
    minimumResultsForSearch: Infinity,

}).next()[0].classList.add('datatable-10', "mr-3")
$(".datatable-10").detach().appendTo("#user-main-datatable_length")

/* Main Function
  */
onCheckbox(".js-checkbox-all", ".checkbox-single")  // check and uncheck checkbox

filterButton('#activeFilter', 6, userMainTable, "#user-main-datatable_length", "datatable-25")












