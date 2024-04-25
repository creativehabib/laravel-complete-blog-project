@extends('layouts.master')
@section('content')
<div class="col-md-12">
    <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="">Category list</h4>
                <a href="{{route('category.create')}}"><button class="btn btn-outline-primary btn-sm">Create</button></a>
            </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Serial</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col" style="width: 150px">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category )
                    <tr class="align-middle">
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$category->name}}</td>
                        <td>{{$category->description}}</td>
                        <td><img src="{{asset('uploads/media/'.$category->cat_image)}}" alt="" class="img-thumbnail"></td>
                        <td>
                            <form method="POST" action="{{route('category.destroy',$category->id)}}">
                                <a href="{{route('category.show',$category->id)}}" class="btn btn-sm btn-info text-white"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{route('category.edit',$category->id)}}" class="btn btn-sm btn-primary text-white"><i class="fa-solid fa-pencil"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger text-white" onclick="return confirm('Are you sure delete it?');"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="5" class="text-danger">No Data found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{$categories->links()}}
        </div>
    </div>
</div>
@endsection