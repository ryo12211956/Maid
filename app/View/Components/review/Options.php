<?php

namespace App\View\Components\Review;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Options extends Component
{
    private int $reviewId;
    private int $userId;
    /**
     * Create a new component instance.
     */
    public function __construct(int $reviewId, int $userId)
    {
        $this->reviewId = $reviewId;
        $this->userId = $userId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.review.options')
        ->with('reviewId', $this->reviewId)
        ->with('myReview', \Illuminate\Support\Facades\Auth::id() === $this->userId);
    }
}
