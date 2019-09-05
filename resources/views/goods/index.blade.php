@extends('products.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 5.8 CRUD Barang</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('goods.create') }}"> Create New Barang</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Gambar</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($goods as $good)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $good->name }}</td>
            <td>{{ $good->harga }}</td>
            <td>{{ $good->kategori }}</td>
            <td>{{ $good->stok }}</td>
            <td>
            <img width="200px" src="{{ url('image/' .$good->gambar) }}" alt="">
            
            </td>

            <td>
                <form action="{{ route('goods.destroy',$good->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('goods.show',$good->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('goods.edit',$good->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $goods->links() !!}
      
@endsection