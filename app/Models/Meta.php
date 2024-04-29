<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Meta extends Model
{
    use HasFactory;
    protected $guarded = [];
    public const IMAGE_UPLOAD_PATH = 'uploads/media/';

    /**
     * @param Request $request
     * @param Model $model
     * @return mixed
     */
    public function store_meta(Request $request, Model $model) :mixed
    {
        return $model->meta()->create($this->prepareData($request));
    }

    /**
     * @param Request $request
     * @param Model $model
     * @return mixed
     */
    public function update_meta(Request $request, Model $model) :mixed
    {
        // return $model->meta()->updateOrCreate(['id'=> $model?->meta?->id],$this->prepareData($request, $model));
        return $model->meta()->update($this->prepareData($request, $model));
    }

    /**
     * @param Request $request
     * @param Model|null $model
     * @return array
     */
    public function prepareData(Request $request, Model|null $model = null) :array
    {
        $data = [
            'meta_title'        => $request->input('meta_title'),
            'meta_description'  => $request->input('meta_description'),

        ];

        if ($request->hasFile('meta_image')){
            if($model && !empty($model?->meta?->meta_image)){
                $imagePath = public_path(self::IMAGE_UPLOAD_PATH.$model->meta->meta_image);
                if(File::exists($imagePath))
                {
                    File::delete($imagePath);
                }
            }
            $file = $request->file('meta_image');
            $extension = $file->getClientOriginalExtension();
            $oldName = Str::slug(preg_replace('/\..+$/', '', $file->getClientOriginalName()));
            $filename = time().'-'.$oldName.'.'.$extension;
            $file->move(self::IMAGE_UPLOAD_PATH, $filename);
            $data['meta_image'] = $filename;
        }
        return $data;
    }

    /**
     * @param Model $model
     * @return void
     */
    final public function delete_meta(Model $model): void
    {
        if(!empty($model->meta->meta_image)){
            $imagePath = public_path('uploads/media/'.$model->meta->meta_image);
            if(File::exists($imagePath)){
                File::delete($imagePath);
            }
        }
        $model->meta()->delete();
    }

    /**
     * @return MorphTo
     */
    public function metaable():MorphTo
    {
        return $this->morphTo();
    }
}
