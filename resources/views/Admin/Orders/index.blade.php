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
                            <h3 class="card-title">Categoires</h3>

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
                                        <th>Client Name </th>
                                        <th>location</th>
                                        <th>total_price</th>
                                        <th>discount</th>
                                        <th>final_price</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $item)
                                        <tr class="font-weight-bold">
                                            <td><div>{{ $loop->index + 1 }}</div></td>
                                            <td><div>{{ $item->user_name }}</div></td>
                                             <td><div>{{ $item->location }}</div></td>
                                            <td><div>{{ $item->total_price }}</div></td>
                                            <td><div>{{ $item->discount ?? '0'  }}</div></td>
                                            <td><div>{{ $item->final_price ?? $item->total_price }}</div></td>
                                            <td><div>{{ $item->datetime }}</div></td>
                                            <td    > <span class="@if($item->status == 'pending') badge badge-sm badge-warning  @endif @if($item->status == 'on_way') badge badge-sm badge-success  @endif  @if($item->status == 'complete') badge badge-sm badge-primary  @endif">{{ $item->status }} </span></td>
                                             <td class="actions">
                                                <a class="btn btn-success btn-sm" href="{{ route('orders.show', $item->id) }}">Show</a>
                                                <a class="btn btn-success btn-sm" href="{{ route('points.show', $item->id) }}">Show Map</a>
                                                <a class="btn btn-warning btn-sm" href="{{ route('orders.edit', $item->id) }}">Change </a>
                                                <form style="    display: contents;" action="{{ route('orders.destroy', $item->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                        
                                        </tr>
                                    @endforeach
                                </tbody> 
                            </table>
                            <div class="px-5">{{ $orders->links() }}</div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
