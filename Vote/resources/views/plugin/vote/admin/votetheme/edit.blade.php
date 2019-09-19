@extends('plugin.layout.baseDoing')
@section('add_css')

@endsection
@section('content')
    <div class="layui-form layui-form-kongqi" id="layuiadmin-form" id="layuiadmin-form">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        @include('plugin.tpl.form.text',[
            'data'=>[
                'name'=>'name',
                'title'=>'名称',
                'tips'=>'',
                'value'=>$show->name,
                'rq'=>'rq'
        ]])
        @include('plugin.tpl.form.select',[
          'data'=>[
              'name'=>'is_must',
              'title'=>'是否必选',
              'tips'=>'',
              'value'=>$show->is_must,
              'rq'=>'rq',
              'on_id'=>$show->is_must,
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
              'value'=>$show->type_change,
              'rq'=>'rq',
              'on_id'=>$show->type_change,
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