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
    }, {
      id: 2,
      iconPath: '/resources/pin.png',
      position: {
        left: app.getSysInfo()['ww'] / 2 - 11,
        top: (app.getSysInfo()['wh'] - 44 ) / 2 - 30,
        width: 22,
        height: 31
      }
    }],

    markers: [],
  
  },

  controltap(e) {
    const mapCtx = wx.createMapContext('map')
    mapCtx.moveToLocation()
  },

  markertap(e) {
    let id = e.markerId
    wx.navigateTo({
      url: '/pages/detail/detail?id=' + id,
    })
  },

  onReady: function () {
    this.getLocation()
  },

  onShow() {
    this.loadData()
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
  },

  publish () {
    wx.navigateTo({
      url: '/pages/publish/publish',
    })
  },

  search() {
    wx.navigateTo({
      url: '/pages/search/search',
    })
  },

  loadData() {
    wx.request({
      url: 'https://ik9hkddr.qcloud.la/index.php/trade/get_list',
      success: (res) => {
        if (res.data.ret) {
          this.loadDataSucc(res.data.data)
        } else {
          //
        }
      }
    })
  },

  loadDataSucc(data) {
    let list = data.map((value, index) => {
      return {
        iconPath: `/resources/${value.type}.png` ,
        id: value.id,
        latitude: value.latitude,
        longitude: value.longitude,
        width: 40,
        height: 40
      }
    })

    this.setData({
      markers: list
    })
  }
})