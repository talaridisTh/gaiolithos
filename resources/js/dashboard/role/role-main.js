import {datatablelanguage} from "../../config.json";
import {onCheckbox, onBulkAction, onDeleteDatatable} from "../main";


/* Instal Datatables
  */
const roleMainTable = $("#role-main-datatable").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: "/role-main/datatable"
    },
    columns: [
        {data: "checkbox", name: "checkbox", orderable: false},
        {data: 'name', name: 'name'},
        {data: 'created_at', name: 'created_at'},
        {data: 'action', name: 'action'}
    ],
    language: datatablelanguage,
    drawCallback: function () {
        onBulkAction(".js-checkbox-all", ".checkbox-single")
        onDeleteDatatable(".js-delete-datatable", roleMainTable);
        onDelete()
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        $(".dataTables_length").addClass("d-flex");
    }


})


/* Main Function
  */
onCheckbox(".js-checkbox-all", ".checkbox-single")  // check and uncheck checkbox


const onDelete = () => {
    $(".js-multiple-delete").off
    $(".js-multiple-delete").on("click", function () {
        const models = $(".checkbox-single").closest("tr").find(".js-delete-datatable").map((idx, el) => {
            return el.dataset.delete.split("_")

        })

        const ids = [...new Set(models)]
        const model = ids.shift()

        //sinexizw apo edw xwrizw ola ta id kai t model
    })
}


