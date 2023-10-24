@include('admin.elements.header')

<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{$toDay}}</h3>
                  <p>Today(s)</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer d-none">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{$last7Day}}<sup style="font-size: 20px" class="d-none">%</sup></h3>
                  <p>Last 7 Days</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer d-none">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$last30Day}}</h3>
                  <p>Last 30 Days</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer d-none">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{$last365Day}}</h3>
                  <p>Last 365 Days</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer d-none">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- Small boxes (End box) -->

          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{$toDayUnique}}</h3>
                  <p>Today Unique(s)</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer d-none">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{$last7DayUnique}}<sup style="font-size: 20px" class="d-none">%</sup></h3>
                  <p>Last 7 Day Uniques</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer d-none">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$last30DayUnique}}</h3>
                  <p>Last 30 Day Uniques</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer d-none">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{$last365DayUnique}}</h3>
                  <p>Last 365 Day Uniques</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer d-none">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- Small boxes (End box) -->

          <div id="chartContainer" style="height: 300px; width: 100%;"></div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
  <script>
    //https://canvasjs.com/javascript-charts/line-chart-axis-scale-breaks/
    //https://canvasjs.com/php-charts/
    window.onload = function () {

    var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      title:{
        text: "Website Traffic"
      },
      axisX:{
        valueFormatString: "DD MMM"
      },
      axisY: {
        title: "Number of Visitors",
        scaleBreaks: {
          autoCalculate: true
        }
      },
      data: [{
        type: "line",
        xValueFormatString: "DD MMM",
        color: "#F08080",
        dataPoints: [
          { x: new Date(2017, 0, 1), y: 610 },
          { x: new Date(2017, 0, 2), y: 680 },
          { x: new Date(2017, 0, 3), y: 690 },
          { x: new Date(2017, 0, 4), y: 700 },
          { x: new Date(2017, 0, 5), y: 710 },
          { x: new Date(2017, 0, 6), y: 658 },
          { x: new Date(2017, 0, 7), y: 734 },
          { x: new Date(2017, 0, 8), y: 963 },
          { x: new Date(2017, 0, 9), y: 847 },
          { x: new Date(2017, 0, 10), y: 853 },
          { x: new Date(2017, 0, 11), y: 869 },
          { x: new Date(2017, 0, 12), y: 943 },
          { x: new Date(2017, 0, 13), y: 970 },
          { x: new Date(2017, 0, 14), y: 869 },
          { x: new Date(2017, 0, 15), y: 890 },
          { x: new Date(2017, 0, 16), y: 930 },
          { x: new Date(2017, 0, 17), y: 1850 },
          { x: new Date(2017, 0, 18), y: 1905 },
          { x: new Date(2017, 0, 19), y: 1980 },
          { x: new Date(2017, 0, 20), y: 1858 },
          { x: new Date(2017, 0, 21), y: 1034 },
          { x: new Date(2017, 0, 22), y: 963 },
          { x: new Date(2017, 0, 23), y: 847 },
          { x: new Date(2017, 0, 24), y: 853 },
          { x: new Date(2017, 0, 25), y: 869 },
          { x: new Date(2017, 0, 26), y: 943 },
          { x: new Date(2017, 0, 27), y: 970 },
          { x: new Date(2017, 0, 28), y: 869 },
          { x: new Date(2017, 0, 29), y: 890 },
          { x: new Date(2017, 0, 30), y: 930 },
          { x: new Date(2017, 0, 31), y: 750 }
        ]
      }]
    });
    chart.render();

    }
  </script>
    @include('admin.elements.footer')
