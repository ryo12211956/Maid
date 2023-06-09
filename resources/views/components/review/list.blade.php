@props([
    'reviews' => []
])
<div class="bg-white rounded-md shadow-lg mt-5 mb-5">
    <ul>
        @foreach ($reviews as $review)
        <li class="border-b last:border-b-0 border-gray-200 p-4 flex items-start justify-between">
            <div>
                <span class="inline-block rounded-full text-gray-600 bg-gray-100 px-2 py-1 text-xs mb-2">
                    {{ $review->user->name}}
                </span>
                <p class="text-gray-600">{!! nl2br(e($review->content)) !!}</p>
                <x-review.images :images="$review->images"/> 
            </div>
            <div>
                <!-- TODO 編集と削除 -->
                <x-review.options :reviewId="$review->id" :userId="$review->user_id"></x-review.options>
            </div>
        </li>
        @endforeach
    </ul>
</div>