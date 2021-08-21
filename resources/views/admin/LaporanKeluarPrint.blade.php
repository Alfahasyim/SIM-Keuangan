<!DOCTYPE html>
<html> 
<head> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>SIMANGAN | ORDER PRINT</title>

  <link href="{{asset('inspinia/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('inspinia/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

  <link href="{{asset('inspinia/css/animate.css')}}" rel="stylesheet">
  <link href="{{asset('inspinia/css/style.css')}}" rel="stylesheet"> 
</head>

<body class="white-bg"> 
	<center>
    <div>
      <img src="{{asset('../inspinia/images/kopsurat.png')}}" style="width:100%; background-image:none" alt="">
    </div>
  </center>
  <div class="wrapper wrapper-content p-xl">
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

<!-- Mainly scripts -->
<script src="{{asset('inspinia/js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('inspinia/js/bootstrap.min.js')}}"></script>
<script src="{{asset('inspinia/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('inspinia/js/inspinia.js')}}"></script>

<script type="text/javascript">
    window.print();
</script>

</body> 

</html>
