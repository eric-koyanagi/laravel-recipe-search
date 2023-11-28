<?php

namespace App\Models;

use App\Enum\SearchTypeEnum;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Traits\UniqueSlugTrait;
use Illuminate\Support\Facades\DB;

class Recipe extends Model
{
    use HasFactory;
    use UniqueSlugTrait;

    public static function BuildSearchQuery(string $searchPhrase, array $searchTypes): ?Builder
    {
        $query = DB::table('recipes')
            ->leftJoin('ingredients', 'recipes.id', '=', 'ingredients.recipe_id')
            ->leftJoin('steps', 'recipes.id', '=', 'steps.recipe_id')
            ->select('recipes.*')
            ->groupBy('recipes.id');

        foreach ($searchTypes as $searchType => $on) {
            $query = match ($searchType) {
                SearchTypeEnum::AuthorEmail->value => self::GetAuthorSearch($query, $searchPhrase),
                SearchTypeEnum::Keyword->value => self::GetKeywordSearch($query, $searchPhrase),
                SearchTypeEnum::Ingredient->value => self::GetIngredientSearch($query, $searchPhrase),
                default => $query,
            };
        }

        return $query;
    }

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }

    protected static function GetAuthorSearch(Builder $query, string $searchPhrase): Builder
    {
        return $query->where('recipes.author_email', $searchPhrase);
    }

    protected static function GetKeywordSearch(Builder $query, string $searchPhrase): Builder
    {
        return $query->where(function (Builder $query) use ($searchPhrase) {
            $query->where('recipes.name', $searchPhrase)
                ->orWhereFullText('recipes.description', $searchPhrase)
                ->orWhere('ingredients.name', 'LIKE', "%$searchPhrase%")
                ->orWhereFullText('steps.description', $searchPhrase);
        });
    }

    protected static function GetIngredientSearch(Builder $query, string $searchPhrase): Builder
    {
        return $query->orWhere('ingredients.name', 'LIKE', "%$searchPhrase%");

    }

}
