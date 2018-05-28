@extends('layouts')
@section('page')

    <div class="page">
        <div class="gmap" id="gmap"></div>

        <button class="btn btn-primary" data-target="#examplePositionBottom" data-toggle="modal"
                type="button">Generate</button>

        <!-- Modal -->
        <div class="modal fade" id="examplePositionBottom" aria-hidden="true" aria-labelledby="examplePositionBottom"
             role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple modal-bottom">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        {{--<h4 class="modal-title">Modal Title</h4>--}}
                    </div>
                    <div class="modal-body">
                        <div class="card bg-white">
                            <div class="card-block p-30">
                                <a class="avatar avatar-100 float-left mr-20" href="javascript:void(0)">
                                    <img src="../../../global/portraits/13.jpg" alt="">
                                </a>
                                <div class="vertical-align text-left h-100 text-truncate">
                                    <div class="vertical-align-middle">
                                        <div class="font-size-20 mb-5 blue-600 text-truncate">Sarah Graves</div>
                                        <div class="font-size-14 text-truncate">Web Designer</div>
                                        <div class="font-size-14 text-truncate">Web Designer</div>
                                        <div class="font-size-14 text-truncate">Web Designer</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>--}}
                        {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
        <!-- End Modal -->
    </div>

    <?php
    $json = file_get_contents('https://geoip-db.com/json/');
    $obj = json_decode($json);
    $dlat=!empty($obj->latitude) ? $obj->latitude : '22.572646';
    $dlon=!empty($obj->longitude) ? $obj->longitude : '88.36389500000001';
    ?>
    <script>
        var map;
        function initMap() {

            var styledMapType = new google.maps.StyledMapType(
                [
                    {
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#f5f5f5"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#616161"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "color": "#f5f5f5"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.land_parcel",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#bdbdbd"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#eeeeee"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#757575"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#e5e5e5"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#757575"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#dadada"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#616161"
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "transit.line",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#e5e5e5"
                            }
                        ]
                    },
                    {
                        "featureType": "transit.station",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#eeeeee"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#c9c9c9"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                        ]
                    }
                ],
                {name: 'Styled Map'});

            map = new google.maps.Map(document.getElementById('gmap'), {
                zoom: 12,
                center: new google.maps.LatLng({!! $dlat !!}, {!! $dlon !!}),
                mapTypeId: 'roadmap',
                gestureHandling: 'greedy'
            });

            map.mapTypes.set('styled_map', styledMapType);
            map.setMapTypeId('styled_map');

            var icon = {
                'zoomSmall': "{{url('uploads')}}/map-icon.png", // url
                // scaledSize: new google.maps.Size(15, 15), // scaled size
                // origin: new google.maps.Point(0,0), // origin
                // anchor: new google.maps.Point(0, 0) // anchor
            };

            @if(isset($services) && !empty($services))
            @foreach($services as $service)
            var position=new google.maps.LatLng({{$service->latitude}}, {{$service->longitude}});
            var marker = new google.maps.Marker({
                position: position,
                // icon: icon,
                map: map
            });
            google.maps.event.addListener(marker, 'click', function () {
                alert('x');
            });
            @endforeach
            @endif
        }

        window.onload=function(){
            initMap();
        }
    </script>
@endsection