jQuery( document ).ready(function($)
{
    //Changing multiple select dropdown to Select2 dropdown.
    $("#select_products").select2({});
    $("#select_categories").select2({});

    //Hiding all setting fields on document ready.
    $('#minimum_qty').parent().hide();
    $('#minimum_qty').parent().siblings().hide();
    
    $('#maximum_qty').parent().hide();
    $('#maximum_qty').parent().siblings().hide();

    $('#select_products').parent().hide();
    $('#select_products').parent().siblings().hide();

    $('#select_categories').parent().hide();
    $('#select_categories').parent().siblings().hide();

    $('#enable_step').parent().parent().parent().hide();
    $('#enable_step').parent().parent().parent().siblings().hide();

    $('#step_multiple').parent().hide();
    $('#step_multiple').parent().siblings().hide();

    //Setting up required attributes in fields.
    // $("#minimum_qty").attr("required", "true");
    // $("#maximum_qty").attr("required", "true");

    //Showing all setting fields on document ready if it was saved enabled.
    if( $('#enable_fields').prop('checked') )
    {
        $('#minimum_qty').parent().show();
        $('#minimum_qty').parent().siblings().show();
        
        $('#maximum_qty').parent().show();
        $('#maximum_qty').parent().siblings().show();

        $('#select_products').parent().show();
        $('#select_products').parent().siblings().show();
    
        $('#select_categories').parent().show();
        $('#select_categories').parent().siblings().show();

        $('#enable_step').parent().parent().parent().show();
        $('#enable_step').parent().parent().parent().siblings().show();

        //Showing step multiple field on document ready if it was saved enabled.
        if( $('#enable_step').prop('checked') )
        {
            $('#step_multiple').parent().show();
            $('#step_multiple').parent().siblings().show();
        }
    }

    /**
     * Showing/Hiding all setting fields on enable checked & unchecked.
     */
    $('#enable_fields').click(function()
    {
        if( $(this).prop('checked') )
        {
            $('#minimum_qty').parent().show();
            $('#minimum_qty').parent().siblings().show();
            
            $('#maximum_qty').parent().show();
            $('#maximum_qty').parent().siblings().show();
        
            $('#enable_step').parent().parent().parent().show();
            $('#enable_step').parent().parent().parent().siblings().show();

            $('#select_products').parent().show();
            $('#select_products').parent().siblings().show();
        
            $('#select_categories').parent().show();
            $('#select_categories').parent().siblings().show();

            $('#enable_step').prop('checked', false)
        }
        else
        {
            $('#minimum_qty').val("1");
            $('#minimum_qty').parent().hide();
            $('#minimum_qty').parent().siblings().hide();
            
            $('#maximum_qty').val("");
            $('#maximum_qty').parent().hide();
            $('#maximum_qty').parent().siblings().hide();
        
            $('#enable_step').parent().parent().parent().hide();
            $('#enable_step').parent().parent().parent().siblings().hide();
        
            $('#step_multiple').val("1");
            $('#step_multiple').parent().hide();
            $('#step_multiple').parent().siblings().hide();

            $('#select_products').parent().hide();
            $('#select_products').parent().siblings().hide();
        
            $('#select_categories').parent().hide();
            $('#select_categories').parent().siblings().hide();
        }
    });

    /**
     * Showing/Hiding Step Multiple field on enable checked & unchecked.
     */
    $('#enable_step').click(function()
    {
        if( $(this).prop('checked') &&  $('#enable_fields').prop('checked') )
        {
            $('#step_multiple').parent().show();
            $('#step_multiple').parent().siblings().show();
        }
        else
        {
            $('#step_multiple').val("1");
            $('#step_multiple').parent().hide();
            $('#step_multiple').parent().siblings().hide();
        }
    });

    /**
     * All validations for minimum qty field.
     */
    $('#minimum_qty').change(function()
    {
        if( $('#minimum_qty').val() % 1 != 0 )
        {
            $('#minimum_qty').val( Math.floor( $('#minimum_qty').val() ) );
        }

        if( $('#minimum_qty').val() == "" ){
            $('#minimum_qty').val( "" );
        }
        else if( $('#minimum_qty').val() < 1 )
        {
            $('#minimum_qty').val( "1" );
        }
        else if( $('#maximum_qty').val() && parseInt($('#minimum_qty').val()) > parseInt($('#maximum_qty').val()) )
        {
            $('#minimum_qty').val( parseInt($('#maximum_qty').val()) );
        }
        else if( $('#minimum_qty').val() > 100 )
        {
            $('#minimum_qty').val( "100" );
        }

    });

    /**
     * All validations for maximum qty field.
     */
    $('#maximum_qty').change(function()
    {
        if( $('#maximum_qty').val() % 1 != 0 )
        {
            $('#maximum_qty').val( Math.floor( $('#maximum_qty').val() ) );
        }

        if( $('#maximum_qty').val() == "" )
        {
            $('#maximum_qty').val( "" );
        }
        else if( $('#minimum_qty').val() && parseInt($('#maximum_qty').val()) < parseInt($('#minimum_qty').val()) )
        {
            $('#maximum_qty').val( parseInt($('#minimum_qty').val()) );
        }
        else if( $('#maximum_qty').val() < 1)
        {
            $('#maximum_qty').val( "1" );
        }

    });

    /**
     * All validations for step multiple field.
     */
    $('#step_multiple').change(function()
    {
        if( $('#step_multiple').val() % 1 != 0 )
        {
            $('#step_multiple').val( Math.floor( $('#step_multiple').val() ));
        }

        if( $('#step_multiple').val() == "" )
        {
            $('#step_multiple').val( "" );
        }
        else if( $('#maximum_qty').val() && parseInt($('#step_multiple').val()) > (parseInt($('#maximum_qty').val()) - parseInt($('#minimum_qty').val())) )
        {
            $('#step_multiple').val( parseInt($('#maximum_qty').val()) - parseInt($('#minimum_qty').val())  );
        }
        else if( $('#maximum_qty').val() && !$('#minimum_qty').val() && parseInt($('#step_multiple').val()) > (parseInt($('#maximum_qty').val()) - 1 ))
        {
            $('#step_multiple').val( parseInt($('#maximum_qty').val()) - 1 );
        }
        else if( $('#step_multiple').val() < 1 )
        {
            $('#step_multiple').val( "1" );
        }
        else if( $('#step_multiple').val() > 100)
        {
            $('#step_multiple').val( "100" );
        }

    });

    $('#select_products').click(function()
    {
        console.log("okkkkk")
    });


});

