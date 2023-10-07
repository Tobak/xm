$(document).ready(function() {
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
