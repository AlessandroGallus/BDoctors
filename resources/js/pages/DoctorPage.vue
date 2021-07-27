<template>
  <div>
    <h1>PAGINA DI: {{doctor.name}} {{doctor.surname}} </h1>
    <div class="doc-details d-flex justify-content-between">
      <div class="infos">
        <h3>Indirizzo: {{doctor.address}}</h3>
        <h3>Città: {{doctor.city}}</h3>
        <h3>Telefono: {{doctor.phone_number}}</h3>
        <h3>Specializzazioni:</h3>
        <ul>
          <li 
          v-for="(spec,index) in doctor.specializations"
          :key="index"
          >{{spec.name}}</li>
        </ul>
      </div>
      <div class="img">
        <img
     :src="doctor.url_img" alt="">
      </div>
    </div>
    <div class="msgNot" v-if="msgNot">
      <h3>MESSAGGIO INVIATO CORRETTAMENTE</h3>
    </div>
  <button type="button" v-on:click="isHidden = false">MANDA MESSAGGIO</button>
    <!-- MESSAGE FORM -->
    
    <div class="form" v-if="!isHidden">
      <ContactForm 
      @confermaInviato='confirmSent()'
      :doctorId="doctor.id"
      />
    </div>
    <button type="button" v-on:click="isHiddenReview = false">MANDA REVIEW</button>
    <div class="form" v-if="!isHiddenReview">
      <ReviewForm 
      :doctorId="doctor.id"
      />
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import ContactForm from '../components/ContactForm.vue'
import ReviewForm from '../components/ReviewForm.vue'
export default {
  name:'DoctorPage',
  components:{
    ContactForm,
    ReviewForm
  },
  data(){
    return{
      doctor:{},
      isHidden:true,
      isHiddenReview:true,
      msgNot:false,
    }
  },
  mounted(){
    console.log('id',this.$route.params.id);
    this.getDoctorById();
    
  },
  methods:{
    confirmSent(){
      this.isHidden=true;
      this.msgNot=true;
    },
    getDoctorById(){
      axios.get('http://127.0.0.1:8000/api/doctors/'+this.$route.params.id)
      .then(res => {
        this.doctor=res.data;
        console.log(this.doctor);
        if(this.doctor.url_img.startsWith('uploads')){
          this.doctor.url_img = '../storage/'+this.doctor.url_img;
        }
      })
      .catch(err => {
        console.error(err); 
      })
    }
  }
}
</script>

<style lang='scss' scoped>
  
</style>