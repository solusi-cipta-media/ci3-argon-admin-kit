$('body').append(`<div class="modal" id="modal-loading" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered" role="document">
        <div class="modal-content bg-gradient-danger">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Melakukan pemrosesan Data</h6>
            </div>
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="mt-4 text-white">Mohon tunggu dan jangan tinggalkan halaman ini!</h4>
                    <div class="lds-dual-ring"></div>
                </div>
            </div>
        </div>
    </div>
  </div>`)


function emptyValidation(ids = []) {
  var output = true;
  var firstInvalid = "";
  for (let i = 0; i < ids.length; i++) {
    const el = $(ids[i])
    const val = el.val()
    if (val == null || val == "") {
      output = false;
      el.parent().addClass('has-danger')
      el.addClass('is-invalid')
      if (!el.next().hasClass('invalid-feedback'))
        $('<div class="invalid-feedback">Wajib diisi!.</div>').insertAfter(el)

      if (firstInvalid == "") firstInvalid = el
    }
    else {
      el.parent().removeClass('has-danger')
      el.removeClass('is-invalid')
      el.next().remove()
    }
  }
  if (firstInvalid != "") firstInvalid.focus()
  return output
}

function emptyValidationObject(ids = {}) {
  var output = true;
  $.each(ids, function (key, el) {
    const val = el.val()
    if (val == null || val == "") output = false;

  })
  return output
}

function clearForm(ids = []) {
  ids.forEach(function (id) {
    el = $(id)
    el.val('')
    el.parent().removeClass('has-danger')
    el.removeClass('is-invalid')
    el.next().remove()
  })
}

function notificationHelper(
  type = "danger",
  from = "top",
  message = "Mohon isi semua formulir dengan benar!",
  title = "Data Tidak Valid!"
) {

  $.notify({
    icon: 'ni ni-bell-55',
    title: title,
    message: message,
    url: ""
  }, {
    element: "body",
    type: type,
    allow_dismiss: !0,
    placement: {
      from: from,
      align: "right"
    },
    offset: {
      x: 15,
      y: 15
    },
    spacing: 10,
    z_index: 1080,
    delay: 200,
    timer: 2000,
    url_target: "_blank",
    mouse_over: !1,
    animate: {
      enter: "animated fadeInDown",
      exit: "animated fadeOutUp"
    },
    template: '<div data-notify="container" class="alert alert-dismissible alert-{0} alert-notify" role="alert"><span class="alert-icon" data-notify="icon"></span> <div class="alert-text"</div> <span class="alert-title" data-notify="title">{1}</span> <span data-notify="message">{2}</span></div><button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>',
  });
}

function dangerNotification() {
  notificationHelper("danger", "top", "Mohon isi semua formulir dengan benar!", "Data Tidak Valid!")
}

function successNotification() {
  notificationHelper("success", "top", "Data berhasil disimpan!", "Selamat!")
}

function fillTheInput(ids = [{ id, val }]) {
  ids.forEach(function (data) {
    el = $(data.id)
    el.val(data.val)
    el.parent().removeClass('has-danger')
    el.removeClass('is-invalid')
    if (el.next().hasClass('invalid-feedback')) el.next().remove()
  })
}

function showLoading() {
  $("#modal-loading").modal({
    backdrop: 'static',
    keyboard: false
  })
}

function hideLoading() {
  $("#modal-loading").modal("hide")
}

function alertSaveSuccess() {
  Swal.fire({
    icon: 'success',
    title: 'Selamat!',
    text: "data berhasil disimpan!",
  })
}

function alertDeleteSuccess() {
  Swal.fire({
    icon: 'success',
    title: 'Selamat!',
    text: "data berhasil dihapus!",
  })
}

function alertSessionEnd() {
  Swal.fire({
    icon: 'success',
    title: 'Ooops!',
    text: "Session habis, silakan login kembali!",
  })
}

function alertError(error = "Sepertinya ada yang salah!") {
  Swal.fire({
    icon: 'error',
    title: 'Maaf',
    text: error,
  })
}

function mysqlToDateIndo(dateTime) {
  if (dateTime == "undefined" || dateTime == null || typeof dateTime === "undefined") return ""
  const exploded = dateTime.split(" ")
  const date = exploded[0].split("-")
  return date[2] + "/" + date[1] + "/" + date[0]
}