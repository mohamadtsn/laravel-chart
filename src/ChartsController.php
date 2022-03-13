<?php

namespace ConsoleTVs\Charts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;

class ChartsController extends BaseController
{
    public function __invoke(Request $request, ...$args)
    {
        return new JsonResponse(Arr::last($args)->handler($request)->toObject());
    }
}
