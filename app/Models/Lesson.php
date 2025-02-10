<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Lesson extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'module_id',
        'name',
        'title',
        'desc',
        'sort'
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Установим поле sort на максимальное значение + 1
            $model->sort = static::max('sort') + 1;
        });
    }



    public function test(): HasOne
    {
        return $this->hasOne(Test::class);
    }
}
