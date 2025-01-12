@extends('layouts.app')

@section('main')
<div class="main">
    <div class="resend_form">
        <p>メール認証がまだ完了していない状態です。</p>
        <p>ご利用のメールソフトを確認して手続きを進めてください。</p>
        <p>メールが確認できない場合、下記のボタンから再度メールを送信することが可能です。</p>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit">認証メールを再送信</button>
        </form>
    </div>
</div>
@endsection