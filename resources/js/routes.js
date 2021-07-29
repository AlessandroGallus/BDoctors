import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);

import Home from './pages/Home.vue'
import DoctorList from './pages/DoctorList.vue'
import DoctorPage from './pages/DoctorPage.vue'
import Confirmation from './pages/Confirmation.vue'
import AdvancedSearch from './pages/AdvancedSearch.vue'

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
    },
    {
      path:'/advanced-search',
      name:'advancedSearch',
      component:AdvancedSearch,
    },
    {
      path:'/doctor/:id',
      name:'doctorPage',
      component:DoctorPage,
      
    },
    {
      path:'/confirmation',
      name:'confirmation',
      component:Confirmation
    }
  ]
});
export default router;