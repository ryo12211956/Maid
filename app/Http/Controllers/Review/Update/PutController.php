<?php

namespace App\Http\Controllers\Review\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Review\UpdateRequest;
use App\Models\Review;
use App\Services\ReviewService;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
class PutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, ReviewService $reviewService)
    {
        if (!$reviewService->checkOwnReview($request->user()->id, $request->id()))
        {
            throw new AccessDeniedHttpException();
        }
        
        $review = Review::where('id', $request->id())->firstOrFail();
        $review->content = $request->review();
        $review->save();
        return redirect()->route('review.update.index', ['reviewId' => $review->id])->with('feedback.success', "レビューを編集しました。");
    }
}
