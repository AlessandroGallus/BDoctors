<template>
  <form action="../api/review" method="POST" @submit="checkData">

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
            <input type="email" class="form-control" v-model="mail" placeholder="Inserisci qui la tua mail" name="mail" id="mail"/>
        </div>

        <div class="form-group">
            <label for="description">Messaggio</label>
            <textarea class="form-control" placeholder="Inserisci qui il testo..." name="description" id="description" v-model="description" rows="5"></textarea>
        </div>
        <div class="form-group mt-2">
            <label for="vote">Voto</label>
            <select name="vote" id="vote" class="form-control-sm" v-model="vote">
              <option value=null>-</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
        </div>
        <!-- <div class="alert alert-success">
            {{session('message')}}
        </div> -->
        <button type="submit" class="btn btn-primary mt-3" >Invia Recensione</button>
    </form>
</template>

<script>
import axios from 'axios'
export default {
  name:'ReviewForm',
  data(){
      return{
          vote:null,
          mail:null,
          description:null,
          id:'',
          errors:[]
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
          if(!this.vote){
              this.errors.push('Voto necessario')
          }
          if(!this.mail){
              this.errors.push('Email necessaria')
          }
          if(!this.description){
              this.errors.push('Corpo review necessario')
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
          axios.post('../api/review',)
          .then(res => {
              console.log(res)
              console.log('mandato');
          })
          .catch(err => {
              console.error(err);
          })
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
