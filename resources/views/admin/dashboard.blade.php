@extends('admin.index')
@section('content')
<div class="row">
<div class="col-lg-12">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>Dashboard</h5>
            {{-- <div class="float-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-xs btn-white active">Today</button>
                    <button type="button" class="btn btn-xs btn-white">Monthly</button>
                    <button type="button" class="btn btn-xs btn-white">Annual</button>
                </div>
            </div> --}}
        </div>
        <div class="ibox-content">
          <div class="row"> 
            <div class="col-lg-12">
                <ul class="stat-list">
                  <li><h1>SELAMAT DATANG {{Auth::User()->nama_user}}</h1></li>
                  <li>
                      <h2 class="no-margins">Total Order : {{$total_order}}</h2> 
                  </li> <li>
                      <h2 class="no-margins">Total Pendapatan : Rp.{{number_format($order->sum('subtot_laba_bersih'))}}</h2> 
                  </li>  
                </ul>
            </div>
          </div>
        </div>
    </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        
    });
</script>
@endsection
