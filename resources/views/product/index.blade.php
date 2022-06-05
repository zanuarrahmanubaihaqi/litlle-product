@extends('layouts.admin')

@section('css')
  <style media="screen">
  #table_daily {
    /* overflow-x: auto;
    overflow-y: visible; */
  }
  </style>
@endsection

@section('main-content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  @if (Session::has('message'))
    @if (Session::get('message') == "success add data")
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>
    @else
        <div class="alert alert-danger" role="alert">
            {{Session::get('message')}}
        </div>
    @endif
  @endif
    <!-- Page Heading -->
    <div class="row">
      <div class="col">
        <h1 class="h3 mb-4 text-gray-800">Data Produk</h1>
      </div>
      <div class="col">
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#add_modal" name="button">Tambah</button>
      </div>
    </div>

    <div class="row justify-content-center">

        <div class="col-lg-12">

            <div class="card shadow mb-4">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="table_daily">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Nama Gambar</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('user_management.update', 1)}}" method="get">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" value="">
                    </div>
                    <div class="form-group">
                    <label>E-Mail</label>
                    <input type="text" name="email" class="form-control" value="">
                    </div>
                    <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              @csrf
              <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="product_identifier" id="product_identifier" class="form-control">
              </div>
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" name="product_desc" id="product_desc" cols="30" rows="10"></textarea>
              </div>
              <div class="form-group">
                <label>Kategori</label>
                <select name="category[]" class="js-example-basic-multiple form-control" multiple="multiple" style="width: 200px;">
                    @foreach ($data_category as $dcat)
                        <option value="{{ $dcat->category_id }}">{{ $dcat->category_identifier }}</option>
                    @endforeach
                </select>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>Harga</label>
                    <input type="text" name="product_price" id="product_price" class="form-control">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Stok</label>
                    <input type="text" name="product_stock" id="product_stock" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="the_img" id="the_img" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready( function () {
        $('.js-example-basic-multiple').select2();
        var url = "{{ route('product.get-data') }}";
        $('#table_daily').DataTable({
            responsive: true,
            serverSide: true,
            sDom: 'r<"H"lf><"datatable-scroll"t><"F"ip>',
            ajax: {
                    "url": url,
                    "data": function(e) {
                        //
                    },
            
                },
            columns: [
                { "data" : "product_id" },
                { "data" : "product_identifier" },
                { "data" : "product_category" },
                { "data" : "product_image_name" }
            ]
        });
    });
</script>
@endsection
