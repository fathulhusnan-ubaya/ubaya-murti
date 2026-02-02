const NegativeConfirm = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-danger btn-lg',
        cancelButton: 'btn btn-info btn-lg mr-2',
    },
    buttonsStyling: false,
    reverseButtons: true,
    showCancelButton: true,
    icon: 'warning',
    confirmButtonText: "<i class='fa-solid fa-check mr-2'></i>Ya",
    cancelButtonText: "<i class='fa-solid fa-close mr-2'></i>Tidak"
})

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    showCloseButton: true,
    width: 550,
    timer: 5000,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

function loading() {
    Swal.fire({
        title: "<i class='text-white fa-solid fa-circle-notch fa-spin'></i>",
        background: 'rgba(255, 255, 255, 0)',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
    });
}

function datatablesInit({ selector, url, columns, orders = [1, 'asc'], data = {}, dom = '', withAction = true }) {
    var column = [{ data: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center" }]

    columns.forEach(row => {
        column.push(row)
    });

    if (withAction) {
        column.push({ data: 'Aksi', orderable: false, searchable: false, className: "text-center" })
    }

    if (dom == '') {
        dom = '<"d-flex justify-content-between align-items-center"lf><"table-responsive w-100"<"table-render"r>t><"d-flex flex-column flex-lg-row justify-content-between align-items-center mt-2"ip>'
    }

    return $(selector).DataTable({
        dom: dom,
        processing: true,
        serverSide: true,
        ajax: {
            'url': url,
            'data': data
        },
        order: [
            orders
        ],
        columns: column,
        language: {
            url: '/js/datatables_id.json'
        },
    })
}

function select2Init({ selector, url, allowClear = false, dropdownParent = null, minLength = 0, data = {}, placeholder = '-- Pilih --' }) {
    let settings = {
        placeholder: placeholder,
        minimumInputLength: minLength,
        allowClear: allowClear,
        ajax: {
            url: url,
            type: 'GET',
            dataType: 'json',
            delay: 250,
            cache: true,
            data: function (params) {
                return {
                    search: params.term,
                    ...data,
                }
            },
            processResults: function (data) {
                return {
                    results: data
                }
            },
        }
    };

    if (dropdownParent != null) {
        settings = {
            ...settings,
            dropdownParent: null
        }
    }

    $(selector).select2(settings)
}

function ajaxGetRequest({ url, modal = "", successCallback = null, errorCallback = null, withToast = false }) {
    $.ajax({
        type: "GET",
        url: url,
        success: function (result) {
            $(modal).modal('hide')
            if (typeof successCallback == 'function') successCallback(result)
            let icon = 'success';
            if (withToast) {
                Toast.fire({
                    icon: icon,
                    title: result.message
                })
            }
        },
        error: function (request, status, error) {
            if (withToast) {
                Toast.fire({
                    icon: 'error',
                    title: "Terjadi masalah pada server!",
                    text: "Harap hubungi Direktorat SIM untuk informasi lebih lanjut!"
                })
            }
            if (typeof errorCallback == 'function') errorCallback(request)
        }
    })
}

function ajaxPostRequest({ url, data, modal = "", successCallback = null, errorCallback = null, withToast = true }) {
    const formData = new FormData()
    formData.append('_method', 'POST')
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
    Object.keys(data).forEach(key => {
        formData.append(key, data[key])
    })

    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        success: function (result) {
            $(modal).modal('hide')
            if (typeof successCallback == 'function') successCallback(result)
            let icon = 'success';
            if (withToast) {
                Toast.fire({
                    icon: icon,
                    title: result.message
                })
            }
        },
        error: function (request, status, error) {
            if (withToast) {
                Toast.fire({
                    icon: 'error',
                    title: "Terjadi masalah pada server!",
                    text: "Harap hubungi Direktorat SIM untuk informasi lebih lanjut!"
                })
            }
            if (typeof errorCallback == 'function') errorCallback(request)
        }
    })
}
