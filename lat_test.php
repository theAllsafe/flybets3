<!DOCTYPE html>
<html>
<body>
<input id="searchTextField" type="text" class="form-control " size="50" placeholder="Search location">  
<div id="map_canvas" style="height: 400px;width: 100%;margin: 0.6em; "></div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvrWwydlLEhYsmISJ4OEP1HesTuSTOyD8&libraries=places,drawing" async defer></script>
<script type="text/javascript">
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
        image = ''; 
         
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
        circle = shape;
        console.log('radius', circle.getRadius());
        console.log('lat', circle.getCenter().lat());
        console.log('lng', circle.getCenter().lng());
    }

</script>




</body>

</html>



