$(document).ready(function() {
    $('.table').DataTable({
        responsive: true,
        searching: true,
        ordering: true
    });
});

$('#userMenu').on('show.bs.collapse', function () {
    $(this).prev().find('.toggle-icon').removeClass('fa-chevron-down').addClass('fa-chevron-up');
    console.log("sad")
}); 
$('#userMenu').on('hide.bs.collapse', function () {
    $(this).prev().find('.toggle-icon').removeClass('fa-chevron-up').addClass('fa-chevron-down');
});

document.addEventListener('DOMContentLoaded', function () {
    var collapseElements = document.querySelectorAll('.collapse');
    collapseElements.forEach(function (element) {
        var bsCollapse = new bootstrap.Collapse(element, {
            toggle: false // Optional: start with it collapsed
        });
    });
});
