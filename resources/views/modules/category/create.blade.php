@extends('layouts.master')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between header">
            <h4 class="">Category Create</h4>
            <a href="{{route('category.index')}}"><button class="btn btn-outline-primary btn-sm">List</button></a>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row mt-4">
                    <div class="col-md-8">
                        @include('modules.category.partials.form')
                    </div>
                    <div class="col-md-4">
                        @include('modules.global.meta', ['meta' => $category->meta ?? null])
                    </div>
                    <div class="mt-3 item-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection