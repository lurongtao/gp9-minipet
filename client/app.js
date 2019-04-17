App({
  getSysInfo() {
    try {
      const res = wx.getSystemInfoSync()
      return {
        ww: res.windowWidth,
        wh: res.windowHeight
      }
    } catch (e) {
      // Do something when catch error
    }
  }
})