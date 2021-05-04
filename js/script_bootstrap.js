var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})

document.querySelectorAll('.popover-dismiss').forEach((item)=> {
  new bootstrap.Popover(item, {
    trigger: 'focus',
    html: true
  })
});