<template>

  <div class="mt-3" >
    <button
    v-on:click=' searchdoctor()'

     type="button">ricerca</button>
    <input
    @keyup.enter="searchdoctor()"
    v-model="ricerca"
     type="text">
    LISTA DOTTORI:
    <div class="container">
      <Doctor
    v-for="(doctor,key) in filterdoctor"
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
      filterdoctor:[],
      ricerca:'',
      doctors:[],
    }
  },
  methods:{
    searchdoctor(){
      this.filterdoctor=[]
      this.filterdoctor = this.doctors.filter((doctor)=>{
        if(doctor.specializations[0].name.startsWith(this.ricerca)){
          console.log('trovato');
          return true
        }else{

        console.log('non trovato');
        }
      })
    },

    getDoctors(){
      axios.get('http://127.0.0.1:8000/api/doctors-spec')
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
