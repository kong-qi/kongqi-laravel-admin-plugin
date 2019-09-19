@extends('plugin.vote.layout.weui')
@section('add_css')
    <link rel="stylesheet" href="{{ plugin_res('/vote/front/active/dzp/css/active.css') }}">
    <style>
        html,
        body {
            width: 100%;
        }

        body {
            background-color: #d5471a;
            background-attachment: scroll;
            background-clip: border-box;
            background-origin: padding-box;
            background-size: 100%;
            display: block;
            height: 453px;
            background-repeat: no-repeat;
        }

        .game-dzp {
            width: 100%;
        }

        .game-dzp .game-intro,
        .game-dzp .game-change {
            width: 95%;
        }

        .game-dzp .game-dzp-area {
            width: 95%;
            margin: 0 auto;
            margin-top: 75px;
            position: relative;
        }

        .game-dzp .game-dzp-area .game-dzp-pane img {
            width: 100%;
        }

        .game-dzp .game-dzp-area .pointer {
            position: absolute;
            left: 50%;
            top: 50%;
            margin-top: -78px;
            margin-left: -40px;
        }

        .game-dzp .game-dzp-area .pointer img {
            width: 80px;
        }

        body {
            background-image: url('{{ picurl($tpl['bg']) }}') "
        }

        .game-intro .prize_list li .date {
            font-size: 12px;
            color: #999;
            float: right;
        }

        .user-warp {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            z-index: 10;

        }

        .user-mask {
            background: rgba(0, 0, 0, 0.4);
            height: 100%;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 2;
        }
    </style>
@endsection
@section('body')

    <body style="background-image:url('{{ picurl($tpl['bg']) }}')">
    @endsection
    @section('content')

        <div class="game-dzp">
            <div class="game-dzp-area">
                <div class="game-dzp-pane"><img src="{{ picurl($tpl['template']) }}" alt=""></div>
                <div class="pointer">
                    <img src="{{ picurl($tpl['css_guide']) }}" alt="" id="startbtn" data-click="0">
                </div>
            </div>

            <div class="game-change">
                <p>
                    您还有<span id="has_times">{{ $has_times }}</span> 次幸运转轮机会，快来试试手气。
                </p>
            </div>
            <div class="game-intro">
                <div class="intro-part prize-intro">
                    <h3 class="intro-title">
                        奖品设置
                    </h3>
                    <div class="intro-body">
                        {!! $prize_msg  !!}
                    </div>
                </div>
                <div class="intro-part active-intro">
                    <h3 class="intro-title">
                        活动说明
                    </h3>
                    <div class="intro-body">
                        {!! $intro_msg  !!}
                    </div>
                </div>
                <div class="intro-part win-intro">
                    <h3 class="intro-title">
                        我的奖品
                    </h3>
                    <div class="intro-body prize_list">

                        <ul>
                            <?php
                            $level_name = [
                                '1' => '一等奖',
                                '2' => '二等奖',
                                '3' => '三等奖',
                                '4' => '四等奖',
                                '5' => '五等奖',
                                '6' => '六等奖',
                                '7' => '七等奖',
                                '8' => '八等奖',
                                '9' => '九等奖',
                                '10' => '十等奖'
                            ];
                            ?>

                            @if(!empty($user_prize))
                                @foreach($user_prize as $k=>$v)
                                    <li><span>{{  $level_name[$v['level']] }}
                                            ：</span>{{ $v['prize'] }}

                                    </li>
                                @endforeach


                            @else
                                <li>还没有中奖哦</li>
                            @endif


                        </ul>
                    </div>
                </div>

                <div class="foot-btn-share">

                    <ul>
                        <li><a href="javascript:void(0)" class="wx_share_btn"
                               data-img="{{ plugin_res('/vote/front/active/images/share_wx_friend_area.png') }}"><img
                                        src="{{ plugin_res('/vote/front/active/images/friend.png') }}"
                                        alt="">分享到朋友圈</a></li>
                        <li><a href="javascript:void(0)" class="wx_share_btn"
                               data-img="{{ plugin_res('/vote/front/active/images/share_wx_friend.png') }}"><img
                                        src="{{ plugin_res('/vote/front/active/images/friend2.png') }}"
                                        alt="">分享给朋友</a></li>
                    </ul>
                </div>

            </div>

        </div>
        <div class="none" id="wx-focus">
            <div class="focus-wx">
                <div class="tips-msg">
                    {{ $config['follow_msg'] }}
                </div>
                <div class="tips-pic">
                    <img src="{{ picurl($merchant['thumb']) }}" alt="">
                    <p>按住识别二维码即可关注</p>
                </div>

            </div>
        </div>
        <div class="share-wx-box">
            <div class="share-wx-ico">

            </div>

            <div class="share-wx-bg"></div>
        </div>

        <div class="user-warp" style="display: none">
            <div class="weui-cells__title" style="font-size: 18px;text-align: center">请输入个人信息，方便领奖！</div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" id="username" type="text" placeholder="请输入姓名">
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" id="phone" type="text" placeholder="请输入手机">
                </div>
            </div>
            <div class="weui-btn-area">
                <a class="weui-btn weui-btn_primary" href="javascript:" id="doUserInfo">确定</a>
            </div>
        </div>
        <div class="user-mask" style="display: none"></div>

    @endsection
    @section('foot_js')
        <script type="text/javascript" src="{{ plugin_res('/vote/front/active/js/jQueryRotate.2.2.js') }}"></script>
        <script type="text/javascript" src="{{ plugin_res('/vote/front/active/js/jquery.easing.min.js') }}"></script>
        <script>
            get_play_msg = 1;
            user_phone = "{{ $user['phone']??'' }}";
            user_id = "{{ $user['id'] }}";
            var config = {
                is_end: '{{ $end }}',
                is_start: '{{ $start }}',
                over_msg: '{{ $config->over_msg }}',//机会抽完提示语
                fail_msg: '{{ $config->fail_msg }}',//未中奖提示语，
                end_msg: '{{ $config->end_msg }}',//活动已经结束语
                has_times: "{{ $has_times }}",//还有次数
                prize_type: '{{ $config->prize_type }}',//抽奖是否只是1次
            };

            shareData = {
                title: "{{ $wxshare['title'] }}",
                desc: "{{ $wxshare['desc'] }}",
                link: "{{ $wxshare['url'] }}",
                imgUrl: "{{ $wxshare['ico'] }}"
            };

            //分享
            $(".wx_share_btn").click(function () {
                $img = $(this).attr('data-img');
                $html_str = "<img src='" + $img + "' />";
                $(".share-wx-box").show();
                $(".share-wx-ico").empty().append($html_str);
            });
            $(".share-wx-bg,.share-wx-ico").click(function () {
                $(".share-wx-box").hide();
            });
        </script>
        <script>
            $("#startbtn").click(function () {
                lottery();
            })

            function lottery() {

                //抽奖机会用完
                if (config.has_times <= 0) {
                    $(document).dialog({
                        autoClose: 2500,
                        showTitle: false,
                        titleText: '提醒您！',
                        content: '<p>' + config.over_msg + '</p>'
                    });
                    return false;
                }
                if (config.is_end == 1) {
                    $(document).dialog({
                        autoClose: 2500,
                        showTitle: false,
                        titleText: '提醒您！',
                        content: '<p>' + config.end_msg + '</p>'
                    });
                    return false;
                }
                if (config.is_start == 0) {
                    $(document).dialog({
                        autoClose: 2500,
                        showTitle: false,
                        titleText: '提醒您！',
                        content: '<p>活动还没开始</p>'
                    });
                    return false;
                }


                $.ajax({
                    type: 'post',
                    url: '{{ plugin_route('vote.active.lottery',['merchant'=>$merchant->id,'token'=>$config->token,'rel'=>$rel]) }}',
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    cache: false,
                    async: false,
                    error: function () {
                        alert('超时');
                        return false;
                    },
                    success: function (res) {
                        json = res.data;
                        $("#startbtn").attr('data-click', 1);
                        var a = json.angle; //角度
                        var p = json.prize; //奖项
                        if (res.code != 200) {
                            $(document).dialog({
                                autoClose: 2500,
                                showTitle: false,
                                titleText: '提醒您！',
                                content: '<p>' + res.msg + '</p>'
                            });
                        } else {
                            $("#startbtn").rotate({
                                duration: 3000, //转动时间
                                angle: 0,
                                animateTo: 3600 + a, //转动角度
                                easing: $.easing.easeOutSine,
                                callback: function () {
                                    config.has_times--;
                                    setTimes();
                                    $("#startbtn").attr('data-click', 0);
                                    //中奖
                                    if (json.has_win == 1) {
                                        $(document).dialog({
                                            titleText: '恭喜您，中奖啦！',
                                            content: '<p>获得' + json.level_name + ':' + json.prize + '</p>',
                                            onClosed: function () {
                                                wx_fouce()
                                            }
                                        });

                                        $level_html = '<li><span>' + json.level_name + '：</span>' + json.prize + "<li>";
                                        if (config.prize_type == 2) {
                                            $(".prize_list ul").append($level_html);
                                        } else {
                                            $(".prize_list ul").empty().append($level_html);
                                        }


                                    } else {

                                        $(document).dialog({
                                            autoClose: 2500,
                                            showTitle: false,
                                            titleText: '未中奖！',
                                            content: '<p>' + config.fail_msg + '</p>'
                                        });
                                    }

                                }
                            });
                        }


                    }
                });
            }

            function setTimes() {
                $("#has_times").text(config.has_times);
            }

            function wx_fouce() {
                $(document).dialog({
                    showTitle: false,
                    buttonText: {
                        ok: '已关注',

                    },
                    onClickOk: function () {

                    },
                    onClickCancel: function () {

                    },
                    onClosed: function () {
                        if (user_phone == '') {
                            wx_push_user();
                        }
                    },
                    content: $("#wx-focus").html()
                });
            }

            //用户资料写入
            function wx_push_user() {

                $(".user-warp").show();
                $(".user-mask").show();

            }

            $(".user-mask").click(function () {
                $(".user-warp").hide();
                $(".user-mask").hide();
            });
            $("#doUserInfo").click(function () {
                wx_name = $("#username").val();
                wx_phone = $("#phone").val();
                user_name = wx_name;
                if (wx_name == '') {
                    msg('姓名不能为空');
                    return false
                }
                if (wx_phone == '') {
                    msg('手机不能为空');
                    return false
                }
                if (wx_phone != '') {
                    var reg = /^[1|3|4|6|7|8|9|5]{1}[0-9]{10}$/;
                    if (!reg.test(wx_phone)) {
                        msg('手机号码格式不正确');
                        return false
                    }
                }

                $.ajax({
                    'url': '{{ plugin_route("vote.active.userinfo",['merchant'=>$merchant->id,'token'=>$config->token,'rel'=>$rel]) }}',
                    type: 'post',
                    async: false,
                    data: {
                        'user_id': user_id,
                        '_token': '{{ csrf_token() }}',
                        'user_name': wx_name,
                        'user_phone': wx_phone
                    },
                    cache: false,
                    dataType: 'json',
                    beforeSend: function () {

                    },
                    success: function (data) {


                        if (data.code == 200) {
                            user_phone = wx_phone;
                            msg('信息提交成功');
                            $(".user-warp").hide();
                            $(".user-mask").hide();

                        }

                    }
                });
            })
        </script>

        <script>
            shareData = {
                title: "{{ $wxshare['title'] }}",
                desc: "{{ $wxshare['desc'] }}",
                link: "{{ $wxshare['url'] }}",
                imgUrl: "{{ $wxshare['ico'] }}"
            };
        </script>
    @include('plugin.vote.front.api.weixinShare',['merchant'=>$merchant->id,'debug'=>1])
        <div style="display: none">
            {!! $config->tongji_script !!}
        </div>
@endsection