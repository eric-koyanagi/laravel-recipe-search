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
            $request->get('searchFlags') ?? []
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
}
