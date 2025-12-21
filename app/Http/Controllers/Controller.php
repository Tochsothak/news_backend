<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponseTrait;
use Illuminate\Routing\Controller as LaravelController;


abstract class Controller extends LaravelController
{
    use ApiResponseTrait;
    //
}
