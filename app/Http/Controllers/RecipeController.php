<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enum\SearchTypeEnum;

class RecipeController extends Controller
{
    const START_PAGE = 1;

    public function search(Request $request, SearchTypeEnum $searchType): array
    {
        $query = $request->get('search');
        //$page = $request->get('page') ?? self::START_PAGE;

        //$searchResults = Recipe::GetPage($searchType, $page, $query);

        return [
            'phrase' => $query,
            'type' => $searchType
        ];
    }
}
