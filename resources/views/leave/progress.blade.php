@extends('layouts.app')

@section('content')
    @include('users.partials.header', ['title' => __('Leave summary')])
    
    <div class="container-fluid mt--7 ">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0 ">
                <div class="card bg-white shadow ">
                    <div class="card-body">
                    <div id="columnchart3" style="height: 500px;"></div>
                    @can('isManager')
                    <div id="columnchart" style="height: 500px;"></div>
                    @endcan
                    @can('isAdmin')
                    <div id="columnchart2" style="height: 500px;"></div>
                    @endcan
                    
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    var sum=
      google.charts.load('current', {'packages':['bar','corechart']});
      //manager chart
      @can('isManager')
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable(<?php echo $sum; ?>);

        var options = {
          legend: {position: 'bottom', maxLines: 3},
          chart: {
            title: 'Leave summary of employees',
            subtitle: 'No of approved leaves of each employee', 
          },
          vAxis: {
            viewWindowMode:'explicit',
            format: '#.##',
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
      @endcan
      @can('isAdmin')
//admin chart
google.charts.setOnLoadCallback(drawChart2);

function drawChart2() {

  var data = google.visualization.arrayToDataTable(<?php echo $sum; ?>);

  var options = {
    legend: {position: 'bottom', maxLines: 3},
    chart: {
      title: 'Leave summary of employees',
      subtitle: 'No of approved leaves of each employee', 
    },
    vAxis: {
      viewWindowMode:'explicit',
      format: '#.##',
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
      @endcan
//employee chart
      google.charts.setOnLoadCallback(drawChart3);

function drawChart3() {

  var data = google.visualization.arrayToDataTable(<?php echo $sumA; ?>);

  var options = {
    legend: { position: 'top', alignment: 'start' },
    chart: {
      title: 'Your leave summary',
      subtitle: 'No of leaves per month', 
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