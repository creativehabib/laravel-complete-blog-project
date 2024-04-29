<?php

namespace App\Models;

use App\Models\Traits\CreatedAndUpdatedBy;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, CreatedAndUpdatedBy;
    protected $guarded = [];
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 2;

    public const STATUS_LIST = [
        self::STATUS_ACTIVE => 'Publish',
        self::STATUS_INACTIVE => "Not Publish"
    ];

    public const IMAGE_UPLOAD_PATH = 'uploads/media/';

    /**
     * @param Builder $builder
     * @return Builder
     */
    final public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('status', self::STATUS_ACTIVE);
    }

    /**
     * @return mixed
     */
    final public function get_category_assoc(): mixed
    {
        return self::query()->active()->pluck('name', 'id');
    }

    /**
     * @return LengthAwarePaginator
     */
    public function get_category_list(): LengthAwarePaginator
    {
        return self::query()->with('post')->paginate(5);
    }

    /**
     * @param Request $request
     * @return Builder|Model
     */
    public function storeCategory(Request $request): Model|Builder
    {
        return self::query()->create($this->prepareData($request));
    }

    /**
     * @param Request $request
     * @param Model $model
     * @return bool
     */
    public function update_category(Request $request, Model $model): bool
    {
        return $model->update($this->prepareData($request, $model));
    }

    /**
     * @param Model $model
     * @return void
     */
    public function delete_category(Model $model): void
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
     * @param Model|NULL $model
     * @return array
     */

    public function prepareData(Request $request, Model|NULL $model = null) :array
    {
        $data = [
                'name'          => $request->input('name'),
                'description'   => $request->input('description'),
                'slug'          => Str::slug($request->input('slug')),
                'status'        => $request->input('status'),

            ];
            if ($request->hasFile('cat_image')){
               if($model){
                    $destination = public_path(self::IMAGE_UPLOAD_PATH.$model->cat_image);
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
               }
                $file = $request->file('cat_image');
                $extension = $file->getClientOriginalExtension();
                $oldName = Str::slug(preg_replace('/\..+$/', '', $file->getClientOriginalName()));
                $filename = time().'-'.$oldName.'.'.$extension;
                $file->move(self::IMAGE_UPLOAD_PATH, $filename);
                $data['cat_image'] = $filename;
            }
            return $data;
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
     * @return MorphOne
     */
    public function meta() : morphOne
    {
        return $this->morphOne(Meta::class, 'metaable');
    }

    /**
     * @return HasMany
     */
    public function post(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
    }

}
