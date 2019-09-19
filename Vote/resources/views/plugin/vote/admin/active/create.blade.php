@extends('plugin.layout.baseDoing')
@section('add_css')

@endsection
@section('content')
    <div class="layui-form layui-form-kongqi" id="layuiadmin-form" id="layuiadmin-form">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ \EasyWeChat\Kernel\Support\Str::random(40) }}">

        <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
            <ul class="layui-tab-title">
                <li class="layui-this">基本配置</li>
                <li>关注设置</li>
                <li>抽奖设置</li>

            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    @include('plugin.tpl.form.select',[
                      'data'=>[
                          'name'=>'wx_merchant_id',
                          'title'=>'所属公众号',
                          'tips'=>'',
                          'value'=>'',
                          'on_id'=>'',
                          'rq'=>'rq',
                           'list'=>[
                                'type'=>'',
                                'data'=>$wx_merchant??[]
                            ]
                  ]])
                    @include('plugin.tpl.form.select',[
                      'data'=>[
                          'name'=>'type',
                          'title'=>'活动类型',
                          'tips'=>'',
                          'value'=>'',
                          'on_id'=>'dazhuanpan',
                          'rq'=>'rq',
                           'list'=>[
                                'type'=>'',
                                'data'=>$type??[]
                            ]
                  ]])
                    @include('plugin.tpl.form.select',[
                      'data'=>[
                          'name'=>'add_rel_type',
                          'title'=>'关联数据',
                          'tips'=>'',
                          'value'=>'',
                          'on_id'=>'',
                          'rq'=>'',
                           'list'=>[
                                'type'=>'',
                                'data'=>$rel_id??[]
                            ]
                  ]])


                    @include('plugin.tpl.form.text',[
                        'data'=>[
                            'name'=>'name',
                            'title'=>'名称',
                            'tips'=>'',
                            'value'=>'',
                            'rq'=>'rq'
                    ]])



                    @include('plugin.tpl.form.select',[
                         'data'=>[
                             'name'=>'day_number_type',
                             'title'=>'抽奖类型',
                             'tips'=>'',
                             'rq'=>'rq',
                             'mark'=>'',
                             'on_id'=>'10',
                             'list'=>[
                                  'type'=>'',
                                  'data'=>$prize_type
                             ]
                     ]])
                    @include('plugin.tpl.form.select',[
                       'data'=>[
                           'name'=>'prize_type',
                           'title'=>'奖品类型',
                           'tips'=>'',
                           'rq'=>'rq',
                           'mark'=>'',
                           'on_id'=>'1',
                           'list'=>[
                                'type'=>'',
                                'data'=>$prize_win_type
                           ]
                   ]])
                    @include('plugin.tpl.form.text',[
                      'data'=>[
                          'name'=>'day_number',
                          'title'=>'每天/一次抽奖次数',
                          'tips'=>'',
                          'value'=>'',
                          'rq'=>'rq',
                          'type'=>'number'
                  ]])
                    @include('plugin.tpl.form.date',[
                        'data'=>[
                            'name'=>'start_at',
                            'title'=>'开始时间',
                            'tips'=>'',
                            'rq'=>'rq',
                            'value'=>'',
                            'min'=>0
                    ]])
                    @include('plugin.tpl.form.date',[
                        'data'=>[
                            'name'=>'end_at',
                            'title'=>'结束时间',
                            'tips'=>'',
                            'rq'=>'rq',
                            'mark'=>'',
                             'min'=>2
                    ]])

                    @include('plugin.tpl.form.editor',[
                       'data'=>[
                           'name'=>'prize_msg',
                           'title'=>'奖品说明',
                           'tips'=>'',
                           'value'=>'',
                           'rq'=>'rq'
                   ]])
                    @include('plugin.tpl.form.editor',[
                       'data'=>[
                           'name'=>'intro_msg',
                           'title'=>'活动说明',
                           'tips'=>'',
                           'value'=>'',
                           'rq'=>'rq'
                   ]])
                    @include('plugin.tpl.form.textarea',[
                     'data'=>[
                         'name'=>'tongji_script',
                         'title'=>'统计/客服代码',
                         'tips'=>'',
                         'value'=>'',
                         'rq'=>''
                 ]])
                </div>
                <div class="layui-tab-item ">
                    @include('plugin.tpl.form.text',[
                     'data'=>[
                         'name'=>'fail_msg',
                         'title'=>'未中奖提示语',
                         'tips'=>'',
                         'rq'=>'rq',
                         'mark'=>'',
                         'value'=>'还没中奖哦，继续加油！'
                   ]])
                    @include('plugin.tpl.form.text',[
                    'data'=>[
                        'name'=>'over_msg',
                        'title'=>'抽奖次数用完提示语',
                        'tips'=>'',
                        'rq'=>'rq',
                        'mark'=>'',
                         'value'=>'抽奖次数用完，继续加油！'
                  ]])
                    @include('plugin.tpl.form.text',[
                    'data'=>[
                        'name'=>'end_msg',
                        'title'=>'活动结束提示语',
                        'tips'=>'',
                        'rq'=>'rq',
                        'mark'=>'',
                        'value'=>'活动结束！'

                  ]])
                    @include('plugin.tpl.form.text',[
                       'data'=>[
                           'name'=>'follow_msg',
                           'title'=>'引导关注微信公众号号提示语',
                           'tips'=>'',
                           'rq'=>'rq',
                           'mark'=>'',
                           'value'=>'为了方便领奖，请关注我们!'

                     ]])
                    @include('plugin.tpl.form.text',[
                      'data'=>[
                          'name'=>'wx_share_title',
                          'title'=>'分享标题',
                          'tips'=>'',
                          'rq'=>'',
                          'mark'=>''
                    ]])
                    @include('plugin.tpl.form.text',[
                     'data'=>[
                         'name'=>'wx_share_desc',
                         'title'=>'分享描述',
                         'tips'=>'',
                         'rq'=>'',
                         'mark'=>''
                    ]])
                    @include('plugin.tpl.form.thumbPlace',[
                     'data'=>[
                         'name'=>'wx_share_ico',
                         'src'=>'',
                         'show'=>0,
                         'title'=>'分享图标',
                         'tips'=>'',
                         'rq'=>'',
                         'place'=>1,
                         'obj'=>'thumbUpload'
                     ]])
                </div>
                <div class="layui-tab-item">
                    @include('plugin.tpl.form.select',[
                        'data'=>[
                            'name'=>'wx_share_desc',
                            'title'=>'中奖概率',
                            'tips'=>'',
                            'rq'=>'',
                            'mark'=>'',
                            'on_id'=>'10',
                            'list'=>[
                                 'type'=>'',
                                 'data'=>$ratio
                            ]
                    ]])
                    @include('plugin.tpl.form.select',[
                      'data'=>[
                          'name'=>'prize_level',
                          'title'=>'抽奖级别',
                          'tips'=>'',
                          'rq'=>'rq',
                          'mark'=>'',
                          'on_id'=>'10',
                          'filter'=>'prize_level',
                          'list'=>[
                               'type'=>'',
                               'data'=>$prize_level
                          ]
                  ]])

                    <div class="layui-form-item">
                        <label class="layui-form-label">抽奖设置 <span>概率全部综合加起来100%</span></label>
                        <div class="layui-input-block">
                            <div class="layui-row layui-col-space10	" id="prize_area">


                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>


        @include('plugin.tpl.form.submit')


    </div>
@endsection
@section('foot_js')
    @include('plugin.layout.editor.editor')

    <script>

        layui.use(['index', 'form'], function () {
            var form = layui.form;
            var $ = layui.$;
            form.on('select(prize_level)', function (data) {
                var value = data.value;

                var html_str = '';
                for (var i = 1; i <= value; i++) {
                    html_str += '<div class="layui-col-xs12 layui-col-sm4 "> <div class="layui-form-label" style="">' + i + '等奖奖品</div> <input lay-verify="rq2"  type="text" name="prizes[' + i + '][name]" placeholder="奖品名称" autocomplete="off" class="layui-input"> </div>';
                    html_str += ' <div class="layui-col-xs12  layui-col-sm4 "> <div class="layui-form-label" style="">数量</div> <input type="number" name="prizes[' + i + '][number]" lay-verify="rq2|number" placeholder="数量" autocomplete="off"class="layui-input"> </div>';
                    html_str += '<div class="layui-col-xs12  layui-col-sm4 "> <div class="layui-form-label" style="">概率</div> <input type="number" lay-verify="rq2" name="prizes[' + i + '][ratio]" placeholder="0-100之间，请输入数字" autocomplete="off"class="layui-input"> </div>';
                }
                $("#prize_area").empty().append(html_str);
                form.render();
            });

            editor("#prize_msg");
            editor("#intro_msg");


        })
    </script>

@endsection