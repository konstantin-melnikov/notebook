import Vue from 'vue'
import axios from 'axios'
import config from '@/config/app'
import store from '@/store'

var http = axios.create({
  baseURL: config.adminApi,
  timeout: 10000
})

http.interceptors.request.use(function (request) {
  return request
}, function (error) {
  // Do something with request error
  return Promise.reject(error)
})

http.interceptors.response.use(function (response) {
  const request = response.config
  if (config.debug.http) {
    console.log(
      {
        method: request.method.toUpperCase(),
        url: request.url,
        params: request.params,
        response
      }
    )
  }
  return response
}, function (error) {
  const { response, config: request } = error
  if (config.debug.http) {
    if (request) {
      console.log(
        {
          method: request.method.toUpperCase(),
          url: request.url,
          params: request.params,
          response
        }
      )
    }
  }
  if (response.status !== 422) {
    store.commit(
      'showMessage',
      { type: 'error', body: response.data.message || response.data.error.message || 'Undefined error' }
    )
    // Auto hiding/removing the message
    setTimeout(function () {
      store.commit('hideMessage')
    }, config.messages.autoHideIn || 3000)
  }
  // Do something with response error
  return Promise.reject(error)
})
Vue.prototype.$http = http
