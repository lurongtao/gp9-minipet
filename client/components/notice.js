Component({
  properties:{
    isSuccess: {
      type: Boolean
    },
    isSubmit: {
      type: Boolean
    }
  },

  ready() {
    
  },

  methods: {
    action() {
      if (this.properties.isSuccess) {
        wx.navigateBack({
          delta: 1
        })
      } else {
        this.triggerEvent('ChangeSubmit')
      }
    }
  }
})
