import Vue from 'vue'
import App from './App.vue'

import { http, events } from './services'

new Vue({
  render: h => h(App),
  el: '#app',
  created () {
    events.init()
    http.init()
  }
})
