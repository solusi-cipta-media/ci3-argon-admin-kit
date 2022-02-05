(function ($) {
  $.fn.setLoading = function (marginTop = null) {
    var style = ""
    if (marginTop != null) style = "margin-top: " + marginTop
    $(this).html(`  <div class="loading" style="${style}">
  <div class="loading-content">
    <div class="item-1"></div>
    <div class="item-2"></div>
    <div class="item-3"></div>
  </div>
</div>`)
  };
  $.fn.unsetLoading = function () {
    $(this).html("")
  }

  $.fn.setToastInner = function ({ title = "", caption = "", body = "" }) {
    $(this).find(".toast-title").html(title)
    $(this).find(".toast-caption").html(caption)
    $(this).find(".toast-body").html(body)
  }
})(jQuery);


var _ash = {
  error_req_handler(xhr, base_url) {
    if (xhr.status == 401) {
      Swal.fire({
        title: 'Sorry!',
        text: "Sesi anda telah habis!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya!',
        cancelButtonText: 'Batal'
      }).then(function (result) {
        if (result.isConfirmed) {
          location.href = base_url
        }
      })
    }

    else if (xhr.status == 404) {
      Swal.fire({
        title: '404',
        text: "halaman tidak ditemukan! Mau balik?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya!',
        cancelButtonText: 'Batal'
      }).then(function (result) {
        if (result.isConfirmed) {
          window.history.back()
        }
      })
    }

    else {
      Swal.fire({
        title: "Oops!",
        text: xhr.responseText,
        icon: "warning",
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ya!',
      })
    }
  },
  swalSuccess(text = "data berhasil disimpan!", dur = 2500, cb = function (result) { }) {
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: text,
      timer: dur
    }).then(function (result) {
      cb(result)
    })
  },
  swalDanger(text = "", dur = 2500) {
    Swal.fire({
      position: 'center',
      icon: 'warning',
      title: text,
      timer: dur
    })
  },
  setFormVal(data = {}) {
    for (const key in data) {
      if (Object.hasOwnProperty.call(data, key)) {
        const element = data[key];
        $(key).val(element)
      }
    }
  },
  emailValidation(email) {
    return String(email)
      .toLowerCase()
      .match(
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
      ) != null;
  },
  emptyValidaton(el = []) {
    var status = true
    el.forEach(function (e) {
      var _ = $(e)
      if (_.val() == "") {
        _.addClass("is-invalid").parent().addClass("has-danger")
        status = false
      } else {
        _.removeClass("is-invalid").parent().removeClass("has-danger")
      }
    })
    return status
  },
  emptyValidatonInputGroup(el = []) {
    var status = true
    el.forEach(function (e) {
      var _ = $(e)
      if (_.val() == "") {
        _.addClass("is-invalid").parent().parent().addClass("has-danger")
        status = false
      } else {
        _.removeClass("is-invalid").parent().parent().removeClass("has-danger")
      }
    })
    return status
  },
  emptyValidation(el = []) {
    var status = true
    el.forEach(function (e) {
      var _ = $(e)
      if (_.val() == "") {
        _.addClass("is-invalid").parent().addClass("has-danger")
        status = false
      } else {
        _.removeClass("is-invalid").parent().removeClass("has-danger")
      }
    })
    return status
  },
  emptyValidationInputGroup(el = []) {
    var status = true
    el.forEach(function (e) {
      var _ = $(e)
      if (_.val() == "") {
        _.addClass("is-invalid").parent().parent().addClass("has-danger")
        status = false
      } else {
        _.removeClass("is-invalid").parent().parent().removeClass("has-danger")
      }
    })
    return status
  }
}

