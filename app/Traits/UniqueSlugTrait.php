<?php

namespace App\Traits;
use Illuminate\Support\Str;

trait UniqueSlugTrait
{
    public static function bootUniqueSlugTrait(): void
    {
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = $model->generateUniqueSlug($model->name);
            }
        });
    }

    public function generateUniqueSlug(string $name, int $suffix = null): string
    {
        $slug = Str::slug($name . $suffix);

        // if my slug is already in use, assign a number after it and try again
        $existing = $this->where([
            ['slug', $slug],
            ['id', '!=', $this->id]
        ])->pluck('slug')->toArray();

        if (!empty($existing)) {
            $slug = $this->generateUniqueSlug($name, ($suffix ?? 0) + 1);
        }

        return $slug;
    }
}