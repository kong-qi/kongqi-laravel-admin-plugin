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


                {field: 'name', title: '名称', minWidth: 100}
                , {field: 'phone', title: '手机', minWidth: 140}
                , {field: 'prize', title: '奖品名称', minWidth: 200}
                , {field: 'level', title: '奖品等级', minWidth: 200}
                , {field: 'created_at', title: '中奖时间', width: 180}
            ]]
            //渲染
            listTable.render(listConfig.index_url, cols);
            //监听搜索
            listTable.search();


        });
    </script>
@endsection