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
    @if ((Session::get('message') == "success add data") || (Session::get('message') == "success update data") || (Session::get('message') == "success delete data"))
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
        <h1 class="h3 mb-4 text-gray-800">Data Kategori</h1>
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
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($data as $category)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $category->category_identifier }}</td>
                                <td><?php echo $category->category_active_status == 1 ? "Aktif" : "Tidak Aktif"; ?></td>
                                <td>
                                    <button data-toggle="modal" data-target="#edit_modal{{ $category->category_id }}" class="btn btn-primary btn-sm" name="button">Edit</button>
                                    <a href="{{ route('category.delete', $category->category_id) }}" onclick="return confirm('Yakin ingin menghapus kategori ini ?');" class="btn btn-danger btn-sm" name="button">Hapus</a>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp

                            <div class="modal fade" id="edit_modal{{ $category->category_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{route('category.update')}}" method="POST" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Nama Kategori</label>
                                                    <input type="text" name="edit_identifier" id="edit_identifier" value="{{ $category->category_identifier }}" class="form-control">
                                                    <input type="hidden" name="edit_id" id="edit_id" value="{{ $category->category_id }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Status Kategori</label>
                                                    <select name="edit_status" class="form-control">
                                                        <option value="0" <?php echo $category->category_active_status == 0 ? "selected" : "";?>>Tidak Aktif</option>
                                                        <option value="1" <?php echo $category->category_active_status == 1 ? "selected" : "";?>>Aktif</option>
                                                    </select>
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
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              @csrf
              <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="category_identifier" id="category_identifier" class="form-control">
              </div>
              <div class="form-group">
                <label>Status Kategori</label>
                <select name="category_active_status" class="form-control">
                    <option value="0">Tidak Aktif</option>
                    <option value="1">Aktif</option>
                </select>
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
        $('#table_daily').DataTable({
            responsive: true,
            sDom: 'r<"H"lf><"datatable-scroll"t><"F"ip>',
        });
    });
</script>
@endsection
