import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);

import Home from './pages/Home.vue'
import DoctorList from './pages/DoctorList.vue'

const router = new VueRouter({
  mode:'history',
  routes:[
    {
      path:'/',
      name:'home',
      component: Home
    },
    {
      path:'/doctors-list',
      name:'doctorlist',
      component:DoctorList
    }
  ]
});
export default router;