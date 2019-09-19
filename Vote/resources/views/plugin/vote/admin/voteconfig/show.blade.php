@extends('plugin.layout.baseDoing')
@section('add_css')
    <style>
        .vote-container {
            margin-top: 25px;
        }
        .vote_title {
            margin: 25px 14px 5px 0;
            font-size: 17px;
            line-height: normal;
            font-weight: normal;
        }
        .vote_option_list {
            /* li:after {
                  display: block;
                  content: " ";
                  height: 1px;
                  margin-left: 15px;
                  background-color: #eaeaea;
                  clear: both;
              } */
        }
        .vote_option_list li {
            position: relative;
            line-height: 1.6em;
            font-size: 12px;
        }
        .vote_option_list .vote_option_title {
            font-weight: 300;
            display: block;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            padding-top: 15px;
            padding-bottom: 15px;
            font-size: 14px;
            padding-right: 15px;
        }
        .vote_option_list .vote_option_title1 {
            padding-left: 36px;
            padding-right: 15px;
        }
        .vote_option_list .vote_option_title1:before {
            content: '';
            position: absolute;
            left: 14px;
            top: 50%;
            margin-top: -12px;
            width: 17px;
            height: 17px;
            vertical-align: middle;
            display: inline-block;
            background: transparent url('../images/radio.png?v=222') no-repeat 0 0;
            background-size: 17px auto;
        }
        .vote_option_list .noacitve .vote_option_title1:before {
            content: '';
            position: absolute;
            left: 14px;
            top: 50%;
            margin-top: -12px;
            width: 17px;
            height: 17px;
            vertical-align: middle;
            display: inline-block;
            background: transparent url('../images/radio_check.png') no-repeat 0 0;
            background-size: 17px auto;
        }
        .vote_option_list .acitve .vote_option_title1:before {
            content: '';
            position: absolute;
            left: 14px;
            top: 50%;
            margin-top: -12px;
            width: 17px;
            height: 17px;
            vertical-align: middle;
            display: inline-block;
            background: transparent url('../images/radio_check2.png?v=232') no-repeat 0 0;
            background-size: 17px auto;
        }
        .result_option .vote_option:after {
            display: block;
            content: " ";
            height: 1px;
            margin-left: 15px;
            background-color: #eaeaea;
            clear: both;
        }

        .vote_result {
            display: none;
            white-space: nowrap;
            color: #888;
            text-align: right;
        }
        .vote_result .vote_number {
            overflow: hidden;
            white-space: nowrap;
            word-wrap: normal;
        }
        .vote_result .vote_result_meta {
            display: block;
            vertical-align: top;
        }
        .vote_result .vote_progress {
            display: block;
            background-color: #dedede;
            height: 5px;
        }
        .vote_graph {
            background-color: #dedede;
        }
        .show{
            display: block;
        }

    </style>
@endsection
@section('content')
    @if(count($theme)>0)

        @foreach($theme as $tkey=>$tv)

            @php
            $theme_time=0;
            if(key_exists($tv['id'], $theme_result))
            {
                $theme_time=$theme_result[$tv['id']];
            }
            @endphp
            <div class="layui-card">
            <div class="layui-card-body" style="">
                <h3 class="vote_title">{{ ($tkey+1) }}.{{ $tv['name'] }}</h3>
                <ul class="list-unstyled vote_option_list ">
                    @if(key_exists($tv['id'],$item))
                        @foreach($item[$tv['id']] as $ikey=>$iv)
                            <?php
                            $item_time=0;
                            if(key_exists($iv['id'], $item_result))
                            {
                                $item_time=$item_result[$iv['id']];
                            }
                            $bf=0;
                            if($theme_time!=0)
                            {
                                $bf=round( ($item_time/$theme_time) * 100 , 2);
                            }



                            ?>
                            <li data-select="0" class="vote_option rd rd{{$ikey}}">
                                <label class="vote_option_title">
	    	 		  					    <span class="frm_option_word">{{ $iv['name'] }}

	    	 		  					    </span>
                                </label>
                                <div class="vote_result vote_result2 show layui-row">
                                    <div class="layui-col-xs6" style="padding-left: 0">
                                        <div class="vote_result_meta vote_graph">
                                            @if($bf!=0)
                                                <span style="width:{{$bf}}%;background-color:#7DADE1" class="vote_progress"></span>
                                            @else
                                                <span style="width:100%;" class="vote_progress"></span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="layui-col-xs4">
	    	 		  					    	<span class="vote_result_meta tips vote_number">
												{{ $item_time }}
                                                    票</span>
                                    </div>
                                    <div class="layui-col-xs2">

                                        <span class="vote_result_meta tips vote_percent">{{$bf}}%</span>
                                    </div>

                                </div>
                            </li>

                        @endforeach
                    @endif


                </ul>
            </div>
            </div>
        @endforeach

    @endif
@endsection
@section('foot_js')
    <script>
        layui.use(['index', 'uploader'], function () {


        })
    </script>

@endsection