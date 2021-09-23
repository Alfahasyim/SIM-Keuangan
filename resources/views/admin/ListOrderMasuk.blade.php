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
          <th>Customer PO Number</th> 
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
          @if(!empty($listordermasuk))
          @foreach ($listordermasuk as $item) 
          <tr id="row_{{$item->id}}">
            <td>{{$no++}}</td>
            <td>{{$item->tanggal_order}}</td>
            <td>{{$item->no_order}}</td> 
            <td>{{$item->cust_po_number}}</td> 
            <td>{{$item->pelanggan->nama_pelanggan}}</td>
            <td>{{$item->jenis_bayar}}</td>
            <td>Rp.{{number_format($item->biaya_operasional)}}</td>
            <td>{{$item->keterangan}}</td>
            <td>Rp.{{number_format($item->jumlah_total_harga_jual)}}</td>  
            <td>Rp.{{number_format($item->jumlah_total_harga_modal)}}</td>  
            <td>Rp.{{number_format($item->jumlah_total_laba_kotor)}}</td>  
            <td>Rp.{{number_format($item->jumlah_total_laba_bersih)}}</td>  
            <td>
              <a href="{{route('admin.ListOrderMasuk')}}/{{$item->id}}/LM" target="_blank" class="btn btn-info" >Laporan Masuk</a> 
              <a href="{{route('admin.ListOrderMasuk')}}/{{$item->id}}/LK" target="_blank" class="btn btn-info" >Laporan Keluar</i></a>
              <button type="submit" name="delete" id="delete" data-id="{{$item->id}}" value="{{$item->id}}" class="btn btn-danger delete" > <i class="fa fa-trash"> Hapus</i></button>
            </td> 
          </tr>
          @endforeach
          @endif
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
  // delete
  $('.delete').on('click', function(){
    var id  = $(this).val();
    // console.log('id delete : ' + id);
    var APP_URL = {!! json_encode(url('')) !!}
    let _url = APP_URL + `/admin/deleteListOrderMasuk/${id}`;
    let _token   = $('meta[name="csrf-token"]').attr('content');

    if (confirm("Hapus Data?")) {
        $.ajax({
          url: _url,
          type: 'GET',
          data: {
            _token: _token
          },
          success: function(response) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "progressBar": true,
                "positionClass": "toast-top-full-width",
                "onclick": null,
                "showDuration": "400",
                "hideDuration": "1000",
                "timeOut": "7000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              }
            toastr.success('Data Berhasil Dihapus!','SUKSES');
            $("#row_"+id).remove();
          }
        });
    }
    return false;

    });
  });
</script>
@endsection 