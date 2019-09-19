@extends('plugin.layout.baseDoing')
@section('add_css')

@endsection
@section('content')
    <div class="layui-form layui-form-kongqi" id="layuiadmin-form" id="layuiadmin-form">
        {{ csrf_field() }}
        @include('plugin.tpl.form.thumbPlace',[
        'data'=>[
            'name'=>'thumb',
            'src'=>'',
            'show'=>0,
            'title'=>'公众号二维码',
            'tips'=>'',
            'rq'=>'',
            'place'=>1,
            'obj'=>'thumbUpload'
        ]])
        @include('plugin.tpl.form.text',[
            'data'=>[
                'name'=>'name',
                'title'=>'公众号名称',
                'tips'=>'',
                'value'=>'',
                'rq'=>'rq'
        ]])
        @include('plugin.tpl.form.text',[
            'data'=>[
                'name'=>'app_id',
                'title'=>'AppId',
                'tips'=>'',
                'rq'=>'rq',
                'value'=>''
        ]])
        @include('plugin.tpl.form.text',[
            'data'=>[
                'name'=>'app_secret',
                'title'=>'AppScret',
                'tips'=>'',
                'rq'=>'rq',
                'mark'=>''
        ]])
        @include('plugin.tpl.form.text',[
            'data'=>[
                'name'=>'app_msgkey',
                'title'=>'消息加密串',
                'tips'=>'',
                'rq'=>'',
                'mark'=>''
        ]])
        @include('plugin.tpl.form.text',[
         'data'=>[
             'name'=>'token',
             'title'=>'通信Token',
             'tips'=>'',
             'rq'=>'',
             'mark'=>''
     ]])
        @include('plugin.tpl.form.text',[
         'data'=>[
             'name'=>'token_url',
             'title'=>'通信地址',
             'tips'=>'',
             'rq'=>'',
             'mark'=>''
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