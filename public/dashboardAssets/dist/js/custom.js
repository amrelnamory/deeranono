$(document).ready(function () {

    /* $('form').find("input[type='text'],textarea").val(""); */

    //add product btn
    $('.add-product-btn').on('click', function (e) {

        e.preventDefault();
        var name = $(this).data('name');
        var code = $(this).data('code');
        var id = $(this).data('id');
        var price = $.number($(this).data('price'));
        var quantity = $(this).data('quantity');

        $(this).addClass('disabled');
        $(this).attr("disabled", "disabled");
        var html =
            `<tr>
            <td>${name}
            <input type="hidden" name="products[${id}][selling_price]" value="${price}"></td>
            <td><input type="number" name="products[${id}][quantity]" data-price="${price}" class="form-control input-sm product-quantity" min="1" max="${quantity}" title="الكمية لا يجب أن تتعدى ${quantity}" value="1"></td>
            <td class="product-price">${price}
            </td>               
            <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
        </tr>`;

        $('.order-list').append(html);

        //to calculate total price
        calculateTotal();
    });

    //disabled btn
    $('body').on('click', '.disabled', function (e) {

        e.preventDefault();

    }); //end of disabled

    /* //remove product btn
    $('body').on('click', '.remove-product-btn', function (e) {

        e.preventDefault();
        var id = $(this).data('id');

        currentProducts.pop(id);

        $(this).closest('tr').remove();
        $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');

        //to calculate total price
        calculateTotal();

    }); //end of remove product btn */

    //remove product btn
    $('body').on('click', '.remove-product-btn', function (e) {

        e.preventDefault();
        var id = $(this).data('id');

        $(this).closest('tr').remove();
        $('#product-' + id).removeClass('disabled').addClass('btn-success');
        $('#product-' + id).removeAttr('disabled');
        //to calculate total price
        calculateTotal();

    }); //end of remove product btn

    //change product quantity
    $('body').on('keyup change click', '.product-quantity', function () {

        var quantity = Number($(this).val()); //2
        var unitPrice = parseFloat($(this).data('price')); //150
        //console.log(unitPrice);
        $(this).closest('tr').find('.product-price').html($.number(quantity * unitPrice));
        calculateTotal();

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


    // Image Preview
    $(".image").change(function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.image-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }

    });

    $('body').on('keyup change', '#paid', function () {

        var price = document.getElementById("final_price").value;
        var paid = document.getElementById("paid").value;

        document.getElementById("due").value = $.number(price - paid, 2);


    }); //end of paid

    $('body').on('keyup change', '#discount', function () {

        var discount = document.getElementById("discount").value;
        var price = document.getElementById("total_price").value;
        price = price - (price * discount / 100);
        document.getElementById("final_price").value = price;


    }); //end of paid


}); //end of document ready

//calculate the total
function calculateTotal() {

    var price = 0;


    $('.order-list .product-price').each(function (index) {

        price += parseFloat($(this).html().replace(/,/g, ''));

    }); //end of product price

    //check if price > 0
    if (price > 0) {

        $('#add-order-form-btn').removeClass('disabled')

    } else {

        $('#add-order-form-btn').addClass('disabled')

    } //end of else

} //end of calculate total


function markNotificationAsRead(id) {

    $.get('/markAsRead/' + id);

}

function markNotificationAsUnRead(id) {

    $.get('/markAsUnRead/' + id);

}
