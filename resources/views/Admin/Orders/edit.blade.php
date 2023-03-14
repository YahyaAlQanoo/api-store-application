@extends('parent')
@section('title', 'Edit Product')
@section('page_name', 'Edit Product')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('orders.update',$order->id)}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                {{-- alert --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">&times;</button>
                                        <h5><i class="icon fas fa-ban"></i> Validate Errors!</h5>
                                        <ul>
                                            @foreach ($errors->all() as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif



                                
                                <div class="form-group mb-3">
                                    <label for="type">status</label>

                                    <select class="form-control mb-3" aria-label=".form-select-lg example" id="status" name="status" value="{{ old('status')}}">
                                        <option value="pending"  @selected($order->status == 'pending')  >pending</option>
                                        <option value="on_way"  @selected($order->status == 'on_way')>on_way</option>
                                        <option value="complete"  @selected($order->status == 'complete') >complete</option>
                                    </select>
                                 </div>
        
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
        </div>
    </section>
@endsection
