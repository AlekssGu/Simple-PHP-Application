var map;
    var geocoder;
    function InitializeMap() {

        var latlng = new google.maps.LatLng(56.508087,21.011502);
        var myOptions =
        {
            zoom: 13,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true
        };
        map = new google.maps.Map(document.getElementById("map"), myOptions);
    }

    function FindLocation() {
        geocoder = new google.maps.Geocoder();
        InitializeMap();

        var address = document.getElementById("address").value;
        geocoder.geocode({ 'address': address }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
            	map.setZoom(17);
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });

            }
            else {
            	if(status!=='OK')
            	{
            		$('#address').removeClass('goodValue');
	    			$('#address').addClass('badValue');
            	}
            }
        });

    }

    window.onload = InitializeMap;