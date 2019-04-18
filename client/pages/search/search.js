const _ = require('underscore')

Page({
  data: {
    list: []
  },

  onReady() {
    this.loadData()
  },

  loadData(keyword="") {
    wx.request({
      url: 'https://ik9hkddr.qcloud.la/index.php/trade/get_search_list',
      data: {
        keyword
      },
      header: {
        'content-type': 'application/x-www-form-urlencoded'
      },
      method: 'POST',
      success: (res) => {
        this.setData({
          list: res.data.data || []
        })
      }
    })
  },

  handleInput: _.debounce((e) => {
    let pages = getCurrentPages()
    let currentPage = pages[pages.length - 1]
    currentPage.loadData(e.detail.value)
  }, 300)
})