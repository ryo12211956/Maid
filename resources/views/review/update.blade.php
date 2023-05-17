<x-layout title="編集 | メイド喫茶ボード">
    <x-layout.single>
        <h2 class="text-center text-blue-500 text-4xl font-bold mt-8 mb-8">
            メイド喫茶ボード
        </h2>
        @php
            $breadcrumbs = [
                ['href' => route('review.index'), 'label' => 'TOP'],
                ['href' => '#', 'label' => '編集']
            ];
        @endphp
        <x-element.breadcrumbs :breadcrumbs="$breadcrumbs"></x-element.breadcrumbs>
        <x-review.form.put :review="$review"></x-review.form.put>
    </x-layout.single>
</x-layout>