@extends('plugin.layout.baseDoing')
@section('add_css')

@endsection
@section('content')
    <div class="layui-form layui-form-kongqi" id="layuiadmin-form" id="layuiadmin-form">
        {{ csrf_field() }}
        <input type="hidden" name="vote_theme_id" value="{{ request()->input('vote_theme_id') }}">

        @include('plugin.tpl.form.textarea',[
            'data'=>[
                'name'=>'name',
                'title'=>'名称',
                'tips'=>'',
                'value'=>'',
                'rq'=>'rq'
        ]])
      @include('plugin.tpl.form.thumbPlace',[
           'data'=>[
               'name'=>'thumb',
               'src'=>'',
               'show'=>0,
               'title'=>'图片',
               'tips'=>'',
               'rq'=>'',
               'place'=>1,
               'obj'=>'thumbUpload'
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