@extends('layouts')
@section('page')
    <style>
        .search-bar{
            position: absolute;
            top:20px;
            left:20px;
            z-index:9;
            width: 350px;
        }
        .search-bar .md-search{
            position: absolute;
            top:10px;
            left: 10px;
            z-index: 9;
            font-size: 20px;
            transform: rotate(0.03deg);
        }
        .search-bar #search-input {
            position: relative;
            float: left;
            background-color: #fff;
            font-size: 14px;
            padding: 7px 10px 7px 30px;
            text-overflow: ellipsis;
            width: calc(100% - 40px);
            border: 1px solid #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,.14);
            border-radius: 2px;
            transition: all 0.3s ease-out;
        }
        .user-details{
            position: absolute;
            bottom:0;
            left: 0;
            z-index: 9;
            width: 100%;
            margin: 0;
        }
        .user-col .btn-close{
            float: right;
            margin-top: 5px;
        }
        @media screen and (max-width: 480px){
            .search-bar{
                width: 100%;
                left: 0;
                padding: 0 10px;
            }
            .search-bar .md-search{
                left: 20px;
            }
            .search-bar #search-input{
                width: 100%;
                position: relative;
                float: left;
            }
        }
    </style>
    <div class="page">
        <div class="search-bar">
            <i class="icon md-search"></i>
            <input id="search-input" class="controls" type="text" placeholder="Search">
        </div>
        <div class="gmap" id="gmap"></div>

        <div class="row row-centered user-details" style="display: none">
            <div class="col-lg-3 no-display"></div>
            <div class="col-lg-6 user-col">
                <div class="card card-shadow">
                    <div class="card-block">
                        <h4 class="inline-block blue-600 user-name">Samir Maikap</h4>
                        <button class="btn-close btn-round btn-inverse border-0"><i class="md-close text-danger"></i></button>
                    </div>
                    <div class="card-block">
                        <a class="avatar avatar-100 float-left mr-20" href="javascript:void(0)">
                            <img class="user-image" src="../../../global/portraits/13.jpg" alt="">
                        </a>
                        <div class="vertical-align text-left  h-100 text-truncate">
                            <div class="vertical-align-middle">
                                <div class="font-size-14 text-truncate user-email">maikap.samir@gmail.com</div>
                                <div class="font-size-14 text-truncate user-address">26, Prafullanagr Road, South udmdum Kolkta 700074</div>
                                <div class="font-size-14 text-truncate user-type">Provider</div>
                                <div class="font-size-14 text-truncate user-status">Active</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 no-display"></div>

        </div>
    </div>

    <script>
        var map;
        var timer;
        var geocoder;
        function initMap() {

            var styledMapType = new google.maps.StyledMapType([
                {
                    "elementType":"geometry",
                    "stylers":[
                        {
                            "color":"#f5f5f5"
                        }
                    ]
                },
                {
                    "elementType":"labels.icon",
                    "stylers":[
                        {
                            "visibility":"off"
                        }
                    ]
                },
                {
                    "elementType":"labels.text.fill",
                    "stylers":[
                        {
                            "color":"#616161"
                        }
                    ]
                },
                {
                    "elementType":"labels.text.stroke",
                    "stylers":[
                        {
                            "color":"#f5f5f5"
                        }
                    ]
                },
                {
                    "featureType":"administrative",
                    "elementType":"geometry",
                    "stylers":[
                        {
                            "visibility":"off"
                        }
                    ]
                },
                {
                    "featureType":"administrative.land_parcel",
                    "elementType":"labels.text.fill",
                    "stylers":[
                        {
                            "color":"#bdbdbd"
                        }
                    ]
                },
                {
                    "featureType":"poi",
                    "stylers":[
                        {
                            "visibility":"off"
                        }
                    ]
                },
                {
                    "featureType":"poi",
                    "elementType":"geometry",
                    "stylers":[
                        {
                            "color":"#eeeeee"
                        }
                    ]
                },
                {
                    "featureType":"poi",
                    "elementType":"labels.text.fill",
                    "stylers":[
                        {
                            "color":"#757575"
                        }
                    ]
                },
                {
                    "featureType":"poi.park",
                    "elementType":"geometry",
                    "stylers":[
                        {
                            "color":"#e5e5e5"
                        }
                    ]
                },
                {
                    "featureType":"poi.park",
                    "elementType":"labels.text.fill",
                    "stylers":[
                        {
                            "color":"#9e9e9e"
                        }
                    ]
                },
                {
                    "featureType":"road",
                    "elementType":"geometry",
                    "stylers":[
                        {
                            "color":"#ffffff"
                        }
                    ]
                },
                {
                    "featureType":"road",
                    "elementType":"labels.icon",
                    "stylers":[
                        {
                            "visibility":"off"
                        }
                    ]
                },
                {
                    "featureType":"road.arterial",
                    "elementType":"labels.text.fill",
                    "stylers":[
                        {
                            "color":"#757575"
                        }
                    ]
                },
                {
                    "featureType":"road.highway",
                    "elementType":"geometry",
                    "stylers":[
                        {
                            "color":"#dadada"
                        }
                    ]
                },
                {
                    "featureType":"road.highway",
                    "elementType":"labels.text.fill",
                    "stylers":[
                        {
                            "color":"#616161"
                        }
                    ]
                },
                {
                    "featureType":"road.local",
                    "elementType":"labels.text.fill",
                    "stylers":[
                        {
                            "color":"#9e9e9e"
                        }
                    ]
                },
                {
                    "featureType":"transit",
                    "stylers":[
                        {
                            "visibility":"off"
                        }
                    ]
                },
                {
                    "featureType":"transit.line",
                    "elementType":"geometry",
                    "stylers":[
                        {
                            "color":"#e5e5e5"
                        }
                    ]
                },
                {
                    "featureType":"transit.station",
                    "elementType":"geometry",
                    "stylers":[
                        {
                            "color":"#eeeeee"
                        }
                    ]
                },
                {
                    "featureType":"water",
                    "elementType":"geometry",
                    "stylers":[
                        {
                            "color":"#c9c9c9"
                        }
                    ]
                },
                {
                    "featureType":"water",
                    "elementType":"labels.text.fill",
                    "stylers":[
                        {
                            "color":"#9e9e9e"
                        }
                    ]
                }
            ],{name: 'Styled Map'});
            geocoder = new google.maps.Geocoder;
            map = new google.maps.Map(document.getElementById('gmap'), {
                zoom: 17,
                // center: new google.maps.LatLng(22.6059, 88.3968),
                mapTypeId: 'roadmap',
                gestureHandling: 'greedy',
                mapTypeControl: false,
                fullscreenControl: false
            });

            // if (navigator.geolocation) {
            //     navigator.geolocation.getCurrentPosition(function(position) {
            //         var pos = {
            //             lat: position.coords.latitude,
            //             lng: position.coords.longitude
            //         };
            //
            //         // infoWindow.setPosition(pos);
            //         // infoWindow.setContent('Location found.');
            //         // infoWindow.open(map);
            //         map.setCenter(pos);
            //     });
            // }
            // else{
            //     var pos={'lat':'22.6059','lng':'88.3968'}
            //     map.setCenter(pos);
            // }

            google.maps.event.trigger(map,'resize');
            var pos={'lat':22.6059,'lng':88.3968}
            map.setCenter(pos);


            map.mapTypes.set('styled_map', styledMapType);
            map.setMapTypeId('styled_map');

            /*Map search*/
            var input = document.getElementById('search-input');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                }
            });

            /*Event for map drag stop*/
            google.maps.event.addListener(map,'dragend',function(){
                var lat= this.getCenter().lat();
                var lon=this.getCenter().lng();
                var zoom=this.getZoom();
                window.clearTimeout(timer);
                //var millisecBeforeRedirect = 10000;
                timer = window.setTimeout(function(){
                    getData(map,lat,lon,zoom);
                },1000);
            });

            /*Event for  map zoom*/
            google.maps.event.addListener(map, 'zoom_changed', function() {
                var lat= this.getCenter().lat();
                var lon=this.getCenter().lng();
                var zoom=this.getZoom();
                window.clearTimeout(timer);
                //var millisecBeforeRedirect = 10000;
                timer = window.setTimeout(function(){
                    getData(map,lat,lon,zoom);
                },1000);

            });
        }

        window.onload=function(){
            initMap();
            getData(22.6059,88.3968,1)
            $('.btn-close').click(function () {
                $('.user-details').stop(0).slideUp('fast');
            })
        }

        function getData(map,latitude=null,longitude=null,zoom=null){
            NProgress.start();
            var url="{{url('home/map/load')}}";
            $.post(url,{'latitude':latitude,'longitude':longitude,'zoom':zoom},function(response){
                var len=response.length;
                if(len > 0){
                    for (var i=0;i<len;i++){
                        var position=new google.maps.LatLng(response[i].latitude, response[i].longitude);
                        var marker = new google.maps.Marker({
                            position: position,
                            icon: response[i].image,
                            map: map
                        });
                        marker.accountId=response[i].account_id;
                        google.maps.event.addListener(marker, 'click', function () {
                            var id =marker.accountId;
                            geocodePosition(marker.getPosition());
                            displayUserContent(id);
                        });
                    }
                }
                NProgress.done();
            })
        }

        function displayUserContent(id){
            var url="{{url('home/account/info')}}/"+id;
            $.post(url,function(response){
                if(response.status){
                    $('.user-image').attr('src',response.data.image);
                    $('.user-name').html(response.data.name);
                    $('.user-email').html(response.data.email);
                    $('.user-type').html(response.type);
                    if(response.data.active==='Active'){
                        $('.user-status').html(response.data.active).addClass('text-success');
                    }
                    else{
                        $('.user-status').html(response.data.active).addClass('text-danger');
                    }
                    $('.user-details').stop(0).slideDown('fast');
                }
                else{
                    alertify.logPosition("bottom right");
                    alertify.error(response.message);
                }
            })
        }

        function geocodePosition(pos) {
            geocoder.geocode({
                latLng: pos
            }, function(responses) {
                if (responses && responses.length > 0) {
                    $('.user-address').html(responses[0].formatted_address);
                } else {
                    $('.user-address').html('N/A');
                }
            });
        }
    </script>
@endsection