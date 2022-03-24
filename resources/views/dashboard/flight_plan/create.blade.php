@extends('layouts.index')
@section('style')
    <style>
        /* Hide all steps by default: */
        .tab {
            display: none;
        }

        /* Make circles that indicate the steps of the form: */
        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        /* Mark the active step: */
        .step.active {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
            background-color: #04aa6d;
        }

        #submitBtn {
            display: none;
        }

        [dir=ltr] label{
            margin-bottom: 1px;
        }

        .validation-inputs{
            display: none;
        }
        
        #map_canvas {         
            height: 400px;         
            width: 100%;         
            margin: 0.6em;       
        }
        
        #panel {
            width: 200px;
            font-family: Arial, sans-serif;
            font-size: 13px;
            float: right;
            margin: 10px;
        }
        
        #color-palette {
            clear: both;
        }

        .color-button {
            width: 14px;
            height: 14px;
            font-size: 0;
            margin: 2px;
            float: left;
            cursor: pointer;
        }
        #delete-button {
            margin-top: 5px;
        }
        label{
            text-transform: capitalize !important;
        }
        
    </style>
@endsection
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="
                  page__heading
                  d-flex
                  flex-column flex-md-row
                  align-items-center
                  justify-content-center justify-content-lg-between
                  text-center text-lg-left">
                <h1 class="m-lg-0">Flight Plans</h1>
            </div>
        </div>
        <div class="container-fluid page__container">
            <h4 class="card-header__title mb-3">Add a Flight Plan</h4>
            <div>
                
                    <div class="card card-form">
                    {{-- <img src="{{ asset('assets\images\FP_Steps\FP_Step1.png')}}" alt="" srcset=""> --}}

                    <!-- Additional Profile Details -->
                        <div class="row no-gutters">
                            <div class="col-lg-12 card-form__body card-body">
                                <div class="tab">
                                    <div class="form-row" style="text-align: center;">
                                        <img src="{{ asset('assets\images\FP_Steps\FP_Step1.png')}}" alt="" srcset=""
                                             style="width: 100%;">
                                    </div>
                                    <div>
                                        <div id="color-palette" style="display:none;"></div>
                                        <!--<button id="delete-button">Delete Selected Shape</button>-->
                                    </div>
                                    <div class="form-row">
                                        <div class="col-8 col-md-8 mb-3">
                                            <label for="address">Please select the area of operation for the Flight Plan</label>
                                            <input id="searchTextField" type="text" class="form-control " size="50" placeholder="Search location">   
                                        </div>
                                        <div class="col-4 col-md-4 mb-3">
                                            <label for="address"></label>
                                            <button id="delete-button" class="form-control">Delete Selected Shape</button>
                                        </div>
                                        <div id="map_canvas" class="map_canvas"></div>
                                    </div>
                                    <!--<div id="output" class="show-co-ordinate">-->
                                    <!--</div>-->
                                    @includeIf('dashboard.flight_plan.steps.step1')
                                </div>
                                <div class="tab">
                                    <div class="form-row" style="text-align: center;">
                                        <img src="{{ asset('assets\images\FP_Steps\FP_Step2.png')}}" alt="" srcset=""
                                             style="width: 100%;">
                                    </div>
                                    @includeIf('dashboard.flight_plan.steps.step2')
                                </div>
                                <div class="tab">
                                    <div class="form-row" style="text-align: center;">
                                        <img src="{{ asset('assets\images\FP_Steps\FP_Step3.png')}}" alt="" srcset=""
                                             style="width: 100%;">
                                    </div>
                                    @includeIf('dashboard.flight_plan.steps.step3')
                                </div>
                                <div class="tab">
                                    <div class="form-row" style="text-align: center;">
                                        <img src="{{ asset('assets\images\FP_Steps\FP_Step4.png')}}" alt="" srcset=""
                                             style="width: 100%;">
                                    </div>
                                    
                                    @includeIf('dashboard.flight_plan.steps.step4')
                                </div>
                                <button class="btn btn-warning" id="prevBtn" type="button" onclick="nextPrev(-1)">
                                    Back
                                </button>
                                <button class="btn btn-primary" type="button" id="nextBtn" onclick="nextPrev(1)"
                                        style="margin-left: 20px">Next
                                </button>
                                <button class="btn btn-primary" type="submit" id="submitBtn"
                                        style="margin-left: 20px">Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')

<script>
    var map;
var faisalabad = {lat:31.4181, lng:73.0776};
    var drawingManager;
var selectedShape;
var colors = ['#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082'];
var selectedColor;
var colorButtons = {};
function clearSelection() {
    if (selectedShape) {
        selectedShape.setEditable(false);
        selectedShape = null;
    }
}
function setSelection(shape) {
    clearSelection();
    selectedShape = shape;
    shape.setEditable(true);
    selectColor(shape.get('fillColor') || shape.get('strokeColor'));
}
function deleteSelectedShape() {
    if (selectedShape) {
        selectedShape.setMap(null);
        $('.show-co-ordinate').html('');
        $('.map_details').val('');
    }
}

function selectColor(color) {
    selectedColor = color;
    for (var i = 0; i < colors.length; ++i) {
        var currColor = colors[i];
        colorButtons[currColor].style.border = currColor == color ? '2px solid #789' : '2px solid #fff';
    }
    // Retrieves the current options from the drawing manager and replaces the
    // stroke or fill color as appropriate.
    var polylineOptions = drawingManager.get('polylineOptions');
    polylineOptions.strokeColor = color;
    drawingManager.set('polylineOptions', polylineOptions);
    var rectangleOptions = drawingManager.get('rectangleOptions');
    rectangleOptions.fillColor = color;
    drawingManager.set('rectangleOptions', rectangleOptions);
    var circleOptions = drawingManager.get('circleOptions');
    circleOptions.fillColor = color;
    drawingManager.set('circleOptions', circleOptions);
    var polygonOptions = drawingManager.get('polygonOptions');
    polygonOptions.fillColor = color;
    drawingManager.set('polygonOptions', polygonOptions);
}
function setSelectedShapeColor(color) {
    if (selectedShape) {
        if (selectedShape.type == google.maps.drawing.OverlayType.POLYLINE) {
            selectedShape.set('strokeColor', color);
        } else {
            selectedShape.set('fillColor', color);
        }
    }
}
function makeColorButton(color) {
    var button = document.createElement('span');
    button.className = 'color-button';
    button.style.backgroundColor = color;
    google.maps.event.addDomListener(button, 'click', function () {
        selectColor(color);
        setSelectedShapeColor(color);
    });
    return button;
}
function buildColorPalette() {
    var colorPalette = document.getElementById('color-palette');
    for (var i = 0; i < colors.length; ++i) {
        var currColor = colors[i];
        var colorButton = makeColorButton(currColor);
        colorPalette.appendChild(colorButton);
        colorButtons[currColor] = colorButton;
    }
    selectColor(colors[0]);
}
function addYourLocationButton(map, marker) 
{
	var controlDiv = document.createElement('div');
	var firstChild = document.createElement('button');
	firstChild.style.backgroundColor = '#fff';
	firstChild.style.border = 'none';
	firstChild.style.outline = 'none';
	firstChild.style.width = '40px';
	firstChild.style.height = '40px';
	firstChild.style.borderRadius = '2px';
	firstChild.style.boxShadow = '0 1px 4px rgba(0,0,0,0.3)';
	firstChild.style.cursor = 'pointer';
	firstChild.style.marginRight = '10px';
	firstChild.style.padding = '0px';
	firstChild.title = 'Your Location';
	controlDiv.appendChild(firstChild);
	var secondChild = document.createElement('div');
	secondChild.style.margin = '10px';
	secondChild.style.width = '18px';
	secondChild.style.height = '18px';
	secondChild.style.backgroundImage = 'url(https://maps.gstatic.com/tactile/mylocation/mylocation-sprite-1x.png)';
	secondChild.style.backgroundSize = '180px 18px';
	secondChild.style.backgroundPosition = '0px 0px';
	secondChild.style.backgroundRepeat = 'no-repeat';
	secondChild.id = 'you_location_img';
	firstChild.appendChild(secondChild);
	
	google.maps.event.addListener(map, 'dragend', function() {
		$('#you_location_img').css('background-position', '0px 0px');
	});

	firstChild.addEventListener('click', function() {
		var imgX = '0';
		var animationInterval = setInterval(function(){
			if(imgX == '-18') imgX = '0';
			else imgX = '-18';
			$('#you_location_img').css('background-position', imgX+'px 0px');
		}, 500);
		if(navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				marker.setPosition(latlng);
				map.setCenter(latlng);
				clearInterval(animationInterval);
				$('#you_location_img').css('background-position', '-144px 0px');
			});
		}
		else{
			clearInterval(animationInterval);
			$('#you_location_img').css('background-position', '0px 0px');
		}
	});
	
	controlDiv.index = 1;
	map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(controlDiv);
}
     $(function(){ 
         var src = 'https://8bittask.com/drons-master/Malaysia_FIRS.kml';
         let dataz=navigator.geolocation.getCurrentPosition((position)=>{
        var lat = position.coords.latitude,
        lng = position.coords.longitude,
        latlng = new google.maps.LatLng(lat, lng),
        image = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png1'; 
         
        var mapOptions = {           
            center: new google.maps.LatLng(lat, lng),           
            zoom: 17,           
            mapTypeId: google.maps.MapTypeId.ROADMAP         
        },
        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),
        marker = new google.maps.Marker({
            position: latlng,
            map: map,
            zoom: 17, 
            icon: image
         });
         var myMarker = new google.maps.Marker({
    		map: map,
    		zoom: 17, 
    		animation: google.maps.Animation.DROP,
    		position: faisalabad
	    });
	    addYourLocationButton(map, myMarker);
         var kmlLayer = new google.maps.KmlLayer(src, {
          suppressInfoWindows: true,
          preserveViewport: false,
          zoom: 17, 
          map: map
        });
        var polyOptions = {
        strokeWeight: 0,
        fillOpacity: 0.45,
        editable: true,
        draggable: true
    };
    // Creates a drawing manager attached to the map that allows the user to draw
    // markers, lines, and shapes.
    drawingManager = new google.maps.drawing.DrawingManager({
        drawingMode: google.maps.drawing.OverlayType.POLYGON,
        
        markerOptions: {
            draggable: true
        },
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: ['polyline','circle','polygon']
        },
        polylineOptions: {
            editable: true,
            draggable: true
        },
        rectangleOptions: polyOptions,
        circleOptions: polyOptions,
        polygonOptions: polyOptions,
        map: map
    });
    google.maps.event.addListener(drawingManager, 'overlaycomplete', function (e) {
        if (e.type !== google.maps.drawing.OverlayType.MARKER) {
            // Switch back to non-drawing mode after drawing a shape.
            drawingManager.setDrawingMode(null);
            // Add an event listener that selects the newly-drawn shape when the user
            // mouses down on it.
            var newShape = e.overlay;
            newShape.type = e.type;
            google.maps.event.addListener(newShape, 'click', function (e) {
                if (e.vertex !== undefined) {
                    if (newShape.type === google.maps.drawing.OverlayType.POLYGON) {
                        var path = newShape.getPaths().getAt(e.path);
                        path.removeAt(e.vertex);
                        if (path.length < 3) {
                            newShape.setMap(null);
                        }
                    }
                    if (newShape.type === google.maps.drawing.OverlayType.POLYLINE) {
                        var path = newShape.getPath();
                        path.removeAt(e.vertex);
                        if (path.length < 2) {
                            newShape.setMap(null);
                        }
                    }
                }
                setSelection(newShape);
            });
            setSelection(newShape);
            console.log(google.maps.drawing.OverlayType);
            if (e.type == google.maps.drawing.OverlayType.POLYLINE || google.maps.drawing.OverlayType.POLYGON) {
                google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
                var coordinates = (polygon.getPath());
                $('.show-co-ordinate').html('');
                var inputs={};
                inputs['type']='polygon';
                $('.show-co-ordinate').append('<label> Shape:Polygon </label><br />');
                for (let i = 0; i < coordinates.getLength(); i++) 
                 {
                   const xy = coordinates.getAt(i);
                   $('.show-co-ordinate').append('<label> Point:'+JSON.stringify({point: xy +[i+1]})+' </label><br />');
                   var contentString = console.log(JSON.stringify({point: xy +[i+1]}))
                   inputs['point'+i]=JSON.stringify({point: xy +[i+1]});
                 }
                 $('.map_details').val('');
                 $('.map_details').val(JSON.stringify(inputs));
                 
            });
            google.maps.event.addListener(drawingManager, 'polylinecomplete', function (polyline) {
                var locations = e.overlay.getPath().getArray()
                $('.show-co-ordinate').html('');
                $('.show-co-ordinate').append('<label> Shape:Polyline </label><br />');
                var inputs={};
                inputs['type']='Polyline';
                for (let i = 0; i < locations.length; i++) 
                 {
                     $('.show-co-ordinate').append('<label> Point:'+locations[i]+' </label><br />');
                     inputs['point'+i]=locations[i];
                 }
                 $('.map_details').val('');
                 $('.map_details').val(JSON.stringify(inputs));
                //console.log(bounds.toString());    
                //document.getElementById('output').innerHTML = locations.toString();
                 
            });
             
            google.maps.event.addListener(drawingManager, 'circlecomplete', function (shape) {
                
                if (shape == null || (!(shape instanceof google.maps.Circle))) return;
                circle = shape;
                $('.show-co-ordinate').html('');
                $('.show-co-ordinate').append('<label> Shape:Circle </label><br />');
                $('.show-co-ordinate').append('<label> Radius:'+circle.getRadius()+' </label><br />');
                $('.show-co-ordinate').append('<label> Latitude :'+circle.getCenter().lat()+' </label><br />');
                $('.show-co-ordinate').append('<label> Longitude:'+circle.getCenter().lng()+' </label><br />');
                var inputs={};
                inputs['type']='Polyline';
                inputs['radius']=circle.getRadius();
                inputs['lat']=circle.getCenter().lat();
                inputs['lng']=circle.getCenter().lng();
                $('.map_details').val('');
                $('.map_details').val(JSON.stringify(inputs));
                console.log('radius', circle.getRadius());
                console.log('lat', circle.getCenter().lat());
                console.log('lng', circle.getCenter().lng());
                 
            });
            
            }
           
        }
    });
    // Clear the current selection when the drawing mode is changed, or when the
    // map is clicked.
    google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
    google.maps.event.addListener(map, 'click', clearSelection);
    google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);
    buildColorPalette();
        kmlLayer.addListener('click', function(event) {
          var content = event.featureData.infoWindowHtml;
          var abc=jQuery(content).text();
          alert(abc);
        /* var testimonial = document.getElementById('capture');
          testimonial.innerHTML = content;*/
        });
     
    var input = document.getElementById('searchTextField');         
    var autocomplete = new google.maps.places.Autocomplete(input, {
        types: ["geocode"]
    });          
    
    autocomplete.bindTo('bounds', map); 
    var infowindow = new google.maps.InfoWindow(); 
 
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        infowindow.close();
        var place = autocomplete.getPlace();
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(50);  
        }
        
        moveMarker(place.name, place.geometry.location);
    });  
    
    $("input").focusin(function () {
        $(document).keypress(function (e) {
            if (e.which == 13) {
                 selectFirstResult();   
            }
        });
    });
    $("input").focusout(function () {
        if(!$(".pac-container").is(":focus") && !$(".pac-container").is(":visible"))
            selectFirstResult();
    });
     
     function selectFirstResult() {
        infowindow.close();
        $(".pac-container").hide();
        var firstResult = $(".pac-container .pac-item:first").text();
        
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({"address":firstResult }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var lat = results[0].geometry.location.lat(),
                    lng = results[0].geometry.location.lng(),
                    placeName = results[0].address_components[0].long_name,
                    latlng = new google.maps.LatLng(lat, lng);
                
                moveMarker(placeName, latlng);
                $("input").val(firstResult);
            }
        });   
     }
                
         });

     function moveMarker(placeName, latlng){
        marker.setIcon(image);
        marker.setPosition(latlng);
        infowindow.setContent(placeName);
        infowindow.open(map, marker);
     }
});

function ShowPosition(position) {
    var latlon = position.coords.latitude + "," + position.coords.longitude;
    var IDs = new Object();
        IDs['lat'] = position.coords.latitude;
        IDs['long'] = position.coords.longitude;
    return IDs;
}


</script>

    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form ...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            // ... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == x.length - 1) {
                document.getElementById("nextBtn").style.display = "none";
                document.getElementById("submitBtn").style.display = 'inline-block';
            } else {
                document.getElementById("nextBtn").style.display = "inline";
                document.getElementById("submitBtn").style.display = 'none';
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            // ... and run a function that displays the correct step indicator:
            fixStepIndicator(n);
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
           
            let html2 = document.getElementById("map_canvas");
            $('.map_canvasssss').html(html2)
            console.log(html2)

            // Exit the function if any field in the current tab is invalid:
            // if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form... :
            if (currentTab >= x.length) {
                //...the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
            document.body.scrollTop = document.documentElement.scrollTop = 0;
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i,
                x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class to the current step:
            // x[n].className += " active";
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");

            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {

                let optional_fields = ['observer_mobile_number', 'additional_information'];
                let is_optional = false;
                // for(x = 0; x < optional_fields.length; x++){
                    // console.log(optional_fields[x]);
                    // console.log(y[i]);
                    // if (y[i].name == optional_fields[x])
                    //     is_optional = true;
                // }
                // If a field is empty...
                if(!is_optional) {
                     if (y[i].value == "") {
                         // y[i].name+
                         document.getElementById('purpose-validation').style.display = 'block';
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    }
                }
            }
            return valid; // return the valid status
        }

        $('input[name=purpose]').change(function () {
            $('#final_purpose').val($(this).val());
        });
        @if(old('purpose') != null)
        $('#final_purpose').val('{{ old('purpose') }}');
        @endif
        $('textarea[name=description]').change(function () {
            $('#final_description').val($(this).val());
        });
        @if(old('description') != null)
        $('#final_description').val('{{ old('description') }}');
        @endif
        $('select[name=timezone]').change(function () {
            $('#final_timezone').val($(this).val());
        });
        @if(old('timezone') != null)
        $('#final_timezone').val('{{ old('timezone') }}');
        @endif
        $('input[name=vlos_cylinder_radius]').change(function () {
            let vlos_cylinder_radius_unit = $('input[name=vlos_cylinder_radius_unit]:checked').val();
            $('#final_vlos_cylinder').val($(this).val() + ' ' + vlos_cylinder_radius_unit);
        });
        @if(old('vlos_cylinder_radius') != null)
        let vlos_cylinder_radius_unit = $('input[name=vlos_cylinder_radius_unit]:checked').val();
        $('#final_vlos_cylinder').val('{{ old('vlos_cylinder_radius') }}' + ' ' + vlos_cylinder_radius_unit);
        @endif
        $('input[name=vlos_cylinder_radius_unit]').change(function () {
            let vlos_cylinder_radius = $('input[name=vlos_cylinder_radius]').val();
            $('#final_vlos_cylinder').val(vlos_cylinder_radius + ' ' + $(this).val());
        });
        $('input[name=start_date_time]').change(function () {
            $('#final_start_date_time').val($(this).val());
        });
        @if(old('start_date_time') != null)
        $('#final_start_date_time').val('{{ old('start_date_time') }}');
        @endif
        $('input[name=max_height]').change(function () {
            let max_height_unit = $('input[name=max_height_unit]:checked').val();
            $('#final_max_height').val($(this).val() + ' ' + max_height_unit);
        });
        $('input[name=max_height_unit]').change(function () {
            let max_height = $('input[name=max_height]').val();
            $('#final_max_height').val(max_height + ' ' + $(this).val());
        });
        @if(old('max_height') != null)
        let max_height = $('input[name=max_height]').val();
        $('#final_max_height').val(max_height + ' {{ old('max_height_unit') }}');
        @endif
        $('input[name=end_date_time]').change(function () {
            $('#final_end_date_time').val($(this).val());
        });
        @if(old('end_date_time') != null)
        $('#final_end_date_time').val('{{ old('end_date_time') }}');
        @endif

        $("#uas_operator_id").change(function () {
            let id = $(this).val();
            $.ajax({
                url: "{{ route('flight-plan-uas-pilot') }}?id=" + id,
                method: 'GET',
                success: function (data) {
                    $.each(data, function (key, value) {
                        $('#' + key).val(value);
                        $('#final_' + key).val(value);
                    });
                    $.each(data['user'], function (key, value) {
                        $('#' + key).val(value);
                        $('#final_' + key).val(value);
                    });
                }
            });
        });

        $("#aircraft_id").change(function () {
            let id = $(this).val();
            $.ajax({
                url: "{{ route('aircraft') }}?id=" + id,
                method: 'GET',
                success: function (data) {
                    $.each(data, function (key, value) {
                        if (key == 'additional_information')
                            '';
                        else {
                            $('#' + key).val(value);
                            $('#final_' + key).val(value);
                        }
                    });
                    $('#aircraft_additional_information').val(data['additional_information']);
                    $('#final_aircraft_additional_information').val(data['additional_information']);
                }
            });
        });

        let dateee = new Date('04-04-2000');
        $(".start_date_time").flatpickr({
            defaultDate: '04-04-2000'
        });
    </script>
@endsection
