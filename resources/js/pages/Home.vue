<template>

  <div class="mt-3" >
    <div class="inputs-ricerca d-flex">
      <input list="specializations" class="input-form form-control d-inline"
    @keyup.enter="searchdoctor()"
    v-model="ricerca"
     type="text" placeholder="Specializzazione">
     <datalist v-bind:id="datalistID" >
       <option v-for="(spec,index) in specs" :key="index" :value="spec"></option>
     </datalist>
     <button
    v-on:click=' searchdoctor()'

     type="button" class="btn btn-primary">Ricerca</button>
    </div>
    
     
    <h3 class="mt-3">Lista dottori:</h3>
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
    :media='doctor.media'
    :nReviews="doctor.reviews.length"
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
    this.getSpecs();
  },
  data(){

    return{
      filterdoctor:[],
      ricerca:'',
      doctors:[],
      premium:[],
      basic:[],
      specs:[],
      datalistID:'ciao'
    }
  },
  watch:{
    ricerca:function(){
  if (this.ricerca.length > 2) {
      this.datalistID='specializations'
    }else{
      this.datalistID='inactive'
    }
    }
  },
  methods:{
    getSpecs(){
      axios.get('http://127.0.0.1:8000/api/doctors/specs')
      .then(res => {
        this.specs=res.data;
        /* console.log(this.specs) */
      })
      .catch(err => {
        console.error(err); 
      })
    },
    calcoloMedia(){
      this.doctors.forEach(doctor=>{
        let media=0;
        for(let i=0;i<doctor.reviews.length;i++){
          media = media+doctor.reviews[i].vote;
        }
        doctor['media']= media/(doctor.reviews.length);
        console.log('media',doctor['media']);
      })
    },


    premiumDoctor(){
      // this.filterdoctors=[]
    this.doctors.forEach(doctor => {
      // console.log(doctor.sponsors[0].sponsor_level);
      if(doctor.sponsors[0].sponsor_level >1 ){
        this.premium.push(doctor)

      }else{
        this.basic.push(doctor)
      }
     
    })
    },
    searchdoctor(){
      this.filterdoctor=[]
      this.filterdoctor = this.doctors.filter((doctor)=>{
        if(doctor.specializations[0].name.startsWith(this.ricerca)){
          return true
        }
      })
    },

    getDoctors(){
      axios.get('http://127.0.0.1:8000/api/doctors-spec')
      .then(res => {
        this.doctors=res.data;
        this.premiumDoctor();
        this.calcoloMedia();
        console.log(this.doctors)
      })
      .catch(err => {
        console.error(err);
      })
    }
  }
}

</script>

<style lang='scss' scoped>
  .input-form{
    width: 50%;
    margin-right: 20px;
  }
  ::placeholder{
    font-style: italic;
  }
</style>
