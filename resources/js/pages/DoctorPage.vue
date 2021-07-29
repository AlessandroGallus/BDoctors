<template>
  <div>
    <h1>Dott/ssa: {{doctor.name}} {{doctor.surname}} </h1>
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
        <h3>Curriculum Vitae:</h3>
         <a target="_blank" :href="doctor.url_cv">Clicca qui per accedere al curriculum</a>
        <h3>Reviews:</h3>
        <ul>
          <li v-for="(review,index) in doctor.reviews" :key='index'>
            <p>{{review.description}} <span class="star d-inline"
    v-for="index in 5"
    :key="index"
    >
    <i v-if="index<=Math.round(review.vote)" class="fas fa-star"></i>
          <i class="far fa-star" v-else ></i>
    </span></p>
          </li>
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
    <div class="buttons">
      <button class="btn btn-primary" type="button" v-on:click="()=>{isHidden=!isHidden; isHiddenReview=true}">Invia Messaggio</button>
      <button class="btn btn-primary" type="button" v-on:click="()=>{isHiddenReview=!isHiddenReview; isHidden=true}">Invia Recensione</button>
    </div>

    <!-- MESSAGE FORM -->

    <div class="form" v-if="!isHidden">
      <ContactForm
      @confermaInviato='confirmSent()'
      :doctorId="doctor.id"
      />
    </div>

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
  img{
    width: 150px;
  }
  button{
/*       background-color: #3f7bbd; */
      background-image: linear-gradient( 135deg , #386db3 45%, #56a7da);
         &:hover{
           background: linear-gradient(135deg, #56a7da 45%, #386db3);
            transition: 0.2s;
            transform: scale(1 ,1.1);
            box-shadow: 3px 7px 5px #888888;
          }
  }
</style>
