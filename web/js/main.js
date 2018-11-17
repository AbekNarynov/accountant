$(document).ready(function () {
    var datePicker = $('.date-picker');
    var reasonId = $('#reasonlocation-reason_id');

    datePicker.val(localStorage.getItem('date-picker'));
    reasonId.val(localStorage.getItem('reasonId'));

    datePicker.datepicker({
        format: "yyyy-mm-dd",
        todayBtn: true,
        language: "ru",
        autoclose: true,
        todayHighlight: true,
        updateViewDate: false
    });

    datePicker.change(function () {
        localStorage.setItem('date-picker', '' + $(this).val());
    })

    reasonId.change(function () {
        localStorage.setItem('reasonId', '' + $(this).val());
    })
});