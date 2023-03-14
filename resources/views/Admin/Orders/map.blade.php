@extends('parent')

@section('title', 'Meeting')
 
 
 @section('content')
 
    <section class="content">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
         <div class="container-fluid">
 
            <div class="row">
               
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div id="map" style="height: 50vh"></div>

                            {{-- <h3 class="card-title">Products Child</h3> --}}

                            {{-- <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
        
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>



<script>
    // Initialize and add the map
function initMap() {
  // The location of Uluru
  const uluru = { lat: {{ $order->lat}}, lng: {{ $order->lng }} };
  // The map, centered at Uluru
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 15,
    center: uluru,
  });
  // The marker, positioned at Uluru
  const marker = new google.maps.Marker({
    position: uluru,
    map: map,
  });
}

window.initMap = initMap;
</script>


    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmukI-EgJe4_WkKUcqUALROtw2olYUa2E&callback=initMap&v=weekly"
    defer
  ></script>

@endsection
