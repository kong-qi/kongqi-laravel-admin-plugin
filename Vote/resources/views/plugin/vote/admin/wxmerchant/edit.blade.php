@extends('plugin.layout.baseDoing')
@section('add_css')

@endsection
@section('content')
    <div class="layui-form layui-form-kongqi" id="layuiadmin-form" id="layuiadmin-form">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

      @include('plugin.tpl.form.thumbPlace',[
         'data'=>[
             'name'=>'thumb',
             'src'=>$show->thumb?:"",
             'show'=>$show->thumb?:0,
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
                'value'=>$show->name,
                'rq'=>'rq'
        ]])
        @include('plugin.tpl.form.text',[
            'data'=>[
                'name'=>'app_id',
                'title'=>'AppId',
                'tips'=>'',
                'rq'=>'rq',
                'value'=>$show->app_id
        ]])
        @include('plugin.tpl.form.text',[
            'data'=>[
                'name'=>'app_secret',
                'title'=>'AppScret',
                'tips'=>'',
                'rq'=>'rq',
                'mark'=>'',
                'value'=>$show->app_secret
        ]])
        @include('plugin.tpl.form.text',[
            'data'=>[
                'name'=>'app_msgkey',
                'title'=>'消息加密串',
                'tips'=>'',
                'rq'=>'',
                'mark'=>'',
                'value'=>$show->app_msgkey
        ]])
        @include('plugin.tpl.form.text',[
         'data'=>[
             'name'=>'token',
             'title'=>'通信Token',
             'tips'=>'',
             'rq'=>'',
             'mark'=>'',
              'value'=>$show->token
     ]])
        @include('plugin.tpl.form.text',[
         'data'=>[
             'name'=>'token_url',
             'title'=>'通信地址',
             'tips'=>'',
             'rq'=>'',
             'mark'=>'',
              'value'=>$show->token_url
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