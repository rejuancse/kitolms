jQuery(document).ready(function($){
    'use strict';

    /* --------------------------------------
    *      1. ajax login register
    *  -------------------------------------- */
    $('form#login').on('submit', function(e){
        'use strict';
        e.preventDefault();

        $('form#login p.status').show().text(ajax_object.loadingmessage);

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_object.ajaxurl,
            data: {
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#login #username2').val(),
                'password': $('form#login #password2').val(),
                'rememberme': $('form#login #rememberme').val(),
                'security': $('form#login #security2').val() },
            success: function(data){
                if (data.loggedin == true){
                    $('form#login p.status').removeClass('text-danger').addClass('text-success');
                    $('form#login p.status').text(data.message);
                    document.location.href = ajax_object.redirecturl;
                }else{
                    $('form#login p.status').removeClass('text-success').addClass('text-danger');
                    $('form#login p.status').text(data.message);
                }
                if($('form#login p.status').text() == ''){
                    $('form#login p.status').hide();
                }else{
                    $('form#login p.status').show();
                }
            }
        });
    });

    if($('form#login .login-error').text() == ''){
        $('form#login  p.status').hide();
    }else{
        $('form#login  p.status').show();
    }

    /* --------------------------------------
    *      2. Register New User
    *  -------------------------------------- */
    $('.register_button').click(function(e){
        e.preventDefault();
        var form_data = $(this).closest('form').serialize()+'&action=ajaxregister';
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_object.ajaxurl,
            data: form_data,
            success: function(data){
                //var jdata = json.parse(data);
                $('#registerform  p.status').removeClass('text-success').addClass('text-danger');
                $('#registerform  p.status').show();
                if (data.loggedin){
                    $('#registerform  p.status').removeClass('text-danger').addClass('text-success');
                    $('#registerform  p.status').text(data.message);
                    $('#registerform')[0].reset();
                }else{
                    $('#registerform  p.status').removeClass('text-success').addClass('text-danger');
                    $('#registerform  p.status').text(data.message);
                }
            }
        });
    });
    if($('form#registerform  p.status').text() == ''){
        $('form#registerform  p.status').hide();
    }else{
        $('form#registerform  p.status').show();
    }

    /* ----------------------------------------------------------
    * ------------ 3. Course Archive Page Search ---------------
    * ----------------------------------------------------------- */
    // Course Level( Select Just One )
    $('.course-level').on('click', function() {
        $('.course-level').not(this).prop('checked', false);  
    });

    $('.course-price').on('click', function() {
        $('.course-price').not(this).prop('checked', false);  
    });

    $('.course_searchword').on('click', function (e) {
        $(".kitolms-courses-wrap.course-archive, .archive-course-pagination").addClass("course-archive-remove");
        let filter_form = $('.kitolms-sidebar-filter input[type="checkbox"]:checked').length;

        if(filter_form > 0){
            $('.filter-clear-btn a').addClass('search-active');
            $('.filter-clear-btn a').removeClass('empty-search');
        }else if(filter_form == 0){
            $('.filter-clear-btn a').addClass('empty-search');
            $('.filter-clear-btn a').removeClass('search-active');
        }

        // Course Category.
        var i = 0;
        var data_category = [];
        $('.course-category:checked').each(function () {
            data_category[i++] = $(this).val();
        }); 

        // Course Level.
        var data_level = [];
        $('.course-level:checked').each(function () {
            data_level = $(this).val();
        }); 

        // Price
        var data_price = [];
        $('.course-price:checked').each(function () {
            data_price = $(this).val();
        }); 

        var $that = $(this);
        var ajaxUrl     = $that.data('url'),
            category    = $("#searchtype").val();

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                data_level: data_level,
                data_category: data_category,
                data_price: data_price
            },
            beforeSend: function () {
                if (!$('.single-filter .fa-spinner').length) {
                    $('.single-filter').addClass('spinner');
                    $('<i class="fa fa-spinner fa-spin"></i>').appendTo(".spinner-cls").fadeIn(600);
                }
            },
            complete: function () {
                $('.single-filter .fa-spinner ').remove();
                $('.single-filter').removeClass('spinner');
            }
        })

        .done(function (data) {
            if (e.type == 'blur') {
                $(".course-search-results").html('');
            } else {
                $(".course-search-results").html(data);
            }
        })

        .fail(function () {
            console.log("error");
        });
    });
    // End Search.

    $('.course-ajax-search').bind('keyup', function (e) {
        var $that = $(this);
        $that.addClass('search-active');
        var raw_data = $that.val(), // Item Container
            ajaxUrl = $that.data('url')
  
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                raw_data: raw_data
            },
            beforeSend: function () {
                if (!$that.parent().find('.fa-spinner').length) {
                    $('<i class="fa fa-spinner fa-spin"></i>').appendTo($that.parent()).fadeIn(100);
                }
            },
            complete: function () {
                $that.parent().find('.fa-spinner ').remove();
            }
        })
        .done(function (data) {
            if (e.type == 'blur') {
                $('.course-search-results').html('');
            } else {
                $('.course-search-results').html(data);
            }
        })
        .fail(function () {
            console.log("error");
        });
    });

    /* -------------------------------------------------
    ------------ 4. Course Archive filter -------------
    ---------------------------------------------------- */
    $(document).on('change', '.kitolms-course-filter', function (e) {
        e.preventDefault();
        $(this).closest('form').submit();
    });
    
    /* --------------------------------------
    *       5. Magnific Popup Shop
    *  -------------------------------------- */
    $('.feature-style-single .woocommerce-product-gallery__image a').magnificPopup({
        type: 'image',
        mainClass: 'product-img-zoomin',
        gallery: { enabled: true },
        zoom: {
            enabled: true, // By default it's false, so don't forget to enable it
            duration: 400, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function
            opener: function(openerElement) {
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });

});
