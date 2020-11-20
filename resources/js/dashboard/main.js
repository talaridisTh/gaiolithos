const ORIGIN = window.location.origin;
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

        let {isConfirmed} = await toastAlertDelete()
        if (isConfirmed) {
            try {
                const {status} = await axios.delete(`/delete/${id}`, {
                    params: {
                        model
                    }
                })
                if (status == 200) {
                    toastAlert("success", "Διαγράφηκε!")
                    tableName.ajax.reload();
                }

            } catch (e) {
                console.log(e)
                toastAlert("error", "Ώχ! Κάτι πήγε στραβά!")
            }

        } else {
            toastAlert("info", "Ακυρόθηκε!")
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
                checkbox.findParent(3).style.backgroundColor = "#232a3b"
            })
            btnBulkShow(btnBulkSetting, $(".checkbox-single:checked").length);
        } else {
            checkboxes.forEach(checkbox => {
                checkbox.checked = false
                checkbox.findParent(3).style.backgroundColor = ""
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
        checkboxLength > 0 ? btnBulkShow(btnBulkSetting[0], checkboxLength, $(child), checkbox) : btnBulkHide(btnBulkSetting[0], $(child))
    })
}

/* emfanizei to bulkaction
   */
function btnBulkShow(btn, checkboxLength, checkboxes, checkboxAll) {
    if (checkboxes) {
        let count = []
        for (const checkbox of checkboxes) {
            count.push(checkbox.checked)

            if (checkbox.checked) {
                checkbox.findParent(3).style.backgroundColor = "#232a3b"
            } else {
                checkbox.findParent(3).style.backgroundColor = ""
            }
        }
        count.every(Boolean) ? checkboxAll[0].checked = true : checkboxAll[0].checked = false
    }
    btn.hidden = false
    btn.innerHTML = `${btn.dataset.name} (${checkboxLength})`
}

/*  krivi to bulkaction
   */
function btnBulkHide(btn, checkboxes) {
    if (checkboxes) {
        for (let i = 0; i < checkboxes.length; i++) {
            if (!checkboxes[i].checked) {
                checkboxes[i].findParent(3).style.backgroundColor = ""
            }

        }
    }
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

/*  Ajax paginate
   */
export const onPagination = (e) => {
    e.preventDefault();
    const href = `${origin}/create?page=${e.target.href.split("=")[1]}`
    const imageCnt = $(".js-image-cnt");
    axiosUpdateCnt(href, imageCnt)
}
const axiosUpdateCnt = async (href, imageCnt) => {
    try {
        const {status, data} = await axios.get(href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        if (status == 200) {
            imageCnt.html($(data).find('.js-image-cnt > *'))
            mediaEventHandler()
        }
    } catch (e) {

        console.log(e)
    }
}

/*  AJAX allazei tin fwtografia
   */
export const axiosUpdateImage = async (that, modelEl) => {
    console.log(that)
    try {
        const {status, data} = await axios.post("/upload/model", {
            imageId: that.findParent(1).findChild(1).dataset.coverId
        })

        if (status == 200) {
            modelEl[0].src = `${ORIGIN}/storage/${data}`
            toastAlert("success", "Η φωτογραφία ενημερώθηκε! ")
        }
    } catch (e) {
        console.log(e)
    }
}

/*  Search HasMedia library
   */
$("#search-media").on("keyup", _.debounce(function (e) {
    e.preventDefault();

    axiosSearchMedia(e.target)
}, 800))
const axiosSearchMedia = async ({value}) => {
    if (value.length < 3 && value.length < 0) {
        return
    }
    try {
        const {data, status} = await axios.post("/search/media", {
            searchTerm: value
        })

        if (status == 200) {

            $(".js-image-cnt")[0].innerHTML = data;
            mediaEventHandler()


        }
    } catch (e) {
        console.log(e)
    }
}

/*  Event listener gia media
   */
export const mediaEventHandler = () => {
    $('.pagination a').on("click", (e) => onPagination(e)) // addEventListener sto paggination
    $(".js-attach-media").on("click", function () {  // addEventListener sto st fwtografia
        axiosUpdateImage(this, $("#model-cover"))
    })
}




