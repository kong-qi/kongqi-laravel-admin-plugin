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
      @include('plugin.tpl.form.thumbPlace',['data'=>[
            'name'=>'thumb',
            'src'=>$show->thumb,
            'show'=>$show->thumb?1:'',
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