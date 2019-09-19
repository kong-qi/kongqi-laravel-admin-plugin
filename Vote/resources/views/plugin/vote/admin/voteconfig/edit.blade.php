@extends('plugin.layout.baseDoing')
@section('add_css')

@endsection
@section('content')
    <div class="layui-form layui-form-kongqi" id="layuiadmin-form" id="layuiadmin-form">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        @include('plugin.tpl.form.select',[
          'data'=>[
              'name'=>'wx_merchant_id',
              'title'=>'所属公众号',
              'tips'=>'',
              'value'=>'',
              'rq'=>'rq',
              'on_id'=>$show->wx_merchant_id,
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
                'value'=>$show->name,
                'rq'=>'rq'
        ]])
        @include('plugin.tpl.form.radio',[
          'data'=>[
              'name'=>'is_prize',
              'title'=>'参与后抽奖',
              'tips'=>'',
              'rq'=>'radio',
              'on_id'=>$show->is_prize,
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
                'min'=>0,
                 'value'=>$show->start_at
        ]])
        @include('plugin.tpl.form.date',[
            'data'=>[
                'name'=>'end_at',
                'title'=>'结束时间',
                'tips'=>'',
                'rq'=>'rq',
                'mark'=>'',
                 'min'=>2,
                 'value'=>$show->end_at
        ]])

        @include('plugin.tpl.form.text',[
         'data'=>[
             'name'=>'wx_share_title',
             'title'=>'分享标题',
             'tips'=>'',
             'rq'=>'',
             'mark'=>'',
             'value'=>$show->wx_share_title
     ]])
        @include('plugin.tpl.form.text',[
         'data'=>[
             'name'=>'wx_share_desc',
             'title'=>'分享描述',
             'tips'=>'',
             'value'=>$show->wx_share_desc,
             'rq'=>'',
             'mark'=>''
     ]])
        @include('plugin.tpl.form.thumbPlace',[
          'data'=>[
              'name'=>'wx_share_ico',
              'src'=>$show->wx_share_ico,
              'show'=>$show->wx_share_ico,
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
              'value'=>$show->tongji_script,
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