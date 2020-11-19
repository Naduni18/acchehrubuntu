@extends('layouts.app')

@section('content')
    @include('users.partials.header', ['title' => __('Training progress')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-white shadow ">
                    <div class="card-body">
                    <div id="columnchart" ></div>
                    
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    
      google.charts.load('current', {'packages':['bar','corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable(<?php echo $sum; ?>);

        var options = {
          legend: {position: 'bottom', maxLines: 3},
          chart: {
            title: 'Training performance',
            subtitle: 'No of training sessions vs KPI of each employee', 
          },
          vAxis: {
            viewWindowMode:'explicit',
            format: '#',        
              viewWindow:{
                min:0
              }
          } ,
          hAxis: {
            viewWindowMode:'explicit',
              viewWindow:{
                
              }
          } ,

        };

        var chart = new google.charts.Bar(document.getElementById('columnchart'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

      
    </script>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')

    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

@endpush