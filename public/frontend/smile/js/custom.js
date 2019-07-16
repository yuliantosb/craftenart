function onView(id)
{
    // $(document).ajaxComplete(function(){
    //     $(".selectBoxIt").selectBoxIt();
    // });

    var data = getProduct(id);
    var price = data.data.sale ? `<span>${data.data.price_formatted}</span> ${data.data.sale_formatted}` : `${data.data.price_formatted}`;
    var galleries_small = '';
    var galleries_big = '';
    var ratings = '';

    $.each(data.data.galleries, function(i, v){
        galleries_small += `<div class="item"> <img src="${SITE_URL}/uploads/thumbs/${v.picture}" alt=""> </div>`;
    });

    $.each(data.data.galleries, function(i, v){
        galleries_big += `<div class="item"> <img src="${SITE_URL}/uploads/thumbs/${v.picture}" alt=""> </div>`;
    });

    for(var i = 1; i <= Math.round(data.ratings); i++ ) {
        ratings += `<span class="act fa fa-star"></span>&nbsp;`;
    }

    if (5 - Math.round(data.ratings) > 0) {
        for (var i = 1; i <= 5 - Math.round(data.ratings); i++) {
            ratings += `<span class="fa fa-star"></span>&nbsp;`;
        }
    }

    $('#galleries_small').html(galleries_small);
    $('#galleries_big').html(galleries_big);
    $('#discount').text(data.discount != null ? data.discount : '');
    $('#product_name').text(data.data.name);
    $('#rating').html(ratings);
    $('#review_count').text(`(${data.data.reviews.length} Reviews)`);
    $('#price').html(price);
    $('#stock_count').text(data.data.stock.amount > 0 ? 'Stock Available' : 'Out of stock');
    $('.btn-go-to-details').attr('href', `${SITE_URL}/${data.data.slug}`);
    $('#desc').html(data.data.description_cut);
    $('#popup-product-id').val(data.data.id);
    $('#popup-wishlist-product-id').val(data.data.id);
    $('#wishlist').html(data.wishlist);
    $('#attributes-popup').html(data.attributes);
    $('#myModal').modal('show');

    var sync1 = $("#galleries_big");

    var sync2 = $("#galleries_small");


   if($("#galleries_big").length > 0){     
    sync1.owlCarousel({

        singleItem: true,

        slideSpeed: 1000,

        navigation: true,

        pagination: false,

        afterAction: syncPosition,

        responsiveRefreshRate: 200,

        navigationText: [

            "<i class='fa fa-chevron-left'></i>",

            "<i class='fa fa-chevron-right'></i>"

        ]

    });

}
if($("#galleries_small").length > 0){

    sync2.owlCarousel({

        items: 4,

        itemsDesktop: [1199, 4],

        itemsDesktopSmall: [979, 3],

        itemsTablet: [768, 3],

        itemsMobile: [479, 2],

        pagination: false,

        responsiveRefreshRate: 100,

        afterInit: function (el) {

            el.find(".owl-item").eq(0).addClass("synced");

        }

    });

    $(".selectBoxIt").selectBoxIt();


}

    function syncPosition(el) {

        var current = this.currentItem;

        $("#galleries_small")

                .find(".owl-item")

                .removeClass("synced")

                .eq(current)

                .addClass("synced")

        if ($("#galleries_small").data("owlCarousel") !== undefined) {

            center(current)

        }

    }



    $("#galleries_small").on("click", ".owl-item", function (e) {

        e.preventDefault();

        var number = $(this).data("owlItem");

        sync1.trigger("owl.goTo", number);

    });



    function center(number) {

        var sync2visible = sync2.data("owlCarousel").owl.visibleItems;

        var num = number;

        var found = false;

        for (var i in sync2visible) {

            if (num === sync2visible[i]) {

                var found = true;

            }

        }



        if (found === false) {

            if (num > sync2visible[sync2visible.length - 1]) {

                sync2.trigger("owl.goTo", num - sync2visible.length + 2)

            } else {

                if (num - 1 === -1) {

                    num = 0;

                }

                sync2.trigger("owl.goTo", num);

            }

        } else if (num === sync2visible[sync2visible.length - 1]) {

            sync2.trigger("owl.goTo", sync2visible[1])

        } else if (num === sync2visible[0]) {

            sync2.trigger("owl.goTo", num - 1)

        }



    }

}

function getProduct(id)
{
    var res = $.ajax({
        url: `${SITE_URL}/product/${id}`,
        type: 'get',
        dataType: 'json',
        async: false
    });

    

    return res.responseJSON;
}


$('#myModal').on('hidden.bs.modal', function () {
    $("#galleries_big").data('owlCarousel').destroy();
    $("#galleries_small").data('owlCarousel').destroy();
});

$('.select2').select2();
$(".selectBoxIt").selectBoxIt();


$.extend(jQuery.validator.messages, {
    required: 'This field is required.',
    email: 'Please input correct email address.',
    url: 'Worng URL format.',
    date: 'Wrong date format.',
    number: 'Input number only.',
    maxlength: jQuery.validator.format('Can not more than {0} character.'),
    minlength: jQuery.validator.format('Can not less than {0} character.'),
    max: jQuery.validator.format('Value cannot more than {0}.'),
    min: jQuery.validator.format('Value cannot less than {0}.'),
    minNumeric: jQuery.validator.format('Value cannot less than {0}.'),
});

$.validator.setDefaults({
    errorElement: 'em',
    errorPlacement: function (error, element) {
        element.closest('.form-group').find('.help-block').html(error.text());        
    },
    highlight: function (element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).parent('.form-group').removeClass('has-error');
        $(element).closest('.form-group').removeClass('has-error');
        $(element).closest('.form-group').find('.help-block').html('');
    },
    success: function (element) {
        $(element).closest('.form-group').removeClass('has-error');
        $(element).closest('.form-group').find('.help-block').html('');
    },
    // onkeyup: function(element){$(element).valid()},
    onChange: function(element){$(element).valid()},
});

$('.collapse-duh').click(function(e){
    e.preventDefault();
    console.log($(this).data('target'));
});