/**
 * Whols Admin JS
 *
 * @since 1.0.0
 */
;( function ( $ ) {
    'use strict';

    $( document ).ready( function () {
    	$('body').on('click', '.whols_button_clone', function() {
    		var id = $(this).data('id');
    	    if( id != undefined ){
    	    	$(this).parent().find('.whols_product_meta_type_2_pricing_wrapper').append('<span class="wrap whols_product_meta_wrap"><span class="whols_field_wrap"><span class="whols_lbl">Role</span><select name="whols_price_type_2_role_'+ id +'[]"><option value="any_role">Any Role</option><option value="whols_default_role">Default Role</option><option value="role-1">Role 1</option><option value="role-2">Role 2</option></select></span><span class="whols_field_wrap"><span class="whols_lbl">Price</span><input name="whols_price_type_2_price_'+ id +'[]" class="" type="number" step="any" min="0" value=""></span><span class="whols_field_wrap"><span class="whols_lbl">Min. Quantity</span><input name="whols_price_type_2_min_quantity_'+ id +'[]" class="" type="number" step="any" min="0" value=""></span><i class="dashicons-before dashicons-no"></i></span>');

    	    	return false; //prevent form submission
    		} else {
    	    	$(this).parent().find('.whols_product_meta_type_2_pricing_wrapper').append('<span class="wrap whols_product_meta_wrap"><span class="whols_field_wrap"><span class="whols_lbl">Role</span><select name="whols_price_type_2_role[]"><option value="any_role">Any Role</option><option value="whols_default_role">Default Role</option><option value="role-1">Role 1</option><option value="role-2">Role 2</option></select></span><span class="whols_field_wrap"><span class="whols_lbl">Price</span><input name="whols_price_type_2_price[]" class="" type="number" step="any" min="0" value=""></span><span class="whols_field_wrap"><span class="whols_lbl">Min. Quantity</span><input name="whols_price_type_2_min_quantity[]" class="" type="number" step="any" min="0" value=""></span><i class="dashicons-before dashicons-no"></i></span>');
    	    }
    	});

        // active settigns page
        if (typeof whols_is_settings_page != "undefined" && whols_is_settings_page === 1){
            $('li.toplevel_page_whols-admin .wp-first-item').addClass('current');
        }

        // help image
        $('.csf-title .dashicons-before').on('mouseover', function(){
            $(this).parent().find('.whols_help_image').show();
        }).on('mouseout',function(){
            $(this).parent().find('.whols_help_image').hide();
        });

        // review fields
        $('body').on('click', '.whols_product_meta_wrap i', function(){
            $(this).parent().remove();
        });

        // pro notice
        $('.whols_pro, .taxonomy-whols_role_cat input[type="submit"]').on('click', function(e){
            e.preventDefault();
            var $element = $(this);
            vex.dialog.open({
                unsafeMessage: `
                    <h3>Pro Version is Required!</h3>
                    <p>This feature is available in the pro version.</p>
                    <a target="_blank" href="https://hasthemes.com/plugins/whols-woocommerce-wholesale-prices/">More Details</a>`,
                className: "vex-theme-plain",
                showCloseButton: true,
                buttons: [],
                contentClassName: 'whols_pro_notice',
            });
        });
    });

} )( jQuery );