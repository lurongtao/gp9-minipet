<?php
  include 'WechatJssdk.class.php';
  $appid = "wx2c1e562826be84b3";
  $appsecret = "9b2c552de9f5a46b292dfae241a91f8d";
  $jssdk = new WechatJssdk($appid,$appsecret);
  $signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>订阅号-拉勾网</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!-- <link rel="stylesheet" href="/course-webapp/prd/styles/usage/app@c85c6994fef3e5b5b3e5b4c0c3baf514.css"> -->
  <script>
      document.ontouchmove = function(e) {
          if (e.target.tagName.toUpperCase() !== 'IFRAME') {
              e.preventDefault();
          }
      };
  </script>
</head>
<body>
  <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
  <script>
    wx.config({
      debug: false,
      appId: "<?php echo $signPackage['appId']; ?>",
      timestamp: '<?php echo $signPackage["timestamp"]; ?>',
      nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
      signature: '<?php echo $signPackage["signature"]; ?>',
      jsApiList: [
        // 所有要调用的 API 都要加到这个列表中
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'chooseImage',
        'previewIoadImage',
        'downloadImage',
        'getNetworkType',
        'hideOptionMenu',
        'showOptionMenu',
        'hideMenuItems',
        'showMenuItems',
        'hideAllNonBaseMenuItem',
        'showAllNonBaseMenuItem',
        'closeWindow',
        'scanQRCode'
      ]
    });
  </script>
  <!-- <script src="/course-webapp/prd/scripts/app@dccafb81ccd96b1b30461ec2af466bee.js"></script> -->
  test
</body>
</html>
