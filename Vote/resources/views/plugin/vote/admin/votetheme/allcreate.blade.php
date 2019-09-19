@extends('plugin.layout.baseDoing')
@section('add_css')

@endsection
@section('content')
    <div class="layui-form layui-form-kongqi" id="layuiadmin-form" id="layuiadmin-form">
        {{ csrf_field() }}
        <input type="hidden" name="vote_config_id" value="{{ request()->input('vote_config_id') }}">

        @include('plugin.tpl.form.textarea',[
            'data'=>[
                'name'=>'name',
                'title'=>'名称',
                'tips'=>'回车一行一个',
                'value'=>'',
                'rq'=>'rq'
        ]])
        @include('plugin.tpl.form.select',[
          'data'=>[
              'name'=>'is_must',
              'title'=>'是否必选',
              'tips'=>'',
              'value'=>'',
              'rq'=>'rq',
              'on_id'=>1,
               'list'=>[
                    'type'=>'',
                    'data'=>[['id'=>1,'name'=>'必选'],['id'=>0,'name'=>'可选']]??[]
                ]
        ]])
        @include('plugin.tpl.form.select',[
          'data'=>[
              'name'=>'type_change',
              'title'=>'类型',
              'tips'=>'',
              'value'=>'',
              'rq'=>'rq',
              'on_id'=>1,
               'list'=>[
                    'type'=>'',
                    'data'=>[['id'=>1,'name'=>'单选'],['id'=>2,'name'=>'多选']]??[]
                ]
         ]])





        @include('plugin.tpl.form.submit')


    </div>
@endsection
@section('foot_js')
    <script>
        layui.use(['index', 'uploader'], function () {
            var uploader = layui.uploader;
            uploader.one("#thumbUpload");

        })
    </script>

@endsection