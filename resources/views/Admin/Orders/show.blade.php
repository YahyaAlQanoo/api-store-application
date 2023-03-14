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
                                        <th>product_name</th>
                                        <th>image</th>

                                        <th>price</th>
                                        <th>quantity</th>
                                        <th>total</th>
                                     </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders_item as $item)
                                        <tr class="font-weight-bold">
                                            <td><div>{{ $loop->index + 1 }}</div></td>
                                            <td><div>{{ $item->product_name }}</div></td>
                                            <td><div> <img width="80px" src="{{ Storage::url($item->image)   }}" alt=""></td>

                                            <td><div>{{ $item->price }}</div></td>
                                            <td><div>{{ $item->quantity }}</div></td>
                                            <td><div>{{ $item->quantity * $item->price }}</div></td>
 
                            
                        
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
