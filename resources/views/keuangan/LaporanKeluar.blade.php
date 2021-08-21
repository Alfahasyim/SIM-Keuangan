@extends('keuangan.index')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-8">
    <h2>Orderan</h2> 
  </div>
  <div class="col-lg-4">
    <div class="title-action">
      {{-- <a href="#" class="btn btn-white"><i class="fa fa-pencil"></i> Edit </a> --}}
      {{-- <a href="#" class="btn btn-white"><i class="fa fa-check "></i> Save </a> --}}
      <a href="{{route('keuangan.ListOrderMasuk')}}/{{$data_order->id}}/LK/Print" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print </a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="ibox-content p-xl">
        <div class="row">
          <div class="col-sm-6">
            <h5>From:</h5>
            <address>
              <strong>{{$data_order->pelanggan->nama_pelanggan}}</strong>
            </address>
          </div>

          <div class="col-sm-6 text-right">
            <h4>Order Number</h4>
            <h4 class="text-navy">{{$data_order->no_order}}</h4> 
            <p>
              <span><strong>Order Date:</strong>{{$data_order->tanggal_order}}</span><br/> 
            </p>
          </div>
        </div>

        <div class="table-responsive m-t">
          <table class="table invoice-table">
            <thead> 
					  <tr> 
					  	<th>Item List</th>
					  	<th>Quantity</th>
					  	<th>Unit Price</th>
					  	<th>Total</th> 
					  </tr>
            </thead>
            <tbody> 
            @foreach ($data_detail_order as $item)
				      <tr> 
				        <td>{{$item->barang->nama_barang}}</td> 
				        <td>{{$item->qty}}</td> 
				        <td>Rp.{{number_format($item->harga_jual_pcs)}}</td> 
				        <td>Rp.{{number_format($item->sub_total_harga_jual_pcs)}}</td>  
				      </tr>
				    @endforeach 
            </tbody>
          </table>
        </div><!-- /table-responsive -->

        <table class="table invoice-total">
          <tbody>
          <tr>
            <td><strong>Total :</strong></td>
            <td>Rp.{{number_format($data_order->jumlah_total_harga_jual)}}</td>
          </tr> 
          </tbody>
        </table>  
      </div>
    </div>
  </div>
</div>
  
@endsection