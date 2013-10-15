//check address value
//if good -> add class goodvalue, otherwise badvalue
$('#address').on('blur', function() {
	    	if($('#address').val()) 
	    		{
	    			FindLocation();
	    			$(this).removeClass('badValue');
	    			$(this).addClass('goodValue');
	    		}
	    	else 
	    		{
	    		$(this).removeClass('goodValue');
	    		$(this).addClass('badValue');
	    		}
	    });
//check name value
//if good -> add class goodvalue, otherwise badvalue
	    $('#name').on('blur', function() {
	    	if($('#name').val()) 
	    		{
	    			$(this).removeClass('badValue');
	    			$(this).addClass('goodValue');
	    		}
	    	else 
	    		{
	    		$(this).removeClass('goodValue');
	    		$(this).addClass('badValue');
	    		}
	    });
//check telephone value
//if good -> add class goodvalue, otherwise badvalue
	    $('#telephone').on('blur', function() {
	    	if(parseInt($('#telephone').val())) 
	    		{
	    			$(this).removeClass('badValue');
	    			$(this).addClass('goodValue');
	    		}
	    	else 
	    		{
	    		$(this).removeClass('goodValue');
	    		$(this).addClass('badValue');
	    		}
	    });

    var handbags;//used to store the value of handbag count
    var sportbag;//used to store the value of sports bag count
    var travelbag;//used to store the value of travel bag count
    var totalVal=0;//total value of bags

//check if checkbox is checked, if is then disable plus or minus buttons
$('#nobags').click(function() {
       	if($(this).is(':checked')) $('.plusBtn, .minusBtn').attr('disabled','');
       	else $('.plusBtn, .minusBtn').removeAttr('disabled');
    });

//if plus button clicked count all the bags and add +1 to the total value of clicked bag
    $('.plusBtn').on('click', function() {
    	handbags = parseInt($('#handbags').val());
	    sportbag = parseInt($('#sportbag').val());
	    travelbag = parseInt($('#travelbag').val());
    	totalVal=handbags+sportbag+travelbag;

    	$('#nobags').attr('disabled','');

    	var value;
		value=parseInt($(this).parent().find('input').val());
		$(this).parent().find('input').val(1+value);
    });
//if minus button clicked count all the bags and substract 1 of the total value of clicked bag
//substract only if count is not less than 0
    $('.minusBtn').on('click', function() {
    	handbags = parseInt($('#handbags').val());
	    sportbag = parseInt($('#sportbag').val());
	    travelbag = parseInt($('#travelbag').val());
    	totalVal=handbags+sportbag+travelbag;

    	var value;
		value=parseInt($(this).parent().find('input').val());

		if(value<=1 && totalVal<=1) $('#nobags').removeAttr('disabled');

		if(value>0) $(this).parent().find('input').val(value-1);
		else $(this).parent().find('input').val(value);
    });

//form submission
$('#getlocation').on('click', function() {
    var goodBag=true;
    handbags = parseInt($('#handbags').val());
    sportbag = parseInt($('#sportbag').val());
    travelbag = parseInt($('#travelbag').val());

    if(!$('#code').val()) 
    	{
    		$('#code').removeClass('goodValue');
    		$('#code').addClass('badValue');
    	}
    else 
    	{
    		$('#code').removeClass('badValue');
    		$('#code').addClass('goodValue');
    	}

   		//check values again and display warnings
    	if((handbags < 1 && sportbag < 1 && travelbag < 1) && !$('#nobags').is(':checked')) 
    	{
    		$('#bagError').removeClass('hidden');
    		/*$('html, body').animate({
		        scrollTop: $("#bagError").offset().top
		    }, 700);*/
		    goodBag=false;
    	}
    	else
    	{
    		$('#bagError').addClass('hidden');
    	}

    	if(($('#ride').children().find('input').hasClass('badValue')) || (goodBag===false) || ($('#ride').children().find('textarea').hasClass('badValue')))
    	{
    		$('.value-error').removeClass('hidden');
    		$('html, body').animate({
		        scrollTop: $("#getRide").offset().top
		    }, 700);
		    goodBag=false;
		    return false;
    	}
    	else 
    		{
    			$('.value-error').addClass('hidden');
    			return true;
    		}

    });