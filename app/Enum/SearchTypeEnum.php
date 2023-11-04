<?php

namespace App\Enum;

enum SearchTypeEnum: string {
    case AuthorEmail = 'author';
    case Keyword = 'keyword';
    case Ingredient = 'ingredient';
}