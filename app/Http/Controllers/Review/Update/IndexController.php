<?php

namespace App\Http\Controllers\Review\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Services\ReviewService;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, ReviewService $reviewService)
    {
        $reviewId = (int) $request->route('reviewId');
        if (!$reviewService->checkOwnReview($request->user()->id, $reviewId)) 
        {
            throw new AccessDeniedHttpException();
        }
        
        $review = Review::where('id', $reviewId)->firstOrFail();
        return view('review.update')->with('review', $review);
    }
}
