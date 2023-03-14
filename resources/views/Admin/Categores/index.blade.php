@extends('parent')

@section('title', 'Meeting')
@section('style')
<style>
    .delete-btn{
        color: red;
        outline-width: 0px;
        outline-color: transparent;
        border-width: 0px;
        background-color: transparent;
        display: inline;
        padding: 0px
    }
    .actions{
        display: flex;
        flex-direction: row;
        column-gap: 5px;
    }

    .active{
        color: green;
    }

    .in-active{
        color: red;
    }
</style>
@endsection
@section('content')
    <section class="content">
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
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr class="font-weight-bold">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->Description }}</td>
                                            {{-- <td>{{ $item->image ?? 'not found' }}</td> --}}
                                            {{-- <td> <img width="80px" src="{{  asset('dist/img/avatar.png') }}" alt=""></td> --}}
                                            <td><div> <img width="80px" src="{{ $item->image  }}" alt=""></td>

                                            <td class="actions">
                                                <a href="{{ route('category.edit', $item->id) }}">Edit</a>
                                                <form action="{{ route('category.destroy', $item->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                  <button type="submit" class="delete-btn">Delete</button>
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
