@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="">Post list</h4>
                <a href="{{route('post.create')}}"><button class="btn btn-outline-primary btn-sm">Create</button></a>
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
                    @forelse ($posts as $post )
                    <tr class="align-middle">
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$post->post_title}}</td>
                        <td>{{$post->post_description}}</td>
                        <td><img src="{{asset('uploads/media/'.$post->post_image)}}" alt="" class="img-thumbnail"></td>
                        <td>
                            <form method="POST" action="{{route('post.destroy',$post->id)}}">
                                <a href="{{route('post.show',$post->id)}}" class="btn btn-sm btn-info text-white"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{route('post.edit',$post->id)}}" class="btn btn-sm btn-primary text-white"><i class="fa-solid fa-pencil"></i></a>
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
            {{$posts->links()}}
        </div>
    </div>
</div>
@endsection