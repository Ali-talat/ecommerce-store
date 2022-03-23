<?php


namespace App\Http\Enumerations;

use Illuminate\Validation\Rules\Enum;

final class CategoryType extends Enum{
    const mainCat = 1 ;
    const supmainCat = 2 ;
}