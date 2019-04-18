Page({
  data: {
    detail: {
      type: 'buy'
    }
  },
  onLoad: function (options) {
    wx.request({
      url: 'https://ik9hkddr.qcloud.la/index.php/trade/get_item',
      method: 'POST',
      header: {
        'content-type': 'application/x-www-form-urlencoded'
      },
      data: {
        id: options.id
      },
      success: (res) => {
        console.log(res.data)
        this.setData({
          detail: {
            ...this.data.detail,
            ...res.data.data
          }
        })
      }
    })
  },

  handleBack() {
    wx.navigateBack({
      delta: 1
    })
  }
})