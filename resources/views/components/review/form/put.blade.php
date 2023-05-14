@props([
    'review'
])
<div class="p-4">
    <form action="{{ route('review.update.put', ['reviewId' => $review->id]) }}" method="post">
        @method('PUT')
        @csrf
        @if (session('feedback.success'))
        <x-alert.success>{{ session('feedback.success') }}</x-alert.success>
        @endif
        <div class="mt-1">
            <textarea
                name="review"
                rows="3"
                class="focus:ring-blue-400 focus:border-blue-400 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
                placeholder="レビューを入力">{{ $review->content }}</textarea>
        </div>
        <p class="mt-2 text-sm text-gray-500">
            140文字まで
        </p>

        @error('review')
        <x-alert.error>{{ $message }}</x-alert.error>
        @enderror

        <div class="flex flex-wrap justify-end">
            <x-element.button>
                編集
            </x-element.button>
        </div>
    </form>
</div>
