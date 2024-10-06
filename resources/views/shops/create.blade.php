@extends('layouts.dashboard-volt')
@section('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <style>
        #mapid {
            height: 60vmin;
            z-index: 10;
        }
    </style>
@endsection

@section('content')
@php
@endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 flex justify-center">
                <a href="{{ route('shops.index') }}" class="btn btn-secondary btn-sm mb-2">&larr; Back</a>
            </div>
            <div class="col-md-6 mb-2">
                <div class="card">
                    <div id="mapid"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('shops.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-row row">
                                    <div class="col-md-6 mb-2">
                                        <label for="">Longitude</label>
                                        <input type="text" name="lng" id="lng"
                                            class="form-control @error('lng') is-invalid @enderror"
                                            placeholder="lng" value="{{ old('lng') }}">
                                        @error('lng')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="">Latitude</label>
                                        <input type="text" name="lat" id="lat" value="{{ old('lat') }}"
                                            class="form-control @error('lat') is-invalid @enderror"
                                            placeholder="lat">
                                        @error('lat')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row row">
                                    <div class="col-md-6 mb-2">
                                        <label for="">Shop Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Shop name here..." value="{{ old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="">Address</label>
                                        <input type="text" name="address"
                                            class="form-control @error('address') is-invalid @enderror"
                                            placeholder="Address Description..." value="{{ old('address') }}">
                                        @error('address')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group float-right mt-4">
                                <button type="submit" class="btn btn-primary bg-black">Add Shop</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    
    <script>
        var mapCenter = [
            {{ config('leafletsetup.map_center_latitude') }},
            {{ config('leafletsetup.map_center_longitude') }}
        ];

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                mapCenter = [position.coords.latitude, position.coords.longitude];
                initMap(mapCenter);
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }


        var map = L.map('mapid').setView(mapCenter, {{ config('leafletsetup.zoom_level') }});
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker(mapCenter).addTo(map);

        function updateMarker(lat, lng) {
            marker
                .setLatLng([lat, lng])
                .bindPopup("Shop location :" + marker.getLatLng().toString())
                .openPopup();
            return false;
        };

        map.on('click', function(e) {
            let latitude = e.latlng.lat.toString().substring(0, 15);
            let longitude = e.latlng.lng.toString().substring(0, 15);
            $('#lat').val(latitude);
            $('#lng').val(longitude);
            updateMarker(latitude, longitude);
        });

        var updateMarkerByInputs = function() {
            return updateMarker($('#lat').val(), $('#lng').val());
        }
        $('#lat').on('input', updateMarkerByInputs);
        $('#lng').on('input', updateMarkerByInputs);
    </script>
@endpush
