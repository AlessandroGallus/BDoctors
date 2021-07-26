<template>
  <div>
    <h2>RICERCA AVANZATA</h2>
    <div class="ricerca">
      <!-- <input type="text" v-model="city" placeholder="Città"> -->
      <select name="cities" id="cities" v-model="mcity">
        <option value="">--Seleziona una città</option>
          <option 
      v-for="(city,key) in cities"
      :key="key"
      :value="city.city">{{city.city}}</option>
      </select>
    <select name="specs" id="specs" v-model="mspecs">
      <option value="">--Seleziona una specializzazione</option>
      <option 
      v-for="(spec,key) in specs"
      :key="key"
      :value="spec">{{spec}}</option>
    </select>
    <button class="btn btn-primary" v-on:click="search">Cerca</button>
    <div class="result">
      <div class="container">
      <Doctor
    v-for="(doctor,key) in filteredArray"
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
    </div>
    
  </div>
</template>

<script>
import axios from 'axios'
import Doctor from '../components/Doctor.vue'
export default {
  name:'AdvancedSearch',
  components:{
    Doctor
  },
  data(){
    return{
      filteredArray:[],
      specs:[],
      mcity:'',
      mspecs:'',
      doctors:[],
      cities:[]
    }
  },

  mounted(){
    this.getSpecs();
    this.getDoctors();
    this.getCities();
  },
  methods:{
    search(){
      this.filteredArray=[];
      console.log('test');
      console.log(this.mcity);
      console.log(this.mspecs);
      /* this.filteredArray = this.doctors.filter((doctor)=>{
        if(doctor.city==this.city && doctor.specializations[0].name==this.mspecs){
          return doctor;
        }
      }); */
      for(let i=0;i<this.doctors.length;i++){ // RICERCA CASO MULTIPLE SPECIALIZZAZIONI
        for(let j=0;j<this.doctors[i].specializations.length;j++){
          if(this.doctors[i].city==this.mcity && this.doctors[i].specializations[j].name==this.mspecs){
            console.log('trovato');
            if(!this.filteredArray.includes(this.doctors[i])){
              this.filteredArray.push(this.doctors[i]);
            }
          } else{console.log('non trovato');}
        }
      }
      console.log(this.filteredArray);
    },
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
    getDoctors(){
      axios.get('http://127.0.0.1:8000/api/doctors')
      .then(res => {
        this.doctors=res.data;
        /* console.log(this.doctors) */
      })
      .catch(err => {
        console.error(err); 
      })
    },
    getCities(){
      axios.get('http://127.0.0.1:8000/api/cities')
      .then(res => {
        this.cities=res.data
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