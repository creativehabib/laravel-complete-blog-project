<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const IMAGE_UPLOAD_PATH = 'uploads/media/';

    public function get_category_list(){
        return self::query()->paginate(2);
    }

    public function storeCategory(Request $request)
    {
        return self::query()->create($this->prepareData($request));
    }

    public function update_category(Request $request, Model $model)
    {
        return $model->update($this->prepareData($request, $model));    
    }

    public function delete_category(Model $model) 
    {
        (new Meta())->delete_meta($model);
        if(!empty($model->cat_image)){
            $imagePath = public_path('uploads/media/'.$model->cat_image);
            if(File::exists($imagePath)){
                File::delete($imagePath);
            }
        }
        $model->delete();
    }

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */

    public function prepareData(Request $request, Model|NULL $model = null) :array
    {
        $data = [
                'name'          => $request->input('name'),
                'description'   => $request->input('description'),
                
            ];
            if ($request->hasFile('cat_image')){
               if($model){
                    $destination = public_path(self::IMAGE_UPLOAD_PATH.$model->cat_image);
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('cat_image');
                    $extension = $file->getClientOriginalExtension();
                    $oldName = Str::slug(preg_replace('/\..+$/', '', $file->getClientOriginalName()));
                    $filename = time().'-'.$oldName.'.'.$extension;
                    $file->move(self::IMAGE_UPLOAD_PATH, $filename);
                    $data['cat_image'] = $filename;
               }else{
                    $file = $request->file('cat_image');
                    $extension = $file->getClientOriginalExtension();
                    $oldName = Str::slug(preg_replace('/\..+$/', '', $file->getClientOriginalName()));
                    $filename = time().'-'.$oldName.'.'.$extension;
                    $file->move(self::IMAGE_UPLOAD_PATH, $filename);
                    $data['cat_image'] = $filename;
               }
            //    return $data;
            }
            return $data;
    }



    public function meta() : morphOne
    {
        return $this->morphOne(Meta::class, 'metaable');
    }

}
