<?php

namespace App\Models;

use App\Enum\SearchTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Traits\UniqueSlugTrait;

class Recipe extends Model
{
    use HasFactory;
    use UniqueSlugTrait;

    public static function GetPage(SearchTypeEnum $searchType, $page, $query) : array
    {

    }

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }
}
