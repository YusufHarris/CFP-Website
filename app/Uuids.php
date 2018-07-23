<?php

namespace App;

use Webpatser\Uuid\Uuid;

trait Uuids
{
    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = strtoupper(Uuid::generate()->string);
        });

        static::saving(function ($model) {
            $orig_id = $model->get_Original(getKeyName());

            if ($orig_id !== $model->{$model->getKeyName()}) {
                $model->{$model->getKeyName()}  = $orig_id;
            }
        });
    }
}
