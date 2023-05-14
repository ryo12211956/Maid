@component('mail::message')

# 昨日は{{ $count }}件のつぶやきが追加されました！

{{ $toUser->name }}さんこんにちは！

昨日は{{ $count }}件のレビューが追加されましたよ！最新のレビューを見に行きましょう。

@component('mail::button', ['url' => route('review.index')])
    レビューを見に行く
@endcomponent

@endcomponent