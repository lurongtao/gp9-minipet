<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>footballSNS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="/Public/course-webapp/prd/styles/usage/app@3ba261ef40d9fdd2f61bfe48dd5a2c58.css">
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
    appId: "<?php echo ($signPackage['appId']); ?>",
    timestamp: '<?php echo ($signPackage["timestamp"]); ?>',
    nonceStr: '<?php echo ($signPackage["nonceStr"]); ?>',
    signature: '<?php echo ($signPackage["signature"]); ?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
      'onMenuShareTimeline',
      'onMenuShareAppMessage',
      'chooseImage',
      'previewImage',
      'uploadImage',
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
  <script src="/Public/course-webapp/prd/scripts/app@93a4852cd2a5491a44b5a753be1778e3.js"></script>
</body>
</html>