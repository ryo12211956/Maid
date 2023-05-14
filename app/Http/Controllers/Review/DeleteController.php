<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Services\ReviewService;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class DeleteController extends Controller
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
        $reviewService->deleteReview($reviewId);
        return redirect()->route('review.index')->with('feedback.success', "レビューを削除しました。");
    }
}
