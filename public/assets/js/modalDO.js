$(document).ready(function () {
    $('#deliveryOrderForm').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/orders/delivery-order/create',
            data: $('#deliveryOrderForm').serialize(),
            success: function (data) {
                // Handle success, e.g., show a success message
                console.log(data.message);
            },
            error: function (error) {
                // Handle errors, e.g., display validation errors
                console.log(error.responseJSON.errors);
            }
        });
    });
});
