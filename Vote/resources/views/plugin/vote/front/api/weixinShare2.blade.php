<script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script>
    var wx_config =@json(wx_share($merchant,$wxshare['url'],false));

    wx.config({
        debug: true, // 请在上线前删除它
        appId: wx_config.appId,
        timestamp:wx_config.timestamp,
        nonceStr: wx_config.nonceStr,
        signature: wx_config.signature,
        jsApiList: ['updateAppMessageShareData', 'updateTimelineShareData']
    });
    wx.ready(function () {
        //分享按钮
        wx.updateAppMessageShareData({
            title: '{{ $wxshare['title'] }}', // 分享标题
            desc: '{{ $wxshare["desc"] }}', // 分享描述
            link: '{{ $wxshare['url'] }}', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: '{{ $wxshare["ico"] }}', // 分享图标
            success: function () {
                // 设置成功
            }
        })
        //朋友圈
        wx.updateTimelineShareData({
            title: '{{ $wxshare['title'] }}', // 分享标题
            link: '{{ $wxshare['url'] }}', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: '{{ $wxshare["ico"] }}', // 分享图标
            success: function () {
                // 设置成功
            }
        })

    });

</script>