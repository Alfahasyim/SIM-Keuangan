@extends('admin.index')
@section('content')
<div class="row">
  <div class="col-lg-12">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <h5>List Data Penjualan</h5>
      <div class="ibox-tools">
        <a class="collapse-link">
          <i class="fa fa-chevron-up"></i>
        </a>
      </div>
    </div>
    <div class="ibox-content">
    <div class="table-responsive">  
      <table class="table table-striped table-bordered table-hover dataTables-example">
        <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Nomor Order</th> 
          <th>Pelanggan</th>
          <th>Pembayaran</th>
          <th>Biaya Operasional</th>
          <th>Keterangan</th>
          <th>Total Harga Jual</th>  
          <th>Total Harga Modal</th>  
          <th>Total Laba Kotor</th>  
          <th>Total Laba Bersih</th>  
          <th>Opsi</th>  
        </tr>
        </thead>
        <tbody>
          @php
            $no=1;   
          @endphp
          @foreach ($listordermasuk as $item) 
          <tr>
            <td>{{$no++}}</td>
            <td>{{$item->tanggal_order}}</td>
            <td>{{$item->no_order}}</td> 
            <td>{{$item->pelanggan->nama_pelanggan}}</td>
            <td>{{$item->jenis_bayar}}</td>
            <td>{{$item->biaya_operasional}}</td>
            <td>{{$item->keterangan}}</td>
            <td>Rp.{{number_format($item->jumlah_total_harga_jual)}}</td>  
            <td>Rp.{{number_format($item->jumlah_total_harga_modal)}}</td>  
            <td>Rp.{{number_format($item->jumlah_total_laba_kotor)}}</td>  
            <td>Rp.{{number_format($item->jumlah_total_laba_bersih)}}</td>  
            <td>
              <a href="{{route('admin.ListOrderMasuk')}}/{{$item->id}}/LM" target="_blank" class="btn btn-info" >Laporan Masuk</a> 
              <a href="{{route('admin.ListOrderMasuk')}}/{{$item->id}}/LK" target="_blank" class="btn btn-info" >Laporan Keluar</i></a> 
              </button>
            </td> 
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    </div>
  </div>
</div>
</div> 
<script>
  $(document).ready(function () {
    //datatable
    $('.dataTables-example').DataTable({
        pageLength: 25,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
          { extend: 'copy'},
          {extend: 'csv'},
          {extend: 'excel', title: 'ExampleFile'},
          {extend: 'pdf', title: 'ExampleFile'},

          {extend: 'print',
            customize: function (win){
              $(win.document.body).addClass('white-bg');
              $(win.document.body).css('font-size', '10px');

              $(win.document.body).find('table')
                .addClass('compact')
                .css('font-size', 'inherit');
            }
          }
        ]

      });
  });
</script>
@endsection 