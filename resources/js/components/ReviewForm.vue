<template>
  <form action="../api/review" method="POST" @submit="sendReview()">
    <input type="hidden" name="user_id" id="user_id" :value="doctorId" >
        <!-- <div class="form-group">
            <label for="name">Namee</label>
            <input type="text" class="form-control" name="name" v-model="name" id="name" />
        </div> -->

        <div class="form-group">
            <label for="mail">E-mail</label>
            <input type="text" class="form-control" v-model="mail" name="mail" id="mail"/>
        </div>

        <div class="form-group">
            <label for="description">Message</label>
            <textarea class="form-control" name="description" id="description" v-model="description" rows="5"></textarea>
        </div>
        <div class="form-group mt-2">
            <label for="vote">Voto</label>
            <select name="vote" id="vote" class="form-control-sm">
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
        <button type="submit" class="btn btn-primary mt-3">Send message</button>
    </form>
</template>

<script>
import axios from 'axios'
export default {
  name:'ReviewForm',
  data(){
      return{
          vote:'',
          mail:'',
          description:'',
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

<style>

</style>