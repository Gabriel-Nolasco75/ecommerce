<?php

namespace App\Http\Controllers\Api;

use App\Models\Cover;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SortController extends Controller
{
    public function covers(Request $request)
    {
        $sorts = $request->input('sorts');

        $order = 1;
        foreach ($sorts as $sort) {
            $cover = Cover::find($sort);
            $cover->order = $order;
            $cover->save();

            $order++;
        }
    }
}
