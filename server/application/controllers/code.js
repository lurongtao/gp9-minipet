    onLoad: function() {
        wx.checkSession({
            success: Util.proxy(this.handleSessionSucc, this),
            fail: Util.proxy(this.handleSessionExpire, this)
        });
    },

    handleSessionSucc: function() {
        var openid = wx.getStorageSync('openid');
        if (!openid) {
             wx.login({success:  Util.proxy(this.handleLoginSucc, this)});
        }
    },

    handleSessionExpire: function() {
        wx.removeStorageSync('openid');
        wx.login({success:  Util.proxy(this.handleLoginSucc, this)});
    },

    handleLoginSucc: function(res){
        if(res.code) {
          wx.request({
            method: 'post',
            url: 'https://nuanwan.wekeji.cn/nuanwan/index.php/wechat/get_user_info',
            header: {'content-type': 'application/x-www-form-urlencoded'},
            data: {
              code: res.code
            },
            success: Util.proxy(this.handleGetUserInfoSucc, this)
          });
          wx.getUserInfo({
            success: function(res){
                console.log(res);
            }
          });
        } 
    },

    handleGetUserInfoSucc: function(response) {
        response = response.data;
        if (response.ret) {
            wx.setStorage({
                key: 'openid',
                data: response.data.openid
            })
        }
    },