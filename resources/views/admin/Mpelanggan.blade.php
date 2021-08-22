@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>List Data Pelanggan</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
        <div class="table-responsive">
          <button type="button" class="btn btn-primary dim" data-toggle="modal" data-target="#myModal4">
              <i class="fa fa-plus"></i> Tambah Data
          </button>
          <div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content animated fadeIn">
                      <div class="modal-header">
                          <h4 class="modal-title">Form Input Pelanggan</h4>
                      </div>
                      <div class="modal-body">
                        <form id="AddInput" class="form-horizontal">
                          {{ csrf_field() }}
                            <div class="form-group"><label class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="nama" id="nama" autocomplete="off">
                                  <span id="nameError" class="alert-message"></span>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Alamat</label>
                              <div class="col-sm-10">
                                <textarea class="form-control" name="alamat" id="alamat"></textarea> 
                                <span id="nameError" class="alert-message"></span>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                  <select class="form-control m-b" name="status" id="status">
                                      <option value="1">Aktif</option>
                                      <option value="0">Tidak Aktif</option>
                                  </select>
                                </div>
                            </div>
                        </form>
                      </div>
                      <div class="modal-footer" id="modal-footer">
                          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" name="save" id="save">Save changes</button>
                      </div>
                  </div>
              </div>
          </div>
          <table class="table table-striped table-bordered table-hover dataTables-example" >
          <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Edited by</th>
                <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            @if(!empty($data))
            @foreach($data as $pelanggan)
            <tr id="row_{{$pelanggan->id_pelanggan}}">
                <td>{{$no++}}</td>
                <td>{{$pelanggan->nama_pelanggan}}</td>
                <td>{{$pelanggan->alamat}}</td>
                @if($pelanggan->status = "1" )
                <td><span class="label label-primary">Aktif</span></td>
                @else
                <td><span class="label label-danger">Tidak aktif</span></td>
                @endif
                <td><span class="label label-info">{{$pelanggan->user->nama_user}}</span></td>
                <td>
                  <button type="submit" name="edit-{{$pelanggan->id_pelanggan}}" id="edit-{{$pelanggan->id_pelanggan}}" onclick="editPost(event)" data-id="{{$pelanggan->id_pelanggan}}" class="btn btn-info " ><i class="fa fa-paste"></i> Edit</button>
                  <button type="submit" name="delete" id="delete" data-id="{{$pelanggan->id_pelanggan}}" value="{{$pelanggan->id_pelanggan}}" class="btn btn-danger delete" > <i class="fa fa-trash"> Hapus</i></button>
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

  // delete
  $('.delete').on('click', function(){
    var id  = $(this).val();
    // console.log('id delete : ' + id);
    var APP_URL = {!! json_encode(url('')) !!}
    let _url = APP_URL + `/admin/deletePelanggan/${id}`;
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

    // edit
    function editPost(e) {
      var id  = $(e.target).data("id");
      console.log('id edit : ' + id);
      var APP_URL = {!! json_encode(url('')) !!}
      let _url = APP_URL + `/admin/editPelanggan/${id}`;
      $('#nameError').text('');
      $("#save").remove();
      $("#update").remove();
      $('#modal-footer').append('<button type="button" onclick="updatePost(event)" data-id="'+id+'" id="update" class="btn btn-primary">Update</button>');

      $.ajax({
        url: _url,
        type: "GET",
        success: function(response) {
          if(response){
            $('#nama').val(response.nama_pelanggan);
            $('#alamat').val(response.alamat);
            console.log(response.nama_pelanggan);
            $('#myModal4').modal('show');
          }
        }
      });
    }

    // update
    function updatePost(e){
      var id = $(e.target).data("id");
      var APP_URL = {!! json_encode(url('')) !!}
      let _url = APP_URL + `/admin/updatePelanggan/${id}`;

      var fd;
      fd = new FormData();
      fd.append('nama_pelanggan', $('#nama').val());
      fd.append('alamat', $('#alamat').val());
      fd.append('status', $('#status').val());
      fd.append('_token', '{{ csrf_token() }}');

      $.ajax({
        data: fd,
        url: _url,
        type: "POST",
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (data) {
          console.log(data);
            $('#AddInput').trigger("reset");
            $('#myModal4').modal('hide');
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
            toastr.success('Data Telah Terupdate!','SUKSES');
            location.reload();
            // table.draw();
        },
        error: function (data) {
            console.log('Error:', data);
            $('#myModal4').modal('hide');
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
            toastr.error('Data Gagal Terupdate!','ERROR');
        }
      });
    }

    $(document).ready(function() {
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

      //store
      $('#save').click(function () {
        var nama_pelanggan = $('#nama').val();
        var alamat = $('#alamat').val();
        var status = $('#status').val();
        var fd;
        fd = new FormData();
        // fd.append('id', $('#id').val());
        fd.append('nama_pelanggan', nama_pelanggan);
        fd.append('alamat', alamat);
        fd.append('status', status);
        fd.append('_token', '{{ csrf_token() }}');

        $.ajax({
          data: fd,
          url: "{{route('admin.storePelanggan')}}",
          type: "POST",
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function (response , data) {
              console.log(response.data);
              $('#AddInput').trigger("reset");
              $('#myModal4').modal('hide');
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
              toastr.success('Data Telah Tersimpan!','SUKSES');
              location.reload();
          },
          error: function (data) {
              console.log('Error:', data);
              console.log(alamat);
              $('#myModal4').modal('hide');
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
              toastr.error('Data Gagal Tersimpan!','ERROR');
          }
        });
      });

    });

</script>
@endsection
