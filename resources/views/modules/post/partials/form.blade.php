<div class="card">
    <div class="card-body">
        <div class="form-group mb-3">
            <label for="post_title">Post Title</label>
            <input 
                type="text" 
                value="{{old('post_title',$post->post_title ?? '')}}" 
                name="post_title"
                placeholder="Ex. post title"
                class="form-control @error('post_title') is-invalid @enderror">
            @error('post_title')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="is_publish">Publish Status</label>
            <select name="is_publish"  class="form-select @error('is_publish') is-invalid @enderror">
                <option value="">Select</option>
                @foreach (\App\Models\Post::PUBLISH_STATUS as $key => $value)
                    <option value="{{$key}}" @selected(old('is_publish', $key == $post->is_publish ?? NULL))>{{$value}}</option>
                @endforeach
            </select>
            @error('is_publish')
                <div class="form-text text-danger"> {{$message}}</div>
            @enderror
        </div>
        
        <div class="form-group mb-3">
            <label for="post_description">Description</label>
            <textarea name="post_description" placeholder="Describe your post here..." class="form-control @error('post_description') is-invalid @enderror">{{old('post_description',$post->post_description ?? '')}}</textarea>
            @error('post_description')
                <div class="form-text text-danger"> {{$message}}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="post_image">Image Upload</label>
            <input 
                type="file"  
                name="post_image" 
                class="form-control">
        </div>
    </div>
</div>