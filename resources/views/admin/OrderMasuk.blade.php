@extends('admin.index')
@section('content')
@if($errors->any())
  <div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    @foreach ($errors->all() as $message)
        {{$message}}
    @endforeach 
  </div>
@endif

@if ($message = Session::get('sukses'))
  <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong>{{ $message }}</strong>
  </div>
@endif

@if ($message = Session::get('gagal'))
  <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong>{{ $message }}</strong>
  </div>
@endif

<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h3>Form Order Masuk</h3>
          <div class="ibox-tools">
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
          </div>
        </div>
        <div class="ibox-content"> 
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control" disabled value="{{$no_order}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <input type="text" class="form-control" name="add_cust_po_number" id="add_cust_po_number" placeholder="Customer PO Number">
              </div>
            </div> 
            <div class="col-md-3"> 
              <div class="form-group">
                <div class="input-group">
                  <select data-placeholder="Cari Pelanggan" name="add_id_pelanggan" id="add_id_pelanggan" class="chosen-select" required>
                    <option value="">Pelanggan</option>
                    @foreach($pelanggan as $value)
                    <option value="{{$value['id_pelanggan']}}">{{ $value['nama_pelanggan'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <div class="input-group">
                  <select data-placeholder="" name="add_jenis_bayar" id="add_jenis_bayar" class="chosen-select">
                    <option value="">Jenis Pembayaran</option> 
                    <option value="Cash">Cash</option>
                    <option value="Tempo">Tempo</option> 
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-3"> 
              <div class="form-group">
                <input type="date" name="" class="form-control" id="add_tanggal_order" value="<?php echo date('Y-m-d'); ?>">
              </div>
            </div>
          </div>
          <div class="dropdown-divider"></div>
          <form id="AddInput">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group"><label class="control-label">Barang</label>
                <div class="input-group">
                    <select data-placeholder="Cari Barang" name="add_kode_barang" id="add_kode_barang" class="chosen-select">
                      <option value="">Kode / Nama Barang</option>
                      @foreach($barang as $item => $value)
                      <option value="{{$value->kode_barang}}" data-nama="{{ $value->nama_barang }}">{{$value->kode_barang}} {{ $value->nama_barang }}</option>
                      @endforeach
                    </select>
                </div>
                </div>
              </div> 
              <div class="col-md-3">
                <div class="form-group"><label class="control-label">Quantity</label>
                  <input type="number" name="" class="form-control" id="add_qty" placeholder="Qty" required >
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group"><label class="control-label">Harga/Pcs</label>
                  <div class="input-group">
                    <input type="number" name="" class="form-control" id="add_harga_jual_pcs" placeholder="Harga/Pcs" required >
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group"><label class="control-label">Modal/Pcs</label>
                  <div class="input-group">
                    <input type="number" name="" class="form-control" id="add_harga_modal_pcs" placeholder="Modal/Pcs" required >
                  </div>
                </div>
              </div>  
              <div class="col-md-3">
                <div class="form-group"><label class="control-label">Laba/Pcs</label>
                  <input type="number" name="" class="form-control" id="add_laba_pcs" placeholder="Laba/Pcs" disabled>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group"><label class="control-label">Total Harga</label>
                  <input type="number" name="" class="form-control" id="add_total" placeholder="Total Harga" disabled>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group"><label class="control-label">Total Modal</label>
                  <input type="number" name="" class="form-control" id="add_totalmodal" placeholder="Total Modal" disabled>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group"><label class="control-label">Total Laba</label>
                  <input type="number" name="" class="form-control" id="add_totallaba" placeholder="Total Laba" disabled>
                </div>
              </div>
            </div> 
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <button type="button" class="btn btn-primary btn-outline btn-block" id="addrow">
                    <i class="fa fa-plus"></i> Tambah Data
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
</div>
<!-- form tampil -->
<div class="row"> 
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-content">
      <form id="form-store" method="post" action="{{route('admin.storeOrderMasuk')}}" name="form-observasi">
        {{ csrf_field() }}
        <input type="hidden"  name="cust_po_number" id="cust_po_number"> 
        <input type="hidden" name="id_pelanggan" id="id_pelanggan"> 
        <input type="hidden" name="jenis_bayar" id="jenis_bayar"> 
        <input type="hidden" name="tanggal_order" id="tanggal_order" value="<?php echo date('Y-m-d'); ?>"> 
        <input type="hidden" name="grand_total" id="grand_total">
        <input type="hidden" name="grandtotalmodal" id="grandtotalmodal">
        <input type="hidden" name="grandtotallaba" id="grandtotallaba">  
        <div class="row">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dynamic_field">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Nama</th>
                  <th>Qty</th>
                  <th>Harga/PCS</th>
                  <th>Modal/PCS</th>
                  <th>Laba/PCS</th> 
                  <th>Total Harga</th> 
                  <th>Total Modal</th> 
                  <th>Total Laba</th> 
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row"> 
          <table> 
            <tr>
              <td><label for="">Biaya Operasional</label></td>
              <td><input type="number" class="form-control" name="biaya_operasional" id="biaya_operasional" required=""></td>
            </tr> 
            <tr>
              <td><label for="">Keterangan</label></td>
              <td><textarea class="form-control" name="keterangan" required=""></textarea></td>
            </tr> 
            <tr>
              <td><label for="">Total</label></td>
              <td><input type="number" class="form-control" name="add_grand_total" id="add_grand_total" disabled></td>
            </tr>
          </table>         
        </div>
          <br>
        <div class="row">
          <button type="submit" class="btn btn-success" id="simpan" name="button"><i class="fa fa-check"></i>Simpan</button> </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>  
  $(document).ready(function() { 
    var nama = $(this).find(':selected').attr('data-nama');
    $('span[id="title-required"]').css("color","red");
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

    $('#add_cust_po_number').keyup(function () {  
      var cust_po_number    = $(this).val(); 

      $('#cust_po_number').val(cust_po_number); 
    }); 

    $('#add_id_pelanggan').change(function () { 
      $('#id_pelanggan').val($(this).val());  
    });

    $('#add_jenis_bayar').change(function () { 
      $('#jenis_bayar').val($(this).val());
    }); 
    $('#add_tanggal_order').change(function () { 
      $('#tanggal_order').val($(this).val());
    }); 

    $('#add_harga_modal_pcs').keyup(function () {  
      var laba_pcs    =  $('#add_harga_jual_pcs').val() - $(this).val();
      var total_harga =  $('#add_harga_jual_pcs').val() * $('#add_qty').val();
      var total_modal =  $(this).val() * $('#add_qty').val();
      var total_laba  =  laba_pcs * $('#add_qty').val(); 

      $('#add_laba_pcs').val(laba_pcs);
      $('#add_total').val(total_harga);
      $('#add_totalmodal').val(total_modal);
      $('#add_totallaba').val(total_laba);
    });  

    var i=0;
    var no = 0;
    $('#addrow').click(function(){
      var sum = 0;
      var sum_modal = 0;
      var sum_laba = 0;
      jsonObj = [];
      var kode_barang           = $('#add_kode_barang').val();
      var nama_barang           = $('#add_kode_barang').find(':selected').attr('data-nama'); 
      var qty                   = $('#add_qty').val();
      var harga_jual_pcs        = $('#add_harga_jual_pcs').val();
      var harga_modal_pcs       = $('#add_harga_modal_pcs').val();
      var laba_pcs              = $('#add_laba_pcs').val(); 
      var total                 = $('#add_total').val();
      var total_modal           = $('#add_totalmodal').val();
      var total_laba            = $('#add_totallaba').val();

      var item                  = {}
      item ["kode_barang"]      = kode_barang;
      item ["nama_barang"]      = nama_barang;
      item ["qty"]              = qty; 
      item ["harga_jual_pcs"]   = harga_jual_pcs; 
      item ["harga_modal_pcs"]  = harga_modal_pcs; 
      item ["laba_pcs"]         = laba_pcs;  
      item ["total"]            = total;
      item ["total_modal"]      = total_modal;
      item ["total_laba"]       = total_laba;
      jsonObj.push(item);

      console.log(jsonObj);
      no++;
      i++;
      $('#dynamic_field').append(
        '<tr id="row'+i+'" class="dynamic-added">'+
          '<td>'+no+'</td>'+
          '<td><input type="hidden" name="kode_barang[]" id="kode_barang" value="'+kode_barang+'">'+kode_barang+'</td>'+
          '<td><input type="hidden" name="nama_barang[]" id="nama_barang" value="'+nama_barang+'">'+nama_barang+'</td>'+
          '<td><input type="hidden" name="qty[]" id="qty" value="'+qty+'">'+qty+'</td>'+
          '<td><input type="hidden" name="harga_jual_pcs[]" id="harga_jual_pcs" value="'+harga_jual_pcs+'">'+harga_jual_pcs+'</td>'+
          '<td><input type="hidden" name="harga_modal_pcs[]" id="harga_modal_pcs" value="'+harga_modal_pcs+'">'+harga_modal_pcs+'</td>'+
          '<td><input type="hidden" name="laba_pcs[]" id="laba_pcs" value="'+laba_pcs+'">'+laba_pcs+'</td>'+
          '<td><input type="hidden" name="total[]" id="total_'+i+'" value="'+total+'">'+total+'</td>'+
          '<td><input type="hidden" name="totalmodal[]" id="totalmodal_'+i+'" value="'+total_modal+'">'+total_modal+'</td>'+
          '<td><input type="hidden" name="totallaba[]" id="totallaba_'+i+'" value="'+total_laba+'">'+total_laba+'</td>'+
          '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_removes"><i class="fa fa-trash"></i></button></td>'+
        '</tr>'
      );   
      //penjumlahan otomatis total harga
      $("input[id*='total_']").each(function(){
        sum += +$(this).val();
      }); 
      $('#add_grand_total').val(Math.floor(sum));
      $('#grand_total').val(Math.floor(sum));

      //penjumlahan otomatis total modal
      $("input[id*='totalmodal_']").each(function(){
        sum_modal += +$(this).val();
      }); 
      $('#grandtotalmodal').val(Math.floor(sum_modal));

      //penjumlahan otomatis total laba kotor
      $("input[id*='totallaba_']").each(function(){
        sum_laba += +$(this).val();
      }); 
      $('#grandtotallaba').val(Math.floor(sum_laba));

      $('#add_kode_barang').val('').trigger('chosen:updated');
      $('#AddInput').trigger("reset");
    });

    $(document).on('click', '.btn_removes', function(){
      var button_id = $(this).attr("id");
      var total = $('#total_'+button_id+'').val();
      var now = $('#add_grand_total').val(); 

      var total_modal = $('#total_modal_'+button_id+'').val();
      var now_modal   = $('#total_modal').val(); 

      var total_laba  = $('#total_laba_'+button_id+'').val();
      var now_laba    = $('#total_laba').val(); 

      $('#add_grand_total').val(Math.floor(now - total));
      $('#grand_total').val(Math.floor(now - total));  
      $('#grandtotalmodal').val(Math.floor(now_modal - total_modal));  
      $('#grandtotallaba').val(Math.floor(now_laba - total_laba));  

      $('#row'+button_id+'').remove();
      no = no - $(this).length;
    });


  });
  // $('#biaya_operasional').keyup(function () {   
  //     var laba_kotor        =  $('#add_totallaba').val();
  //     var biaya_operasional =  $(this).val();

  //     console.log(laba_kotor);
  //     console.log(biaya_operasional);

  //     var laba_bersih = Math.floor(laba_kotor - biaya_operasional);

  //     $('#laba_bersih').val(laba_bersih);
  // }); 

  var config = {
    '.chosen-select'           : {},
    '.chosen-select-deselect'  : {allow_single_deselect : true},
    '.chosen-select-no-single' : {disable_search_threshold: 10},
    '.chosen-select-no-results': {no_results_text : 'Oops, nothing found!'},
    '.chosen-select-width'     : {width:"95%"}
  }
  for (var selector in config) {
      $(selector).chosen(config[selector]);
  }

</script>
@endsection
