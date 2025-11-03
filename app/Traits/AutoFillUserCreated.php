<?php

namespace App\Traits;

trait AutoFillUserCreated
{
    public static function bootAutoFillUserCreated()
    {
        static::creating(function ($model) {
            if (empty($model->user_created) && auth()->check()) {
                $model->user_created = auth()->user()->id;
            }
        });
    }
}
