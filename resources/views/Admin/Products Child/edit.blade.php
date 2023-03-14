@extends('parent')
@section('title', 'Edit Product Child')
@section('page_name', 'Edit Product Child')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Product Child</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('products_child.update',$product->id)}}" enctype="multipart/form-data">
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
                                        placeholder="Products Name " value="{{ old('name',$product->name)}}">
                                </div>

                                <div class="form-group">
                                    <label for="meating_date">Products Description</label>
                                    <input type="text" class="form-control" id="meating_date" name="Description"
                                        placeholder="Products Description " value="{{ old('Description',$product->Description)}}" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1" class="form-label">Select The Product Parent</label>
                                    <select class="form-control" name="product_id" id="exampleFormControlSelect1">
                                        @foreach ($products as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="meating_date">Price</label>
                                    <input type="text" class="form-control" id="meating_date" name="price"
                                        placeholder="Products Price " value="{{ old('price',$product->price)}}">
                                </div>
                                <div class="form-group">
                                    <label for="meating_time">Image</label>
                                    <input type="file" class="form-control" id="meating_time" name="image"
                                        placeholder="Image "  >
                                        <img style="width: 100px;  margin: 10px;" src="{{ Storage::url($product->image)  }}" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="meating_date">Color</label>
                                    <input type="color" class="form-control" id="color" name="color"
                                        placeholder="Products Color " value="{{ old('color',$product->color)}}" >
                                </div>

                                <div class="form-group">
                                    <label for="size">Size</label>
                                    <input type="text" class="form-control" id="size" name="size"
                                        placeholder="Products Size " value="{{ old('size',$product->size)}}" >
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
