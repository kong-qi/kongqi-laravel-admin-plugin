@extends('plugin.vote.layout.weui')
@section('add_css')
    <link rel="stylesheet" href="{{ plugin_res('/vote/front/vote/css/vote.css') }}">
@endsection
@section('content')
    <div class="container" style="padding: 10px;">


        <h2 style="text-align: center">{{ $vote_config->name }}</h2>
        <div class="vote-container">


            <div class="panel panel-default">
                {{-- <div class="panel-body" style="border-bottom: 1px solid #eaeaea;">
                     <h3>说明</h3>
                     <div>
                         {!! $content !!}
                     </div>
                 </div>--}}
                <div class="panel-body" style="margin-top: 60px">


                    <input type="hidden" name="openid" value="{{$openid}}">
                    <input type="hidden" name="token" value="{{$token}}">
                    <input type="hidden" name="vote_cofnig_id" value="{{ $vote_config->id }}">
                    {{ csrf_field() }}
                    @if(count($theme)>0)
                        <?php $index = 0;?>
                        @foreach($theme as $tkey=>$tv)



                            <h3 class="vote_title">{{ ($tkey+1) }}.{{ $tv['name'] }}
                                ({{ $tv['type_change']==2?'可多选':'单选' }})</h3>
                            <ul class="list-unstyled vote_option_list result_option" data-number="{{ ($tkey+1) }}">
                                @if(key_exists($tv['id'],$item))
                                    @foreach($item[$tv['id']] as $ikey=>$iv)

                                        <li class="vote_option rd rd{{$ikey}}"
                                            data-more="{{ $tv['type_change']==2?1:0 }}"
                                            data-item-id="{{ $iv['id'] }}">
                                            <label class="vote_option_title vote_option_title1">
                                                <span class="frm_option_word">{{ $iv['name'] }}</span>
                                            </label>
                                            <div class="vote_result">
                                                <span class="vote_result_meta tips vote_number">0票</span>
                                                <span class="vote_result_meta tips vote_percent">0%</span>
                                                <div class="vote_result_meta vote_graph">
                                                        <span style="width:0%;background-color:#7DADE1"
                                                              class="vote_progress"></span>
                                                </div>
                                            </div>
                                        </li>
                                        <?php $index++ ?>
                                    @endforeach
                                @endif


                            </ul>


                        @endforeach
                        <h3 class="vote_title">您的信息</h3>

                        <div class="weui-cells">
                            <div class="weui-cell">
                                <div class="weui-cell__bd">
                                    <input class="weui-input" type="text" placeholder="请输入姓名" id="username">
                                </div>
                            </div>
                        </div>
                        <div class="weui-cells">
                            <div class="weui-cell">
                                <div class="weui-cell__bd">
                                    <input class="weui-input" type="text" placeholder="请输入手机号码" id="mobile">
                                </div>
                            </div>
                        </div>
                        <div class="weui-cells">
                            <div class="weui-cell">
                                <div class="weui-cell__bd">
                                    <input class="weui-input" type="text" placeholder="请输入公司名称" id="company">
                                </div>
                            </div>
                        </div>
                        <div class="text-center" style="margin-top: 50px;margin-bottom: 20px">
                            <input type="button" class="btn btn_primary js_vote" value="投票">
                        </div>
                    @endif

                </div>


            </div>
        </div>
    </div>


@endsection
@section('foot_js')

    <script>

        //是否抽奖
        is_prize="{{ $vote_config->is_prize }}"
        $(".rd").click(function () {
            console.log('ssm');
            is_more = $(this).data('more');
            if (is_more) {
                $(this).toggleClass('acitve');
            } else {
                $(this).addClass('acitve').siblings('li').removeClass("acitve");
            }

        });
        var $loadingToast = $('#loadingToast');
        $(".js_vote").click(function () {
            //检查是否未选择
            var error = 0;
            $(".result_option").each(function () {
                var is_active = $(this).find('.acitve').length;
                var number = $(this).data('number');
                console.log(number);
                if (!is_active) {

                    var str = '第' + number + '题没有选择';
                    msg(str);
                    error = 1;
                    return false;


                }
            });
            if (error) {
                return false;
            }
            var items = [];
            $(".rd.acitve").each(function () {
                var item_id = $(this).data("item-id");
                items.push(item_id);
            })
            var mobile = $("#mobile").val();
            var company = $("#company").val();
            var username = $("#username").val();
            if (!company) {
                msg('公司不能为空');
                return false;
            }
            if (!username) {
                msg('姓名不能为空');
                return false;
            }
            if (!mobile) {
                msg('手机号码不能为空');
                return false;
            } else {
                //正则
                var phoneReg = /^1[3-578]\d{9}$/;
                if (!phoneReg.test(mobile)) {
                    msg('手机号码格式不正确');
                    return false;
                }
            }
            //提交AJAX
            $.ajax({
                url: '{{ plugin_route("vote.vote.index.post",['merchant'=>$merchant->id,'token'=>$token]) }}',
                method: 'post',
                data: {

                    _token: '{{ csrf_token() }}',
                    items: items,
                    openid: '{{ $openid }}',
                    user_id: '{{ $user['id'] }}',
                    phone: mobile,
                    username: username,
                    company: company


                },
                success: function (res) {
                    if (res.code == 200) {
                        if(is_prize==1)
                        {
                            toast('提交成功,即将进入抽奖');
                            setTimeout(function () {
                                var url = "{{ plugin_route('vote.active.index',['merchant'=>$merchant->id,'token'=>$token,'rel'=>'vote_'.$vote_config['id']]) }}"
                                window.location.href = url;
                            }, 2000)
                        }else
                        {

                            toast('提交成功，感谢您的参与');
                            setTimeout(function () {

                                window.location.reload();
                            }, 2000)
                        }

                    } else {
                        total('提交失败,请重设', 2)
                    }
                }
            })
        })

        shareData = {
            title: "{{ $wxshare['title'] }}",
            desc: "{{ $wxshare['desc'] }}",
            link: "{{ $wxshare['url'] }}",
            imgUrl: "{{ $wxshare['ico'] }}"
        };


    </script>
    @include('plugin.vote.front.api.weixinShare',['merchant'=>$merchant->id])
    <div style="display: none">
        {!! $vote_config->tongji_script !!}
    </div>

@endsection