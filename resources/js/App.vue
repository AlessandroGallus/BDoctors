<template>
  <div>
    <Header/>
    <div class="container">
        <router-view></router-view>
    </div>
    <!-- <Doctor
    v-for="(doctor,key) in doctors"
    :key="key"
    :username='doctor.username'
    :spec_name='doctor.spec_name'
    :url_img="doctor.url_img"
    :sponsor_name='doctor.sponsor_name'
    /> -->
  </div>
</template>

<script>
import Header from './components/Header.vue'
import Doctor from './components/Doctor.vue'
import axios from 'axios'
export default {
  name:'App',
  components:{
    Header,
    Doctor
  },
  mounted(){
    this.getDoctors();
  },
  data(){
    return{
      doctors:[],
    }
  },
  methods:{
    getDoctors(){
      axios.get('http://127.0.0.1:8000/api/doctors')
      .then(res => {
        this.doctors=res.data;
        console.log(this.doctors)
      })
      .catch(err => {
        console.error(err);
      })
    }
  }
}
</script>

<style>

</style>
