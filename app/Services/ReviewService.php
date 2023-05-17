<?php 

namespace App\Services;

use App\Models\Review;
use Carbon\Carbon;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Modules\ImageUpload\ImageManagerInterface;

class ReviewService 
{
    public function __construct(private ImageManagerInterface $imageManager)
    {}

    public function getReviews()
    {
        return Review::with('images')->orderBy('created_at', 'DESC')->get();
    }

    // 自分のreviewかどうかをチェックするメソッド
    public function checkOwnReview(int $userId, int $reviewId): bool
    {
        $review = Review::where('id', $reviewId)->first();
        if (!$review)
        {
            return false;
        }
        return $review->user_id === $userId;
    }

    public function countYesterdayReviews(): int
    {
        return Review::whereDate('created_at', '>=', Carbon::yesterday()->toDateTimeString())
            ->whereDate('created_at', '<', Carbon::today()->toDateTimeString())->count();
    }

    public function saveReview(int $userId, string $content, array $images)
    {
        DB::transaction(function () use ($userId, $content, $images) {
            $review = new Review;
            $review->user_id = $userId;
            $review->content = $content;
            $review->save();
            foreach ($images as $image)
            {
                $name = $this->imageManager->save($image);
                //Storage::putFile('public/images', $image);
                $imageModel = new Image();
                $imageModel->name = $name;
                // $imageModel->name = $image->hashName();
                $imageModel->save();
                $review->images()->attach($imageModel->id);
            }
        });
    }

    public function deleteReview(int $reviewId)
    {
        DB::transaction(function () use ($reviewId) {
            $review = Review::where('id', $reviewId)->firstOrFail();
            $review->images()->each(function ($image) use ($review){
                $this->imageManager->delete($image->name);
                // $filePath = 'public/images/' . $image->name;
                // if(Storage::exists($filePath)){
                //     Storage::delete($filePath);
                // }
                $review->images()->detach($image->id);
                $image->delete();
            });

            $review->delete();
        });
    }
}