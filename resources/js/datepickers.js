$(document).ready(function() {
    $("#start_date").datepicker({
        showOn: "both",
        buttonText: "<i class='fa fa-calendar'></i>"
    });

    $("#end_date").datepicker({
        showOn: "both",
        buttonText: "<i class='fa fa-calendar'></i>"
    });

    $("input[name='start_date']").datepicker({
        dateFormat: "yy-mm-dd",
        maxDate: new Date(),
        onClose: function(selectedDate) {
            $("input[name='end_date']").datepicker("option", "minDate", selectedDate);
        }
    });

    $("input[name='end_date']").datepicker({
        dateFormat: "yy-mm-dd",
        maxDate: new Date(),
        onClose: function(selectedDate) {
            $("input[name='start_date']").datepicker("option", "maxDate", selectedDate);
        }
    });
});
