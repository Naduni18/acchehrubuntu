@extends('layouts.app')

@section('content')
    @include('users.partials.header', ['title' => __('Attendance summary')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-white shadow ">
                    <div class="card-body">
                    <div id="columnchart1" >
                     </div>
                     </br></br>
                     <div id="columnchart2" >
                     </div>
                    </br></br>
                     <div id="columnchart3" >
                     </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar','corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable(<?php echo $sumYear; ?>);

        var options = {
          legend: {position: 'bottom', maxLines: 3},
          chart: {
            title: 'Monthly average attendance',
            subtitle: '(total no of employee present(absence) count in the month)/(no of days in the month*total no of employees)', 
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

        var chart = new google.charts.Bar(document.getElementById('columnchart1'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

      google.charts.setOnLoadCallback(drawChart1);

function drawChart1() {

  var data = google.visualization.arrayToDataTable(<?php echo $sumMonth; ?>);

  var options = {
    legend: {position: 'bottom', maxLines: 3},
    chart: {
      title: 'Daily attendance in current month',
      subtitle: 'daily attendance in current month per employee', 
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

  var chart = new google.charts.Bar(document.getElementById('columnchart2'));

  chart.draw(data, google.charts.Bar.convertOptions(options));
}
   google.charts.setOnLoadCallback(drawChart3);

      function drawChart3() {

        var data = google.visualization.arrayToDataTable(<?php echo $sumMonthall; ?>);

        var options = {
          legend: {position: 'bottom', maxLines: 3},
          chart: {
            title: 'daily total attendance',
            subtitle: 'total no of employees present at each date in the current month', 
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

        var chart = new google.charts.Bar(document.getElementById('columnchart3'));

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