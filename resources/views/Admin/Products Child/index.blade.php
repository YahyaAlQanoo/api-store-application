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
            <a href="{{ route('products_child.create')}}" class="btn btn-primary my-3"> Create ++ </a>

            <div class="row">
               
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Products Child</h3>

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

                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr class="font-weight-bold">
                                            <td><div>{{ $loop->index + 1 }}</div></td>
                                            <td><div>{{ $item->name }}</div></td>
                                            <td><div>{{ $item->Description }}</div></td>
                                            <td><div>{{ $item->price }}</div></td>
                                            <td><div> <img width="80px" src="{{ Storage::url($item->image)   }}" alt=""></td>

                                            <td><div>{{ $item->color }}</div></td>
                                            <td><div>{{ $item->size }}</div></td>
                                             <td class="actions">
                                                 <a class="btn btn-warning btn-sm" href="{{ route('products_child.edit', $item->id) }}">Edit</a>
                                                <form style="    display: contents;" action="{{ route('products_child.destroy', $item->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                        
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
