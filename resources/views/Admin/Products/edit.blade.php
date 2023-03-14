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
                        <form method="POST" action="{{ route('products.update',$product->id)}}" enctype="multipart/form-data">
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
                                <div class="form-group">
                                    <label for="meating_name">Products Name</label>
                                    <input type="text" class="form-control" id="meating_name" name="name"
                                        placeholder="Products Name "   value="{{ old('name',$product->name)}}"  >
                                </div>

                                <div class="form-group">
                                    <label for="meating_date">Products Description</label>
                                    <input type="text" class="form-control" id="meating_date" name="Description"
                                        placeholder="Products Description "  value="{{ old('Description',$product->Description)}}" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1" class="form-label">Select The Category</label>
                                    <select class="form-control" name="category_id" id="exampleFormControlSelect1">
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="meating_time">Image</label>
                                    <input type="file" class="form-control" id="meating_time" name="image"
                                        placeholder="Image "   >
                                        <img style="width: 100px;  margin: 10px;" src="{{ $product->image  }}" alt="">

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
