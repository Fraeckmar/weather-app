require('./bootstrap')

import { createApp } from 'vue'
import App from './components/App.vue'
import routes from './routes'

createApp(App).use(routes).mount('#app')