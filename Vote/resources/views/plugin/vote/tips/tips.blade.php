@extends('plugin.vote.layout.weui')
@section('content')
    <div class="page msg_warn js_show">
        <div class="weui-msg">
            <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
            <div class="weui-msg__text-area">
                <h2 class="weui-msg__title">{{ $message['title'] }}</h2>
                @if(isset($message['desc']))
                    <p class="weui-msg__desc">{{ $message['desc']??'' }}</p>
                @endif

            </div>
            @if(isset($message['btn']))
                @foreach($message['btn'] as $k=>$v)
                    <div class="button-sp-area" style="margin-bottom: 10px">
                        <a href="{{ $v['url'] }}" class="weui-btn weui-btn_primary">{{ $v['name'] }}</a>
                    </div>
                @endforeach
            @endif
            @if(isset($message['back']))
                @if(($message['back']))
                <div class="weui-msg__opr-area">
                    <p class="weui-btn-area">
                        <a href="javascript:history.back();" class="weui-btn weui-btn_default">返回</a>
                    </p>
                </div>
                @endif
            @endif
        </div>
    </div>
@endsection