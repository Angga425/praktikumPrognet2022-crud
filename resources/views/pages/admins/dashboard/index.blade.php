@extends('layouts.admin')

@section('content')

<script src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
<script src="path/to/js/jquery-1.11.1.min.js"></script>
<script src="path/to/js/Chart.js"></script>
<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
<style>
    canvas {
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
    }
</style>

    <div class="card">
        <div class="card-body">
        <div id="collection_card" class="relative flex flex-wrap justify-center items-center min-h-[100vh]">
            <div class="box">
                <img src="/img/collections/shoes1.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <img src="/img/collections/shoes2.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <img src="/img/collections/shoes3.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <img src="/img/collections/shoes4.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <img src="/img/collections/shoes5.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <img src="/img/collections/shoes6.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <img src="/img/collections/shoes7.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <img src="/img/collections/shoes8.png" alt="Sepatu" class="shoes">
            </div>
        </div>
    </div>
</div>

<div class="grid-margin stretch-card pt-5">
        <div class="card">
            <div class="card-body">
            <div class=”graph”>
<canvas id=”canvas” height=”350″ width=”600″></canvas>
<script>
var barChartData = {
labels : [“January”,”February”,”March”,”April”,”May”,”June”,”July”],
datasets : [
{
fillColor : “rgba(9, 35, 78, 0.91)”,
strokeColor : “rgba(9, 35, 78, 0.91)”,
data : [65,59,90,81,56,55,40]
},
{
fillColor : “rgba(255, 137, 167, 0.78)”,
strokeColor : “rgba(255, 163, 186, 0.93)”,
data : [28,48,40,19,96,27,100]
}
]
}
var myLine = new Chart(document.getElementById(“canvas”).getContext(“2d”)).Bar(barChartData);
</script>
</div>
        </div>
      </div>
    </div>
    
    <div class="grid-margin stretch-card pt-5">
        <div class="card">
            <div class="card-body">
            <!-- OVERVIEW -->
            <div class="panel panel-headline">
                <div class="panel-heading ">
                    <p class="panel-subtitle" style="font-weight: bold">Periode: {{ date('d-m-Y H:m:s', strtotime($now)) }}</p>
                </div>
                
                <div class="panel-body mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="metric">
                                <span class="icon">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </span>
                                <p>
                                    <span class="number">{{ $monthlySales }}</span>
                                    <span class="title">Penjualan Bulanan</span>
                                </p>
                               
                                <div class="weekly-summary">
                                    <span class="number">Rp{{ number_format($incomeMonthly) }}</span>
                                    <span class="info-label">Pendapatan Bulanan</span>
                                </div>
                             
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                                <p>
                                    <span class="number">{{ $annualSales }}</span>
                                    <span class="title">Penjualan Tahunan</span>
                                    
                                </p>

                                <div class="weekly-summary ">
                                    <span class="number">Rp{{ number_format($incomeAnnual) }}</span>
                                    <span class="info-label">Pendapatan Tahunan</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-cart-plus" aria-hidden="true"></i>
                                </span>
                                <p>
                                    <span class="number">{{ $allSales }}</span>
                                    <span class="title">Total Penjualan</span>
                                </p>
                                <div class="weekly-summary">
                                    <span class="number">Rp{{ number_format($incomeTotal) }}</span>
                                    <span class="info-label">Total Pendapatan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OVERVIEW -->
                </div>
            </div>
        </div>
       
      </div>
    </div>


<script src="/js/vanilla-tilt.min.js"></script>
<script>
    VanillaTilt.init(document.querySelectorAll(".box"), {
        max: 25,
        speed: 400
    });
</script>
        </div>
    </div>
@endsection