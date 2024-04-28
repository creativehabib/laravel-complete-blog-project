<?php
namespace App\Models\Traits;

trait CreatedAndUpdatedBy{
    /**
     * @return void
     */
    final public static function bootCreatedAndUpdatedBy(): void
    {
        static::creating(static function ($model) {
            $model->created_by_id = auth()->id();
        });

        static::updating(static function ($model) {
            $model->updated_by_id = auth()->id();
        });
    }
}
