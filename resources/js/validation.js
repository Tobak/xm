
$(document).ready(function() {
    $('form').on('submit', function(e) {
        let isValid = true;

        // Check for Company Symbol
        if (!$('[name="company_symbol"]').val().trim()) {
            alert('Company Symbol is required!');
            $('[name="company_symbol"]').focus();
            isValid = false;
            e.preventDefault();
        }

        // Check for Start Date
        else if (!$('[name="start_date"]').val().trim()) {
            alert('Start Date is required!');
            $('[name="start_date"]').focus();
            isValid = false;
            e.preventDefault();
        }

        // Check for End Date
        else if (!$('[name="end_date"]').val().trim()) {
            alert('End Date is required!');
            $('[name="end_date"]').focus();
            isValid = false;
            e.preventDefault();
        }

        // Check for Email
        else if (!$('[name="email"]').val().trim()) {
            alert('Email is required!');
            $('[name="email"]').focus();
            isValid = false;
            e.preventDefault();
        }

        return isValid;
    });
});

