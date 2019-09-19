<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script>
    wx_share();
    function wx_share() { //也可以用立即执行函数
        var localURL =  location.href.split('#')[0];

        $.ajax({
            url: '{{ plugin_route("vote.api.weixin.share",['merchant'=>$merchant]) }}',//获取签名的接口
            data: {url: localURL,_token:"{{ csrf_token() }}"},
            type: 'post',
            success: function (res) {
                json=res.data;
                if (wx) {
                    wx.config({
                        debug: 0,
                        appId: json.appId,// 必填，公众号的唯一标识
                        timestamp: json.timestamp,// 必填，生成签名的时间戳
                        nonceStr: json.nonceStr,// 必填，生成签名的随机串
                        signature: json.signature,// 必填，签名，见附录1
                        jsApiList: [
                            'onMenuShareAppMessage', //1.0 分享到朋友
                            'onMenuShareTimeline', //1.0分享到朋友圈
                            'updateAppMessageShareData', //1.4 分享到朋友
                            'updateTimelineShareData', //1.4分享到朋友圈
                        ]
                    });
                    wx.ready(function () {

                        if (wx.onMenuShareAppMessage) { //微信文档中提到这两个接口即将弃用，故判断
                            wx.onMenuShareAppMessage(shareData);//1.0 分享到朋友
                            wx.onMenuShareTimeline(shareData);//1.0分享到朋友圈
                        } else {
                            wx.updateAppMessageShareData(shareData);//1.4 分享到朋友
                            wx.updateTimelineShareData(shareData);//1.4分享到朋友圈
                        }

                    });
                }

            }

        });
    }

</script>