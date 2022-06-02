$(document).ready(function () {

    //add service btn
    $('.add-service-btn').on('click', function (e) {

        e.preventDefault();
        var name = $(this).data('name');
        var id = $(this).data('id');

        $(this).addClass('disabled');

        var html =
            `<tr>
                <td class="text-center">${name}</td>
                <td class="text-center" ><input type="number" name="services[${id}][price]" class="form-control input-sm service-price"></td>
                <td class="text-center s-price"></td>
                <td class="text-center"><button class="btn btn-danger btn-sm remove-service-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
            </tr>`;

        $('.service-order-list').append(html);

        //to calculate total price
        calculateFinalPrice();
    });

    //add product btn
    $('.add-product-btn').on('click', function (e) {

        e.preventDefault();
        var name = $(this).data('name');
        var id = $(this).data('id');
        var price = $.number($(this).data('price'));

        $(this).addClass('disabled');

        var html =
            `<tr>
                <td class="align-middle">${name}</td>
                <td class="align-middle"><input type="number" name="products[${id}][quantity]" data-price="${price}" class="form-control input-sm product-quantity" min="1" value="1"></td>
                <td class="product-price align-middle">${price}</td>               
                <td class="align-middle"><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
            </tr>`;

        $('.order-list').append(html);

        //to calculate total price
        calculateFinalPrice();
    });

    //disabled btn
    $('body').on('click', '.disabled', function (e) {

        e.preventDefault();

    }); //end of disabled

    //remove product btn
    $('body').on('click', '.remove-service-btn', function (e) {

        e.preventDefault();
        var id = $(this).data('id');

        $(this).closest('tr').remove();
        $('#maintenance_service-' + id).removeClass('disabled').addClass('btn-success');

        //to calculate total price
        calculateFinalPrice();

    }); //end of remove product btn

    //change product quantity
    $('body').on('keyup change', '.service-price', function () {

        var price = parseFloat($(this).val()); //2
        //console.log(price);
        $(this).closest('tr').find('.s-price').html($.number(price, 2));
        //$(this).html($.number(price));
        calculateFinalPrice();

    }); //end of product quantity change

    //remove product btn
    $('body').on('click', '.remove-product-btn', function (e) {

        e.preventDefault();
        var id = $(this).data('id');

        $(this).closest('tr').remove();
        $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');

        //to calculate total price
        calculateFinalPrice();

    }); //end of remove product btn

    //change product quantity
    $('body').on('keyup change', '.product-quantity', function () {

        var quantity = Number($(this).val()); //2
        var unitPrice = parseFloat($(this).data('price')); //150
        //console.log(unitPrice);
        $(this).closest('tr').find('.product-price').html($.number(quantity * unitPrice));
        calculateFinalPrice();

    }); //end of product quantity change

    //list all order products
    $('.order-products').on('click', function (e) {

        e.preventDefault();

        $('#loading').css('display', 'flex');

        var url = $(this).data('url');
        var method = $(this).data('method');
        $.ajax({
            url: url,
            method: method,
            success: function (data) {

                $('#loading').css('display', 'none');
                $('#order-product-list').empty();
                $('#order-product-list').append(data);

            }
        })

    }); //end of order products click

    //list all order products
    $('.order-services').on('click', function (e) {

        e.preventDefault();

        $('#loading').css('display', 'flex');

        var url = $(this).data('url');
        var method = $(this).data('method');
        $.ajax({
            url: url,
            method: method,
            success: function (data) {

                $('#loading').css('display', 'none');
                $('#order-service-list').empty();
                $('#order-service-list').append(data);

            }
        })

    }); //end of order products click

    $('body').on('keyup change click submit', '.paid', function () {

        var price = document.getElementById("final_price").value;
        var paid = document.getElementById("paid").value;
        var due = price - paid;

        document.getElementById("due").value = due;

    }); //end of paid


}); //end of document ready

//calculate the total
function calculateFinalPrice() {

    var service_price = 0;
    var product_price = 0;

    $('.service-order-list .s-price').each(function (index) {

        service_price += parseFloat($(this).html().replace(/,/g, ''));

    }); //end of service price

    $('.order-list .product-price').each(function (index) {

        product_price += parseFloat($(this).html().replace(/,/g, ''));

    }); //end of product price

    var total = service_price + product_price;
    document.getElementById("final_price").value = total;

    $('body').on('keyup change', '#discount', function () {

    var discount = document.getElementById("discount").value;

    if (discount && $.isNumeric(discount) && discount !== 0) {
        newTotal = total - ((parseInt(discount) / 100) * total);
        document.getElementById("final_price").value = newTotal;
    } else {
        document.getElementById("final_price").value = total;
    }
});

    //check if price > 0
    if (total > 0) {

        $('#add-service-order-form-btn').removeClass('disabled')

    } else {

        $('#add-service-order-form-btn').addClass('disabled')

    } //end of else

} //end of calculate total