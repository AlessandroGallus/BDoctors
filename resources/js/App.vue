<template>
  <div>
    <Header/>
    <div class="container">
        <router-view></router-view>
    </div>
    <Footer />
  </div>
</template>

<script>
import Header from './components/Header.vue'
import Doctor from './components/Doctor.vue'
import Footer from './components/Footer.vue'
import axios from 'axios'
export default {
  name:'App',
  components:{
    Header,
    Doctor,
    Footer
  },
  mounted(){
  },
  data(){
    return{
      doctors:[],
    }
  },

}
</script>

<style>

</style>
