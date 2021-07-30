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
     <router-link :to="{name:'advancedSearch',params:{'spec':ricerca}}"><button>GO</button></router-link>
    </div>
    
     
    <h3 class="mt-3">Lista dottori PREMIUM:</h3>
    <div class="container doctor">
      <Doctor
    v-for="(doctor,key) in premium"
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
    :urlCv="doctor.url_cv"
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
    this.getSpecs();
    this.premiumDoctor();
  },
  data(){

    return{
      ricerca:'',
      premium:[],
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
      })
      .catch(err => {
        console.error(err); 
      })
    },
    calcoloMedia() {
            this.premium.forEach(doctor => {
                let media = 0;
                for (let i = 0; i < doctor.reviews.length; i++) {
                    media = media + doctor.reviews[i].vote;
                }
                doctor["media"] = media / doctor.reviews.length;
                if (isNaN(doctor.media)) doctor.media = 0;
            });
        },


    premiumDoctor(){
      axios.get('http://127.0.0.1:8000/api/alldoctors?premium')
      .then(res => {
        this.premium=res.data.data
        this.calcoloMedia();
        console.log('premium: ',this.premium)
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
  // .doctor{
  //   flex-basis: (100% / 3);
  // }
</style>
