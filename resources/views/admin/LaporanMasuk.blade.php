@extends('admin.index')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-8">
    <h2>Orderan</h2> 
  </div>
  <div class="col-lg-4">
    <div class="title-action">
      {{-- <a href="#" class="btn btn-white"><i class="fa fa-pencil"></i> Edit </a> --}}
      {{-- <a href="#" class="btn btn-white"><i class="fa fa-check "></i> Save </a> --}}
      <a href="{{route('admin.ListOrderMasuk')}}/{{$data_order->id}}/LM/Print" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print </a>
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
              <strong>{{$data_order->pelanggan->nama_pelanggan}}</strong><br>
              {{$data_order->pelanggan->alamat}}
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
          <table class="table invoice-table table-bordered">
            <thead>
            <tr> 
					  	<th colspan="4" class="text-center">Order Masuk</th> 
					  	<th colspan="2" class="text-center">Harga Modal</th> 
					  	<th colspan="2" class="text-center">Laba Kotor</th>   
					  </tr>
					  <tr> 
					  	<th>Nama</th>
					  	<th>Qty</th>
					  	<th>Harga</th>
					  	<th>Total</th>
					  	<th>Per pcs</th>
					  	<th>Total Modal</th>
					  	<th>Per pcs</th>
					  	<th>Total Laba</th> 
					  </tr>
            </thead>
            <tbody> 
            @foreach ($data_detail_order as $item)
				      <tr> 
				        <td>{{$item->barang->nama_barang}}</td> 
				        <td>{{$item->qty}}</td> 
				        <td>Rp.{{number_format($item->harga_jual_pcs)}}</td> 
				        <td>Rp.{{number_format($item->sub_total_harga_jual_pcs)}}</td> 
				        <td>Rp.{{number_format($item->harga_modal_pcs)}}</td> 
				        <td>Rp.{{number_format($item->sub_total_harga_modal_pcs)}}</td> 
				        <td>Rp.{{number_format($item->LabaPCS)}}</td> 
				        <td>Rp.{{number_format($item->sub_total_laba_kotor_pcs)}}</td>  
				      </tr>
				    @endforeach 
            </tbody>
          </table>
        </div><!-- /table-responsive -->

        <table class="table invoice-total">
          <tbody>
          <tr>
            <td><strong>Jumlah Total Harga Jual :</strong></td>
            <td>Rp.{{number_format($data_order->jumlah_total_harga_jual)}}</td>
          </tr>
          <tr>
            <td><strong>Jumlah Total Harga Modal :</strong></td>
            <td>Rp.{{number_format($data_order->jumlah_total_harga_modal)}}</td>
          </tr>
          <tr>
            <td><strong>Jumlah Total Laba Kotor :</strong></td>
            <td>Rp.{{number_format($data_order->jumlah_total_laba_kotor)}}</td>
          </tr>
          <tr>
            <td><strong>Biaya Operasional :</strong></td>
            <td>Rp.{{number_format($data_order->biaya_operasional)}}</td>
          </tr>
          <tr>
            <td><strong>Jumlah Total Laba Bersih :</strong></td>
            <td>Rp.{{number_format($data_order->jumlah_total_laba_bersih)}}</td>
          </tr>
          </tbody>
        </table> 

        <div class="well m-t"><strong>Keterangan : </strong>
           {{$data_order->keterangan}}
        </div>
      </div>
    </div>
  </div>
</div>
  
@endsection