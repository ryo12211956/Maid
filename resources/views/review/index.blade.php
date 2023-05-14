<x-layout title="TOP | メイド喫茶レビュー">
    <x-layout.single>
        <h2 class="text-center text-blue-500 text-4xl font-bold mt-8 mb-8">
            メイド喫茶レビュー
        </h2>
        <x-review.form.post></x-review.form.post>
        <x-review.list :reviews="$reviews"></x-review.list>
    </x-layout.single>
</x-layout>
