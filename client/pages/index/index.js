const app = getApp()

Page({
  data: {
    longitude: 0,
    latitude: 0,
    controls: [{
      id: 1,
      iconPath: '/resources/center.png',
      position: {
        left: 20,
        top: app.getSysInfo()['wh'] - 94,
        width: 30,
        height: 30
      },
      clickable: true
    }]
  },

  controltap(e) {
    const mapCtx = wx.createMapContext('map')
    mapCtx.moveToLocation()
  },

  onReady: function () {
    this.getLocation()
  },

  getLocation() {
    wx.getLocation({
      type: 'wgs84',
      success: (res) => {
        let { latitude, longitude } = res
        this.setData({
          latitude,
          longitude
        })
      }
    })
  }
})