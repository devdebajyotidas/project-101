@extends('layouts')
@section('page')
    <div class="page">
        <div class="gmap" id="gmap"></div>
    </div>

    <script>
        var map;
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
                zoom: 10,
                mapTypeId: 'roadmap',
                gestureHandling: 'greedy',
                mapTypeControl: false,
                fullscreenControl: false
            });

            google.maps.event.trigger(map,'resize');
            var pos={'lat':22.6059,'lng':88.3968}
            map.setCenter(pos);


            map.mapTypes.set('styled_map', styledMapType);
            map.setMapTypeId('styled_map');
        }

        window.onload=function(){
            initMap();
        }
    </script>
@endsection