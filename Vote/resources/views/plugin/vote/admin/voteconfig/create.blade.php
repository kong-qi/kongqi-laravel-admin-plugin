@extends('plugin.layout.baseDoing')
@section('add_css')

@endsection
@section('content')
    <div class="layui-form layui-form-kongqi" id="layuiadmin-form" id="layuiadmin-form">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ \Illuminate\Support\Str::random(40) }}">
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
        @include('plugin.tpl.form.text',[
            'data'=>[
                'name'=>'name',
                'title'=>'名称',
                'tips'=>'',
                'value'=>'',
                'rq'=>'rq'
        ]])
        @include('plugin.tpl.form.radio',[
           'data'=>[
               'name'=>'is_prize',
               'title'=>'参与后抽奖',
               'tips'=>'',
               'rq'=>'radio',
               'on_id'=>'0',
               'list'=>[
                    'type'=>'',
                    'data'=>$is_prize??[]
                ]
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
        @include('plugin.tpl.form.textarea',[
         'data'=>[
             'name'=>'tongji_script',
             'title'=>'统计/客服代码',
             'tips'=>'',
             'value'=>'',
             'rq'=>''
       ]])



        @include('plugin.tpl.form.submit')


    </div>
@endsection
@section('foot_js')
    <script>
        layui.use(['index'], function () {


        })
    </script>

@endsection