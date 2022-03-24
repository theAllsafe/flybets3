@extends('layouts.index')
{{--@section('style')--}}

{{--@endsection--}}
{{--@dd(profiles())--}}
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div
                class=" page__heading d-flex flex-column flex-md-row align-items-center
                  justify-content-center justify-content-lg-between text-center text-lg-left">
                <h1 class="m-lg-0">Dashboard</h1>

            </div>
        </div>
        <div class="container-fluid page__container">
            <h4 class="card-header__title mb-3">UPDATES</h4>
            <div class="row card-group-row">
                <div class="col-lg-3 col-md-4 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex flex-column">
                            <div class="avatar mb-2">
                        <span
                            class="
                            bg-soft-purple
                            avatar-title
                            rounded-circle
                            text-center text-purple
                          "
                        >
                            <img src="{{ asset('assets/12FlyIcons/activeicon2x.png') }}"
                                 width="45" height="45" alt="">
                        </span>
                            </div>
                            <a href="#" class="text-dark mb-2">
                                <strong>Active</strong>
                            </a>
                            <p class="text-muted">
                                UAS Operation in progress.
                            </p>
                            <div
                                class="
                          d-flex
                          justify-content-between
                          align-items-center
                        "
                            >
                                <div>
                                </div>
                                <div class="h4 text-primary">{{ $active_uas_operations }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex flex-column">
                            <div class="avatar mb-2">
                        <span
                            class="
                            bg-soft-warning
                            avatar-title
                            rounded-circle
                            text-center text-warning
                          "
                        >
                         <img src="{{ asset('assets/12FlyIcons/completeicon2x.png') }}"
                              width="45" height="45" alt="">
                        </span>
                            </div>
                            <a href="#" class="text-dark mb-2">
                                <strong>Completed</strong>
                            </a>
                            <p class="text-muted">
                                UAS Operation ended.
                            </p>

                            <div
                                class="
                          d-flex
                          justify-content-between
                          align-items-center
                        "
                            >
                                <div>
                                </div>
                                <div class="h4 text-primary">{{ $completed_uas_operations }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex flex-column">
                            <div class="avatar mb-2">
                        <span
                            class="
                            bg-soft-primary
                            avatar-title
                            rounded-circle
                            text-center text-primary
                          "
                        >
                            <img src="{{ asset('assets/12FlyIcons/unmannedaircrafticon2x.png') }}"
                                 width="45" height="45" alt="">
                        </span>
                            </div>
                            <a href="#" class="text-dark mb-2">
                                <strong>Unmanned Aircraft</strong>
                            </a>
                            <p class="text-muted">
                                Number of aircraft registered.
                            </p>

                            <div
                                class="
                          d-flex
                          justify-content-between
                          align-items-center
                        "
                            >
                                <div>
                                </div>
                                <div class="h4 text-primary">{{ $unmanned_aircraft_number }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex flex-column">
                            <div class="avatar mb-2">
                        <span
                            class="
                            bg-soft-success
                            avatar-title
                            rounded-circle
                            text-center text-success
                          "
                        >
                            <img src="{{ asset('assets/12FlyIcons/uaspiloticon2x.png') }}"
                                 width="45" height="45" alt="">
                        </span>
                            </div>
                            <a href="#" class="text-dark mb-2">
                                <strong>UAS Pilot</strong>
                            </a>
                            <p class="text-muted">
                                Number of pilot registered.
                            </p>

                            <div
                                class="
                          d-flex
                          justify-content-between
                          align-items-center
                        "
                            >
                                <div>
                                </div>
                                <div class="h4 text-primary">{{ $uas_pilots_number }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- MAP--}}
            <h4 class="card-header__title mb-3" style="margin-top: 20px">AIRSPACE MAP</h4>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body" style="padding: 10px 10px 10px 10px !important;">
                            <div style="width: 100%">
                                <!--<input id="pac-input" class="controls" type="text" placeholder="Search Box">
                                <div id="map"></div>-->
                                <div class="form-row">
                                    <div class="col-12 col-md-12 mb-3">
                                        <label for="description" class="form-title">Location
                                            <span style="color: red; font-size: 18px">*</span> :</label>
                                        
                                        <input id="searchTextField" type="text" class="form-control " size="50" placeholder="Search location">   
                                                                    </div>
                                                                    <div id="map_canvas" style="height: 400px;width: 100%;margin: 0.6em; "></div>
                                </div>
                                          
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--EndMAP--}}
            <!--{{-- MAP--}}-->
            <!--<h4 class="card-header__title mb-3" style="margin-top: 20px">AIRSPACE MAP</h4>-->
            <!--<div class="row">-->
            <!--    <div class="col-lg-12">-->
            <!--        <div class="card">-->
            <!--            <div class="card-body" style="padding: 10px 10px 10px 10px !important;">-->
            <!--                <div style="width: 100% !important">-->
            <!--                    {{--                                <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1QdNEBFEDhlIM4xY_0uL6cyJ0ikD5Fxex&ehbc=2E312F" width="640" height="480"></iframe>--}}-->
            <!--                    {{--                                                                <iframe--}}-->
            <!--                    {{--                                                                    src="https://www.google.com/maps/d/u/0/embed?mid=1QdNEBFEDhlIM4xY_0uL6cyJ0ikD5Fxex&ehbc=2E312F"--}}-->
            <!--                    {{--                                                                    width="640" height="480"></iframe>--}}-->
            <!--                    <div class="my-mapz"><iframe src="https://www.google.com/maps/d/embed?mid=1QdNEBFEDhlIM4xY_0uL6cyJ0ikD5Fxex&hl=en&ehbc=2E312F" width="1010" height="480"></iframe></div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--{{--EndMAP--}}-->
            
        </div>
    </div>
@endsection
@section('script')
<script>
var map;
var faisalabad = {lat:31.4181, lng:73.0776};
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
        /*drawing map end*/
        //for drawing start
        // var drawingManager = new google.maps.drawing.DrawingManager({
        //     drawingMode: google.maps.drawing.OverlayType.POLYGON,
        //     drawingControl: true,
        //     drawingControlOptions: {
        //       position: google.maps.ControlPosition.TOP_CENTER,
        //       drawingModes: ['polygon', 'circle']
        //     },
        //     polygonOptions: {
        //       editable: true
        //     }
        // });
        //   drawingManager.setMap(map);
        //   google.maps.event.addListener(drawingManager, 'circlecomplete', onCircleComplete);
        //   google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
        //         var coordinates = (polygon.getPath());
        //         console.log(coordinates);
        //         for (let i = 0; i < coordinates.getLength(); i++) 
        //          {
        //           const xy = coordinates.getAt(i);
        //           var contentString = console.log(JSON.stringify({point: xy +[i+1]}))
        //          }
                 
        //     });
        /*drawing map end*/
            //  google.maps.event.addListener(drawingManager, 'rectanglecomplete', function (e) {
            //     var locations = e.overlay.getPath().getArray()
            //     console.log(locations);
                
                 
            // });
        //   google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
        //     event.overlay.set('editable', false);
        //     drawingManager.setMap(null);
        //     console.log(event.overlay);
        //   });
        //for drawing end
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

function onCircleComplete(shape) {
        if (shape == null || (!(shape instanceof google.maps.Circle))) return;

        // if (circle != null) {
        //     circle.setMap(null);
        //     circle = null;
        // }

        circle = shape;
        console.log('radius', circle.getRadius());
        console.log('lat', circle.getCenter().lat());
        console.log('lng', circle.getCenter().lng());
    }

</script>
<script>
//     let map;

//     function initMap() {
//         var myLatlng = new google.maps.LatLng(2.913942, 101.684431);
//         var myLatlng2 = new google.maps.LatLng(4.913942, 107.884431);

//         map = new google.maps.Map(document.getElementById("map"), {
//             center: myLatlng2,
//             zoom: 6,
//         });

//         map2 = new google.maps.Map(document.getElementById("map2"), {
//             center: myLatlng2,
//             zoom: 6,
//         });

//         new google.maps.Marker({
//             position: myLatlng,
//             map,
//             title: "Hello World!",
//         });

//         new google.maps.Marker({
//             position: myLatlng,
//             map2,
//             title: "Hello World!",
//         });
//     }
    
//     function initAutocomplete() {
//   var map = new google.maps.Map(document.getElementById('map'), {
//     center: {lat: -33.8688, lng: 151.2195},
//     zoom: 13,
//     mapTypeId: 'roadmap'
//   });

//   // Create the search box and link it to the UI element.
//   var input = document.getElementById('pac-input');
//   var searchBox = new google.maps.places.SearchBox(input);
//   map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  

//   // Bias the SearchBox results towards current map's viewport.
//   map.addListener('bounds_changed', function() {
//     searchBox.setBounds(map.getBounds());
//   });

//   var markers = [];
//   // Listen for the event fired when the user selects a prediction and retrieve
//   // more details for that place.
//   searchBox.addListener('places_changed', function() {
//     var places = searchBox.getPlaces();

//     if (places.length == 0) {
//       return;
//     }

//     // Clear out the old markers.
//     markers.forEach(function(marker) {
//       marker.setMap(null);
//     });
//     markers = [];

//     // For each place, get the icon, name and location.
//     var bounds = new google.maps.LatLngBounds();
//     places.forEach(function(place) {
//       if (!place.geometry) {
//         console.log("Returned place contains no geometry");
//         return;
//       }
//       var icon = {
//         url: place.icon,
//         size: new google.maps.Size(71, 71),
//         origin: new google.maps.Point(0, 0),
//         anchor: new google.maps.Point(17, 34),
//         scaledSize: new google.maps.Size(25, 25)
//       };

//       // Create a marker for each place.
//       markers.push(new google.maps.Marker({
//         map: map,
//         icon: icon,
//         title: place.name,
//         position: place.geometry.location
//       }));

//       if (place.geometry.viewport) {
//         // Only geocodes have viewport.
//         bounds.union(place.geometry.viewport);
//       } else {
//         bounds.extend(place.geometry.location);
//       }
//     });
//     map.fitBounds(bounds);
//   });
// }

//     {{--    // For change a file value after upload the file--}}
//     function getFileData(myFile, id) {
//         var file = myFile.files[0];
//         var filename = file.name;
//         document.getElementById(id).value = filename;
//     }

</script>
@endsection



