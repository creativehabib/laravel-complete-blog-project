<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const IS_PUBLISH = 1;
    public const NOT_PUBLISH = 2;

    public const PUBLISH_STATUS = [
        self::IS_PUBLISH => 'Publish',
        self::NOT_PUBLISH => "Not Publish"
    ];

    public const IMAGE_UPLOAD_PATH = 'uploads/media/';

    final public function get_post_list()
    {
        return self::query()->paginate(2);
    }

    public function storePost(Request $request) 
    {
        return self::query()->create($this->prepareData($request));   
    }

    public function update_post(Request $request, Model $model) 
    {
        return $model->update($this->prepareData($request, $model));
    }

    public function prepareData(Request $request, Model|NULL $model = null) :array
    {
        $data = [
            'post_title'        => $request->input('post_title'),
            'post_description'  => $request->input('post_description'),
            'is_publish'        => $request->input('is_publish')
            
        ];
        if ($request->hasFile('post_image')){
           if($model){
                $destination = public_path(self::IMAGE_UPLOAD_PATH.$model->post_image);
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('post_image');
                $extension = $file->getClientOriginalExtension();
                $oldName = Str::slug(preg_replace('/\..+$/', '', $file->getClientOriginalName()));
                $filename = time().'-'.$oldName.'.'.$extension;
                $file->move(self::IMAGE_UPLOAD_PATH, $filename);
                $data['post_image'] = $filename;
           }else{
                $file = $request->file('post_image');
                $extension = $file->getClientOriginalExtension();
                $oldName = Str::slug(preg_replace('/\..+$/', '', $file->getClientOriginalName()));
                $filename = time().'-'.$oldName.'.'.$extension;
                $file->move(self::IMAGE_UPLOAD_PATH, $filename);
                $data['post_image'] = $filename;
           }
        //    return $data;
        }
        return $data;
    }

    final public function delete_post(Model $model){
        (new Meta())->delete_meta($model);
        if(!empty($model->post_image)){
            $imagePath = public_path('uploads/media/'.$model->post_image);
            if(File::exists($imagePath)){
                File::delete($imagePath);
            }
        }
        $model->delete();
    }

    public function meta() : morphOne
    {
        return $this->morphOne(Meta::class, 'metaable');
    }
}
