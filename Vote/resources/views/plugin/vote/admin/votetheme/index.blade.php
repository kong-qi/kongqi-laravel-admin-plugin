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

        layui.use(['index', 'listTable'], function () {
            var $ = layui.$
                , listTable = layui.listTable;

            cols = [[
                {type: 'checkbox'}
                , {field: 'id', width: 80, title: 'ID', sort: true}
                , {field: 'sort', width: 80,title: '排序',edit: 1}
                , {field: 'name', title: '名称', edit: 1}
                , {field: 'type_change_name', title: '类型'}
                , {field: 'is_must_name', title: '必填'}
                , {title: '操作', minWidth: 230, align: 'center', toolbar: '#tpl-create-edit'}
            ]]
            //渲染
            listTable.render(listConfig.index_url, cols);
            //监听搜索
            listTable.search();


        });
    </script>
@endsection