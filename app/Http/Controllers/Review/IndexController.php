<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Services\ReviewService; //ReviewServiceのインポート
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\View\Factory;
use App\Models\Review;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, ReviewService $reviewService)
    {
        $reviews = $reviewService->getReviews();
        return view('review.index')
        ->with('reviews', $reviews);
    }
}
