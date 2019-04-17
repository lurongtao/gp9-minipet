Page({
  data: {
    isSubmit: false,
    isSuccess: false,
    address: '点击选择，要勾选哦~',
    message: '',
    contact: '',
    type: 'buy'
  },

  radioChange(e) {
    this.setData({
      type: e.detail.value
    })
  },

  handleAddressTap() {
    wx.chooseLocation({
      success: (res) => {
        this.setData({
          address: res.address
        })
        this.staticData = {
          latitude: res.latitude,
          longitude: res.longitude
        }
      }
    })
  },

  handleMessageInput(e) {
    this.staticData.message = e.detail.value
  },

  handleContactInput(e) {
    this.staticData.contact = e.detail.value
  },

  handleSubmit() {
    if (this.data.address === '点击选择，要勾选哦~') {
      this.showToast('请选择地址~')
      return
    }

    if (!this.staticData.message) {
      this.showToast('请输入说明~')
      return
    }

    if (!this.staticData.contact) {
      this.showToast('请输入联系方式~')
      return
    }

    let data = {
      ...this.data,
      ...this.staticData
    }

    wx.request({
      url: 'https://ik9hkddr.qcloud.la/index.php/trade/add_item',
      data,
      header: {
        'content-type': 'application/x-www-form-urlencoded'
      },
      method: 'POST',
      success: (res) => {
        if (res.data.ret) {
          this.setData({
            isSuccess: true
          })
        } else {
          this.showToast('发送信息失败', 'none')
          this.setData({
            isSuccess: false
          })
        }

        this.setData({
          isSubmit: true
        })
      }
    })
  },

  showToast(title, icon='loading') {
    wx.showToast({
      title,
      icon,
      duration: 1500
    })
  }
})