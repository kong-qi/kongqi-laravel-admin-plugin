@extends('plugin.layout.base')
@section('add_css')

@endsection
@section('content')
    @include('plugin.'.$controller_base_lower.'.form')
    @include('plugin.layout.table')
@endsection
@section('foot_js')
    @include('plugin.layout.ListConfig')
    <script>

        listConfig.index_url="{!!  plugin_url($controller_base,'getList',['vote_theme_id'=>request()->input('vote_theme_id')])  !!}"
        layui.use(['index', 'listTable'], function () {
            var $ = layui.$
                , listTable = layui.listTable;

            cols = [[
                {type: 'checkbox'}
                , {field: 'id', width: 80, title: 'ID', sort: true}
                , {field: 'sort', width: 80,title: '排序',edit: 1}
                , {field: 'name', title: '名称',edit: 1}
                , {field: 'thumb', title: '图片',  templet: '#tpl-user-thumb'}
                , {title: '操作', width: 180, align: 'center', toolbar: '#tpl-create-edit'}
            ]]
            //渲染
            listTable.render(listConfig.index_url, cols);
            //监听搜索
            listTable.search();


        });
    </script>
@endsection