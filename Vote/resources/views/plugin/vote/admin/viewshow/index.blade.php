@extends('plugin.layout.baseDoing')
@section('content')
    <div class="preview-wrap" style="background: #fff">
        <div class="phone">
            <div class="receiver"></div>
            <div class="screen" id="preview-intwrap">
                <iframe class="iframe" id="preview-iframe"
                        src="{{ $url }}" frameborder="0"></iframe>
            </div>
            <div class="iphone-preview"></div>

        </div>
        <div class=" qrcode">
            <div class="qrcode_content text-center ">
                <div class="qrocde-img">


                </div>

                <p class="mb-xs">
                    扫一扫手机查看
                </p>


            </div>
            <div class=" m-t-10">
                <p>链接地址：{{ $url }}</p>

            </div>

        </div>

    </div>
@endsection
@section('foot_js')

    <script src="{{ ___('/admin/js/jquery.min.js') }}"></script>
    <script src="{{ ___('/admin/js/jquery.qrcode.min.js') }}"></script>
    <script>
        $(".qrocde-img").qrcode({
            "size": 200,
            "color": "#3a3",
            "text": "{{ $url }}"
        });
    </script>
@endsection