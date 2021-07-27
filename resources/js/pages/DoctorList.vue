<template>
  <div>
    LISTA DOTTORI:
    <div class="container">
      <Doctor
    v-for="(doctor,key) in doctors"
    :key="key"
    :username='doctor.name'
    :spec_name='doctor.specializations[0].name'
    :url_img="doctor.url_img"
    :sponsor_name='doctor.sponsors[0].name'
    :exp_date='doctor.sponsors[0].pivot.expiring_date'
    :city='doctor.city'
    :id='doctor.id'
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

<style lang="scss" scoped>



</style>