import Uppy from '@uppy/core'
import Dashboard from '@uppy/dashboard'
import XHRUpload from '@uppy//xhr-upload'
import {onPagination, toastAlert, axiosUpdateImage,mediaEventHandler} from "../main";  //min to svisw travaei ta function


const uppy = Uppy({
    autoProceed: false,
    restrictions: {
        maxFileSize: 1000000,
        maxNumberOfFiles: 10,
        allowedFileTypes: ['image/*', 'video/*']
    }
})
    .use(Dashboard, {
        trigger: '.UppyModalOpenerBtn',
        showProgressDetails: true,
        width: '750px',
        height: '450px',
        inline: true,
        target: '#select-files',
        theme: 'dark',

    })
    .use(XHRUpload, {
        headers: {

            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: "POST",
        formData: true,
        fieldName: "media-file",
        endpoint: '/upload',
        getResponseData () {
            return {} // just empty
        }


    })
uppy.on('file-added', (file) => {
    uppy.setFileMeta(file.id, {
        model: "user"
    })
})
uppy.on('complete', async result => {

    const {data}  = await axios.get(window.location.href)

    $(".js-image-cnt").html($(data).find('.js-image-cnt > *'))
    mediaEventHandler()

})


$("#submit-user-create").on("click", () => {
    $("#form-user-create").submit()

})

$(".js-strong-password").on("input", function (e) {

    const validateChild = this.parentElement.parentElement.children[1].children;

    const iChars = "~`!#$%^&*+=-[]\\\';,/{}|\":<>?";
    const number = "123456789"
    let hasSpecialChar = false
    let hasNumber = false

    for (let i = 0; i < validateChild.length; i++) {
        e.target.value.length >= 3 ? validateChild[0].classList.remove("hidden") : validateChild[0].classList.add("hidden")
        e.target.value.length >= 6 ? validateChild[1].classList.remove("hidden") : validateChild[1].classList.add("hidden");
        e.target.value.length >= 6 && hasSpecialChar ? validateChild[2].classList.remove("hidden") : validateChild[2].classList.add("hidden")
        e.target.value.length >= 7 && hasSpecialChar && hasNumber ? validateChild[3].classList.remove("hidden") : validateChild[3].classList.add("hidden")
        e.target.value.length >= 7 && hasSpecialChar && hasNumber ? $(".js-message-strong-password")[0].innerHTML = "Strong password" : $(".js-message-strong-password")[0].innerHTML = ""

        for (let i = 0; i < e.target.value.length; i++) {
            if (iChars.indexOf(e.target.value.charAt(i)) !== -1) {
                hasSpecialChar = true;
            }
            if (number.indexOf(e.target.value.charAt(i)) !== -1) {
                hasNumber = true;
            }
        }

    }


})

mediaEventHandler();



