$("nav.sidenav").find('a.nav-link').on('click', function (e) {
  $(this).addClass('active')
  const elem = this
  $("nav.sidenav").find('a.nav-link').each(function (el) {
    if (this != elem) {
      $(this).removeClass('active')
    }
  })
})

const toActiveUrl = window.location.hash.substring(2)

$("nav.sidenav").find(`a[href^="${toActiveUrl}"]`).addClass("active")