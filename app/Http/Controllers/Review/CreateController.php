<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\Review\CreateRequest;
use App\Services\ReviewService;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateRequest $request, ReviewService $reviewService)
    {
        $reviewService->saveReview(
            $request->userId(),
            $request->review(),
            $request->images()
        );
        return redirect()->route('review.index');
    }
}
