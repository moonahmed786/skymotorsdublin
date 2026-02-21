<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

trait Auditable
{
    use SoftDeletes;

    public static function bootAuditable()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });

        static::deleting(function ($model) {
            if (in_array(SoftDeletes::class, class_uses($model))) {
                if (Auth::check()) {
                    $model->deleted_by = Auth::id();
                    $model->saveQuietly();
                }
            }
        });
    }
}
