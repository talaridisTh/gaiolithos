Element.prototype.findParent = function (loops) {
    let parent = this;

    for (let i = 0; i < loops; i++) {
        parent = parent.parentElement;
    }

    return parent;
}, false;


Element.prototype.findChild = function (loops) {
    let child = this;

    for (let i = 0; i < loops; i++) {
        child = child.firstElementChild;
    }

    return child;
}, false;


export function toastAlert(icon, message) {
    return Swal.fire({
        toast: 'true',
        position: 'top-end',
        icon: icon,
        title: message,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: '#313a55',
        color: "white"
    });
}

export function toastAlertDelete(text, icon = "warning") {
    return Swal.fire({
        title: 'Είστε σίγουρος;',
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#ff5b5b',
        confirmButtonText: 'Ναί, διαγραφή!',
        cancelButtonText: 'Άκυρο'
    });
}

/* alazei tin katastasi
   */
export const onSwitchDatatable = (element) => {
    let switches = $(element)
    switches.off
    switches.on("change", async function () {
        const model = this.dataset.switch.split("_")
        axiosSwitch(model[0], model[1])
    })

    const axiosSwitch = async (model, id) => {
        try {
            const {data} = await axios.post("/change-switch", {
                model, id
            })
            if (data) {
                toastAlert("success", "Ενεργοποιηθηκε!")

            } else {
                toastAlert("info", "Απενεργοποιηθηκε!")
            }
        } catch (e) {
            toastAlert("error", "Ώχ! Κάτι πήγε στραβά!")
        }


    }


}

/* svini ena model
   */
export const onDeleteDatatable = (element, tableName) => {
    document.querySelectorAll(element).forEach(element => {
        element.addEventListener("click", function () {

            const model = this.dataset.delete.split("_")
            axiosDelete(model[0], model[1])
        })
    })

    const axiosDelete = async (model, id) => {
        try {
            const {status} = await axios.delete(`/delete/${id}`, {
                params: {
                    model
                }
            })
            if (status == 200) {
                let {isConfirmed} = await toastAlertDelete()
                if (isConfirmed) {
                    toastAlert("success", "Διαγράφηκε!")
                    tableName.ajax.reload();
                }

            }
        } catch (e) {
            console.log(e)
            toastAlert("error", "Ώχ! Κάτι πήγε στραβά!")
        }


    }

}

/* Top checkbox
   */
export const onCheckbox = (parent, child) => {
    let checkbox = $(parent)
    const btnBulkSetting = document.getElementsByClassName('js-bulkaction-setting')[0]
    checkbox.off

    $(checkbox).on("change", function () {
        const checkboxes = document.querySelectorAll(child);
        if (this.checked) {
            checkboxes.forEach(checkbox => {
                checkbox.checked = true
            })
            btnBulkShow(btnBulkSetting, $(".checkbox-single:checked").length);
        } else {
            checkboxes.forEach(checkbox => {
                checkbox.checked = false
            })
            btnBulkHide(btnBulkSetting);
        }

    })
}

/* tsekari an iparxoun checked
   */
export const onBulkAction = (parent, child) => {
    let checkbox = $(parent)
    $(child).off
    $(child).on("change", function () {
        const btnBulkSetting = document.getElementsByClassName('js-bulkaction-setting')
        const checkboxLength = $(".checkbox-single:checked").length
        checkboxLength > 0 ? btnBulkShow(btnBulkSetting[0], checkboxLength, $(child), checkbox) : btnBulkHide(btnBulkSetting[0])
    })
}

/* emfanizei to bulkaction
   */
function btnBulkShow(btn, checkboxLength, checkboxes, checkboxAll) {
    if (checkboxes) {
        let count = []
        for (const checkbox of checkboxes) {
            count.push(checkbox.checked)
        }
        count.every(Boolean) ? checkboxAll[0].checked = true : checkboxAll[0].checked = false
    }
    btn.hidden = false
    btn.innerHTML = `${btn.dataset.name} (${checkboxLength})`
}

/*  krivi to bulkaction
   */
function btnBulkHide(btn) {
    btn.hidden = true
}

/*  filtra datatable
   */
export const filterButton = function (attr, column, table, tableId, widthClass) {

    $(attr).detach().appendTo(tableId)

    $(attr).select2({
        minimumResultsForSearch: Infinity,
    }).next()[0].classList.add(widthClass)

    $(attr).on('change', function () {
        table.columns(column).search(this.value).draw();

    });
}
