@extends('layouts.app')

@section('main')
<div class="main">
    <div class="flex wrap shops">
        @foreach($shops as $shop)
        <div class="shop-card">
            <img class="shop-card__img" src="{!! $shop->image_url !!}" alt="shop-img" />
            <div class="shop-card__content">
                <h2 class="shop-card__content__ttl">{{$shop->name}}</h2>
                <p class="shop-card__content__txt">
                    #{{$shop->area->name}}&nbsp;#{{$shop->genre->name}}
                </p>
                <div class="flex align-items-center">
                    <a class="shop-card__content__link" href="{!! '/detail/' . $shop->id !!}">
                        詳しくみる
                    </a>
                    @if( Auth::check() )
                    @if(count($shop->likes) == 0)
                    <form class="ml-a" method="POST" action="{{ route('like', ['shop_id' => $shop->id]) }}">
                        @csrf
                        <input class="shop-card__content__icon inactive" type="image" src="/img/unlike.png" alt="いいね" width="32px" height="32px">
                    </form>
                    @else
                    <form class="ml-a" method="POST" action="{{ route('unlike', ['shop_id' => $shop->id]) }}">
                        @csrf
                        <input class="shop-card__content__icon inactive" type="image" src="/img/like.png" alt="いいねを外す" width="32px" height="32px">
                    </form>
                    @endif
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection