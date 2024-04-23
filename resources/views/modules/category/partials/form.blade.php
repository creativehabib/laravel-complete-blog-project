<div class="card">
    <div class="card-body">
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input 
                type="text" 
                value="{{old('name',$category->name ?? '')}}" 
                name="name"
                placeholder="Ex. category name"
                class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mb-3">
            <label for="name">Description</label>
            <textarea name="description" placeholder="Describe your category here..." class="form-control @error('description') is-invalid @enderror">{{old('description',$category->description ?? '')}}</textarea>
            @error('description')
                <div class="form-text text-danger"> {{$message}}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="image">Image Upload</label>
            <input 
                type="file" 
                value="{{old('cat_image', $category->cat_image ?? "")}}" 
                name="cat_image" 
                value="" class="form-control">
        </div>
    </div>
</div>