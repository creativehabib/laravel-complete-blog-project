let RecordId = '';
const $ = jQuery.noConflict();
const media_type = 'Thumbnail';

$(function () {
    "use strict";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#load_attachment").on('change', function() {
        upload_form();
    });

    $("#submit-form").on("click", function (e) {
        // e.preventDefault();
        onConfirmWhenAddEdit()
    });

    $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        onPaginationDataLoad(page);
    });

});

function onListPanel() {
    $('.btn-form').show();
    $('#form-panel, .btn-list').hide();
}

function onFormPanel() {
    $('.btn-form').hide();
    $('#form-panel, .btn-list').show();
}

// Media update
function onConfirmWhenAddEdit() {
    $.ajax({
        type : 'POST',
        url: window.location.origin + '/admin/mediaUpdate',
        data: $('#DataEntry_formId').serialize(),
        success: function (response) {
            const msgType = response.msgType;
            const msg = response.msg;

            if (msgType === "success") {
                $('#media_modal_view').modal('hide');
                // onSuccessMsg(msg);
            } else {
                // onErrorMsg(msg);
            }
        }
    });
}

function upload_form() {
    $("#upload-loader").show();

    const data = new FormData();
    data.append('FileName', $('#load_attachment')[0].files[0]);
    data.append('media_type', media_type);
    const ReaderObj = new FileReader();
    const image_name = $('#load_attachment').val();
    const size = $('#load_attachment')[0].files[0].size;

    const ext = image_name.substr((image_name.lastIndexOf('.') + 1));

    if(ext==='jpg' || ext==='JPG' || ext==='jpeg' || ext==='JPEG' || ext==='png' || ext==='PNG' || ext==='gif' || ext==='ico' || ext==='ICO' || ext==='svg' || ext==='SVG'){

        $.ajax({

            url: window.location.origin + '/admin/media',
            type: "POST",
            dataType : "json",
            data:  data,
            contentType: false,
            processData:false,
            enctype: 'multipart/form-data',
            mimeType:"multipart/form-data",
            success: function(response){

                const dataList = response;
                const msgType = dataList.msgType;
                const msg = dataList.msg;
                const thumbnail = dataList.thumbnail;
                const id = dataList.id;

                if (msgType === "success") {

                    $("#upload-loader").hide();
                    $('#form-panel, .btn-list').hide();
                    window.location.reload()
                    onSuccessMsg(msg);

                    // onMediaPaginationDataLoad();
                } else {
                    // onErrorMsg(msg);
                }
            },
            error: function(){
                return false;
            }
        });

    }else{
        // onErrorMsg(TEXT['Sorry only you can upload jpg, png and gif file type']);
    }
}

function onMediaDelete(id) {
    RecordId = id;
    $.ajax({
        type : 'POST',
        url: window.location.origin + '/admin/onMediaDelete',
        data: 'id='+RecordId,
        success: function (response) {
            const msgType = response.msgType;
            const msg = response.msg;

            if(msgType === "success"){
                alert(RecordId+' Deleted')
                window.location.reload()
            }else{
                // onErrorMsg(msg);
            }
        }
    });

}
function onMediaModalView(id) {

    $.ajax({
        type : 'POST',
        url: window.location.origin + '/admin/getMediaById',
        data: 'id='+id,
        success: function (response) {

            const data = response;
            $("#RecordId").val(data.id);
            $("#title").val(data.media_title);
            $("#alternative_text").val(data.media_alt);
            $("#thumbnail").val('/media/'+data.media_file);
        }
    });
}


/********* modal common js *********/
const modalTrigger = document.querySelectorAll('[data-tw-toggle="modal"]');
let isModalShow = false;
Array.from(modalTrigger).forEach(function (item) {
    item.addEventListener("click", function () {
        var target = this.getAttribute('data-tw-target').substr(1);
        var modalWindow = document.getElementById(target);

        if (modalWindow.classList.contains("hidden")) {
            modalWindow.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        } else {
            modalWindow.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
        isModalShow = false;

        if (item.getAttribute('data-tw-backdrop') === 'static') {
            isModalShow = true;
        }
    });
});

// closeButton
const closeButton = document.querySelectorAll('[data-tw-dismiss="modal"]');
Array.from(closeButton).forEach(function (subElem) {
    subElem.addEventListener("click", function () {

        var modalWindow = subElem.closest(".modal");
        if (modalWindow.classList.contains("hidden")) {
            modalWindow.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        } else {
            modalWindow.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    });
});

// closeModal
const modalElem = document.querySelectorAll('.modal');
Array.from(modalElem).forEach(function (elem) {

    // modalOverlay
    var modalOverlay = elem.querySelectorAll('.modal-overlay');
    Array.from(modalOverlay).forEach(function (subItem) {
        subItem.addEventListener("click", function () {
            if (!isModalShow) {
                if (elem.classList.contains("hidden")) {
                    elem.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                } else {
                    elem.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            }
        });
    });

    // Escape
    document.addEventListener("keydown", function (event) {
        var key = event.key;
        if (!isModalShow) {
            if (key === "Escape") {
                elem.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }
    });
});
