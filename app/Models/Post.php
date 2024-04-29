<?php

namespace App\Models;

use App\Models\Traits\CreatedAndUpdatedBy;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, CreatedAndUpdatedBy;
    protected $guarded = [];

    public const IS_PUBLISH = 1;
    public const NOT_PUBLISH = 2;

    public const PUBLISH_STATUS = [
        self::IS_PUBLISH => 'Publish',
        self::NOT_PUBLISH => "Not Publish"
    ];
    public const IMAGE_UPLOAD_PATH = 'uploads/media/';

    /**
     * @return LengthAwarePaginator
     */
    final public function get_post_list(): LengthAwarePaginator
    {
        return self::query()->paginate(5);
    }

    /**
     * @param Request $request
     * @return Builder|Model
     */
    public function storePost(Request $request): Model|Builder
    {
        return self::query()->create($this->prepareData($request));
    }

    /**
     * @param Request $request
     * @param Model $model
     * @return bool
     */
    public function update_post(Request $request, Model $model): bool
    {
        return $model->update($this->prepareData($request, $model));
    }

    /**
     * @return BelongsTo
     */
    final public function created_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    /**
     * @return BelongsTo
     */
    final public function updated_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    /**
     * @param Request $request
     * @param Model|NULL $model
     * @return array
     */
    public function prepareData(Request $request, Model|NULL $model = null) :array
    {
        $data = [
            'post_title'        => $request->input('post_title'),
            'post_slug'         => Str::slug($request->input('post_slug')),
            'post_description'  => $request->input('post_description'),
            'category_id'       => $request->input('category_id'),
            'is_publish'        => $request->input('is_publish')

        ];
        if ($request->hasFile('post_image')){
           if($model){
                $destination = public_path(self::IMAGE_UPLOAD_PATH.$model->post_image);
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
           }
            $file = $request->file('post_image');
            $extension = $file->getClientOriginalExtension();
            $oldName = Str::slug(preg_replace('/\..+$/', '', $file->getClientOriginalName()));
            $filename = time().'-'.$oldName.'.'.$extension;
            $file->move(self::IMAGE_UPLOAD_PATH, $filename);
            $data['post_image'] = $filename;
        }
        return $data;
    }

    /**
     * @param Model $model
     * @return void
     */
    final public function delete_post(Model $model): void
    {
        (new Meta())->delete_meta($model);
        if(!empty($model->post_image)){
            $imagePath = public_path('uploads/media/'.$model->post_image);
            if(File::exists($imagePath)){
                File::delete($imagePath);
            }
        }
        $model->delete();
    }

    /**
     * @return BelongsTo
     */
    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return MorphOne
     */
    public function meta() : morphOne
    {
        return $this->morphOne(Meta::class, 'metaable');
    }
}
