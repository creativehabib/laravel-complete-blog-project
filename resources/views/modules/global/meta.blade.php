<div class="card">
    <div class="card-body">
        <div class="form-group mb-3">
            <label for="name">Meta Title</label>
            <input type="text" name="meta_title" placeholder="Ex. Meta title here..." value="{{old('meta_title', $meta?->meta_title)}}" class="form-control @error('meta_title') is-invalid @enderror">
            @error('meta_title')
            <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="name">Meta Description</label>
            <textarea name="meta_description" placeholder="Ex. Meta description here..." class="form-control @error('meta_description') is-invalid @enderror">{{old('meta_description',$meta?->meta_description)}}</textarea>
            @error('meta_description')
            <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="meta_image">Image Upload</label>
            <input type="file" name="meta_image" value="{{old('meta_image', $meta?->meta_image)}}" id="meta_image" value="" class="form-control">
        </div>
    </div>
</div>