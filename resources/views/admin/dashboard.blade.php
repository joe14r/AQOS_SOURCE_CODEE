@extends('layouts.admin')
@section('content')
<section class="dashboard-metrics">
    <div class="card">
        <h3>Total Orders</h3>
        <p>120</p>
    </div>
    <div class="card">
        <h3>New Orders Today</h3>
        <p>15</p>
    </div>
    <div class="card">
        <h3>Live Orders</h3>
        <p>5</p>
    </div>
</section>
<section class="chart">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
            </div>
        </div>
    </div>
    
</section>
@endsection
