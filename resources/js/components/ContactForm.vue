<template>
  <form action="../api/message" method="POST" @submit="checkData">

    <p class="errors" v-if="errors.length">
    <b>Si prega di correggere i seguenti errori:</b>
    <ul>
      <li v-for="(error,key) in errors" :key="key">{{ error }}</li>
    </ul>
  </p>
    <input type="hidden" name="user_id" id="user_id" :value="doctorId" >
        <!-- <div class="form-group">
            <label for="name">Namee</label>
            <input type="text" class="form-control" name="name" v-model="name" id="name" />
        </div> -->

        <div class="form-group">
            <label for="mail">E-mail</label>
            <input type="email" v-model="email" class="form-control" placeholder="Inserisci qui la tua mail" name="mail" id="mail"/>
        </div>

        <div class="form-group">
            <label for="message_text">Messaggio</label>
            <textarea class="form-control" name="message_text"  id="message_text" v-model="message" rows="5" placeholder="Inserisci qui il testo..."></textarea>
        </div>
        <div class="form-group">
            <label for="phone_number">Numero di telefono</label>
            <input type="number" class="form-control" v-model="phone_number" name="phone_number" placeholder="Inserisci qui il tuo numero" id="phone_number"/>
        </div>
        <!-- <div class="alert alert-success">
            {{session('message')}}
        </div> -->
        <button type="submit" value="submit" class="btn btn-primary mt-3" >Invia</button>
    </form>
</template>

<script>
import axios from 'axios'
export default {
  name:'ContactForm',
  data(){
      return{
          errors:[],
          phone_number:null,
          email:null,
          message:null,
          id:'',
      }
  },
  props:[
      'doctorId',
  ],
  mounted(){
      this.id=this.doctorId;
      console.log(this.id);
  },
  methods:{
      checkData(e){
          this.errors=[]
          if(!this.phone_number){
              this.errors.push('Numero di telefono necessario')
          }
          if(!this.email){
              this.errors.push('Email necessaria')
          }
          if(!this.message){
              this.errors.push('Corpo messaggio necessario')
          }
          if(this.errors.length>0){
              e.preventDefault();
              console.log('errori presenti');
            }else{
                console.log('nessun errore');
                /* this.sendMessage(); */
            }
      },
      sendMessage(){
          console.log(this.doctorId);
          console.log('send message');
          axios.post('../api/message')
          .then(res => {
              console.log(res)
          })
          .catch(err => {
              console.log(err.response.data);
              'non mandato'
          })
          console.log('messagio inviato');
          /* this.$emit('confermaInviato',false); */
      }
  }
}
</script>

<style lang="scss" scoped>
form{
    margin-top: 15px;
    margin-bottom: 15px;
}
    .errors{
        padding: 10px;
        margin-top: 10px;
        border: 1px solid red;
        border-radius: 5px;
    }
button{
    border: none;
    margin: 0 30px;
    background-image: linear-gradient( 135deg , #1e6650 45%, #63987a);
    &:hover{
        background: linear-gradient(135deg, #63987a 45%, #1e6650);
        transition: 0.3s;
        box-shadow: 3px 7px 5px #888888;
    }
}
</style>
