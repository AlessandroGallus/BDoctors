<template>
  <form action="../api/message" method="POST" @submit="sendMessage()">

    <input type="hidden" name="user_id" id="user_id" :value="doctorId" >
        <!-- <div class="form-group">
            <label for="name">Namee</label>
            <input type="text" class="form-control" name="name" v-model="name" id="name" />
        </div> -->

        <div class="form-group">
            <label for="mail">E-mail</label>
            <input type="text" class="form-control" v-model="email" name="mail" id="mail"/>
        </div>

        <div class="form-group">
            <label for="message_text">Message</label>
            <textarea class="form-control" name="message_text" id="message_text" v-model="message" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone</label>
            <input type="text" class="form-control" v-model="phone_number" name="phone_number" id="phone_number"/>
        </div>
        <!-- <div class="alert alert-success">
            {{session('message')}}
        </div> -->
        <button type="submit" class="btn btn-primary mt-3" >Send message</button>
    </form>
</template>

<script>
import axios from 'axios'
export default {
  name:'ContactForm',
  data(){
      return{
          phone_number:'',
          email:'',
          message:'',
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

<style>

</style>