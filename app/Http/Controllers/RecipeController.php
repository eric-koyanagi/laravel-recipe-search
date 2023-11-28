<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enum\SearchTypeEnum;
use App\Models\Recipe;

class RecipeController extends Controller
{
    const RECIPES_PER_PAGE = 30;

    public function search(Request $request): array
    {
        $query = Recipe::BuildSearchQuery(
            $request->get('s') ?? "",
            $this->getSearchFlags($request)
        )->paginate(self::RECIPES_PER_PAGE);

        return [
            'results' => $query,
        ];
    }

    public function show(Request $request, $id): array
    {
        $recipe = Recipe::find($id);
        return [
            'recipe' => $recipe,
            'ingredients' => $recipe->ingredients,
            'steps' => $recipe->steps,
        ];
    }

    protected function getSearchFlags($request): array {
        $flags = [];
        $this->addToFlagsIfEnabled($flags, SearchTypeEnum::AuthorEmail->value, $request->get('authors'));
        $this->addToFlagsIfEnabled($flags, SearchTypeEnum::Keyword->value, $request->get('keywords'));
        $this->addToFlagsIfEnabled($flags, SearchTypeEnum::Ingredient->value, $request->get('ingredients'));
        return $flags;
    }

    protected function addToFlagsIfEnabled(&$arr, $key, $on) {
        if ($on === "1") {
            $arr[$key] = "1";
        }
    }
}
