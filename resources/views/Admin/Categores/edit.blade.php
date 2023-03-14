@extends('parent')

@section('title', 'Edit Category')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
            <form method="POST" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="user_name">Category Name</label>
                        <input type="text" class="form-control" name="name" id="user_name" placeholder="Enter Category Name" value="{{ old('name') ?? $category->name }}">
                    </div>

                    <div class="form-group">
                        <label for="user_email">Category Description</label>
                        <input type="text" class="form-control" name="Description" id="user_email" placeholder="Enter Category Description" value="{{ old('Description') ?? $category->Description }}">
                    </div>

                    <div class="form-group">
                        <label for="meating_time">Image</label>
                        <input type="file" class="form-control" id="meating_time" name="image"
                            placeholder="Image ">
                            <img style="width: 100px;  margin: 10px;" src="{{ $category->image  }}" alt="">

                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
