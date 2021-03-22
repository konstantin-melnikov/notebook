require('./bootstrap')

import Vue from 'vue'
import SubscriberPage from '@/pages/subscriber/component'
import '@/http'
import store from '@/store'

const elements = document.querySelectorAll('[vue-app]')
if (elements.length > 0) {
  elements.forEach((item) => {
    const app = new Vue({
      el: item,
      store,
      components: {
        SubscriberPage,
      },
      data: {
      }
    })
  })
}
