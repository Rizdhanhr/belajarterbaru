<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ asset('font') }}/css/font-awesome.min.css">
    <title>Produk</title>
</head>
<body>
      @include('layouts.nav')
      
       <div class="container">
            <div class="row mt-4">
                <div class="col-lg-12 d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="text-primary">Data Produk<h4>
                    </div>
                    <div>
                        <button class="btn btn-primary" onclick="window.location.href='{{ route('produk.create') }}'" type="button">Tambah Produk</button>
                    </div>
                </div>
            </div>
        <hr>
        <div class="row">
          <div class="col-lg-12">
            <div class="main-content">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong>{{ $message }}</strong>
                </div>
               @endif
            <div class="table-container">
              <table id="table_produk" class="table table-striped table-bordered text-left">
                <thead>
                  <tr>
                    <th width="15%">Kode</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th width="5%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  @foreach($produk as $p)
                    <td>{{ $p->kode }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>Rp. {{ $p->harga }}</td>
                    <td>
                        <div class="form-button-action">
                            <button type="button"  onclick="window.location.href='{{ route('produk.edit',$p->id) }}'" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <form action="{{ route('produk.destroy',$p->id) }}"  method="POST">
                            @csrf
                            @method('DELETE')
                            </br>
                            <button type="submit" onclick="return confirm('apakah anda ingin menghapus data ini?')" class="btn  btn-danger btn-xs">
                                <i class="fa fa-trash"></i>
                            </button>
                            </form>
                        </div>
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
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script>
  $(document).ready( function () {
    $('#table_produk').DataTable();
} );
</script>
</html>