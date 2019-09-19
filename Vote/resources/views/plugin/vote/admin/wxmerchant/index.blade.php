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
                , {field: 'thumb', title: '公众号二维码', width: 150, templet: '#tpl-user-thumb'}
                , {field: 'name', title: '公众号名称'}
                , {field: 'app_id', title: 'AppId',edit:1}
                , {field: 'app_secret', title: 'AppSecret',edit:1}
                , {title: '操作', width: 150, align: 'center', toolbar: '#tpl-create-edit'}
            ]]
            //渲染
            listTable.render(listConfig.index_url, cols);
            //监听搜索
            listTable.search();


        });
    </script>
@endsection