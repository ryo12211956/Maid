<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Services\ReviewService;
use Mockery;
use App\Modules\ImageUpload\ImageManagerInterface;

class ReviewServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     * @runInSeparateProcess
     */
    public function test_check_own_review(): void
    {
        $mock = Mockery::mock('alias:App\Models\Review');
        $mock->shouldReceive('where->first')->andReturn((object)[
            'id' => 1,
            'user_id' => 1,
        ]);
        $imageManager = Mockery::mock(ImageManagerInterface::class);
        $reviewService = new ReviewService($imageManager);

        $result = $reviewService->checkOwnReview(1, 1);
        $this->assertTrue($result);

        $result = $reviewService->checkOwnReview(2, 1);
        $this->assertFalse($result);
    }
}
