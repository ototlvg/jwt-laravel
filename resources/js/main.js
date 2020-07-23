import Vue from 'vue'

Vue.config.productionTip = false

import App from './components/App'
new Vue({
    el: '#app',
    components: { App },
    template: '<App/>'
})
