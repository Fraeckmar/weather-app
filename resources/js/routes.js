import { createRouter, createWebHistory } from 'vue-router'

import PlaceDetails from './components/PlaceDetails.vue'
import Home from './components/Home.vue'
 
const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {label: 'Home'}
    },
    {
        path: '/place-details/:fsqId',
        name: 'place.details',
        component: PlaceDetails,
        meta: {label: 'PlaceDetails'}
    }
];
 
export default createRouter({
    history: createWebHistory(),
    routes
})