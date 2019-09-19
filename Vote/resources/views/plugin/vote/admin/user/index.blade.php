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
                {field: 'username', title: '姓名', minWidth: 100},
                {field: 'company', title: '公司', minWidth: 100},
                {field: 'nickname', title: '昵称', minWidth: 100}
                , {field: 'phone', title: '手机', minWidth: 140}

                , {field: 'created_at', title: '创建时间', width: 180}
                , {title: '操作', minWidth: 320, align: 'center', toolbar: '#tpl-create-no-edit'}
            ]]
            //渲染
            listTable.render(listConfig.index_url, cols);
            //监听搜索
            listTable.search();


        });
    </script>
@endsection