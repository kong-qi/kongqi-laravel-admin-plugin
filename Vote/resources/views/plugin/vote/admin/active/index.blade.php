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
                , {field: 'wx_merchant_name', title: '所属公众号', width: 150}
                , {field: 'name', title: '名称'}
                , {field: 'prize_level', title: '抽奖等级', width: 100}
                , {field: 'start_at', title: '开始时间'}
                , {field: 'end_at', title: '结束时间'}
                , {title: '操作', minWidth: 350, align: 'center', toolbar: '#tpl-create-edit'}
            ]]
            //渲染
            listTable.render(listConfig.index_url, cols);
            //监听搜索
            listTable.search();


        });
    </script>
@endsection