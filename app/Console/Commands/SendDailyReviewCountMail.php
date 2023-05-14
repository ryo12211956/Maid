<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\DailyReviewCount;
use App\Models\User;
use App\Services\ReviewService;
use Illuminate\Contracts\Mail\Mailer;

class SendDailyReviewCountMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send-daily-review-count-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '前日のレビュー数を集計してレビューを促すメールを送ります。';

    private ReviewService $reviewService;
    private Mailer $mailer;

    /**
     * Create a new command instance.
     * 
     * @return void
     */
    public function __construct(ReviewService $reviewService, Mailer $mailer)
    {
        parent::__construct();
        $this->reviewService = $reviewService;
        $this->mailer = $mailer;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reviewCount = $this->reviewService->countYesterdayReviews();

        $users = User::get();

        foreach ($users as $user) 
        {
            $this->mailer->to($user->email)
                ->send(new DailyReviewCount($user, $reviewCount));
        }

        return 0;
    }
} 
