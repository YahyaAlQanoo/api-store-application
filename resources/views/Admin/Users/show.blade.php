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
                                        <th>total</th>
 
                                         <th>status</th>
                                        <th>date</th>
                                     </tr>
                                </thead>
                                <tbody>
                                    @foreach ($points as $item)
                                        <tr class="font-weight-bold">
                                            <td><div>{{ $loop->index + 1 }}</div></td>
                                            <td><div>{{ $item->total }}</div></td>
 
                                            <td><div><span class="@if ($item->status == 0 )
                                                badge badge-danger
                                            @endif @if ( $item->status == 1)
                                                badge badge-success
                                            @endif " >  {{ $item->status ? 'تم اضافة رصيد جديد'  :'تم استخدام الرصيد' }}  </span> </div></td>
                                            <td><div>{{ $item->created_at }}</div></td>
  
                            
                        
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="px-5">{{ $points->links() }}</div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
