@extends('parent')

@section('title', 'Meeting')
 
@section('style')
    <style>
        td ,th {
            max-width: 330px;
            min-width: 60px;
            /* height: auto; */
            text-align: left;
            word-wrap: break-word;
        }

        td div {
            height: 60px;
            overflow: auto;
            max-width: 270px;
            word-wrap: break-word;
        }    
        </style>

@endsection
 @section('content')
 
    <section class="content">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Products</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>category_name</th>
                                        <th>image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr class="font-weight-bold">
                                            <td><div>{{ $loop->index + 1 }}</div></td>
                                            <td><div>{{ $item->name }}</div></td>
                                            <td><div>{{ $item->Description }}</div></td>
                                            <td><div>{{ $item->category_name }}</div></td>
                                            <td><div> <img width="80px" src="{{ $item->image  }}" alt=""></td>
                                            <td class="actions">
                                                <a class="btn btn-success btn-sm" href="{{ route('products.show', $item->id) }}">Show</a>
                                                <a class="btn btn-warning btn-sm" href="{{ route('products.edit', $item->id) }}">Edit</a>
                                                <form style="    display: contents;" action="{{ route('products.destroy', $item->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                        
                                        </tr>
                                    @endforeach
                                </tbody> 
                            </table>
                            <div class="px-5">{{ $products->links() }}</div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
