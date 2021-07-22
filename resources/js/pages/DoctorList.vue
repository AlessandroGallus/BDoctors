<template>
  <div>
    LISTA DOTTORI:
    <div class="container">
      <Doctor
    v-for="(doctor,key) in doctors"
    :key="key"
    :username='doctor.username'
    :spec_name='doctor.spec_name'
    :url_img="doctor.url_img"
    :sponsor_name='doctor.sponsor_name'
    />
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Doctor from '../components/Doctor.vue'
export default {
  name:'DoctorList',
  components:{
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