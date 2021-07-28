<template>
  <div class="doctor-container">
    <div class="doc-infos">
      <h3>Nome: {{username}}</h3>
    <h5>Città: {{city}}</h5>
    <h5>Specializzazione/i: {{spec_name}}</h5>
    <h5>Media Voti: {{(!isNaN(media))? media: 'Non disponibile'}}</h5>
    <div class="star d-inline"
    v-for="index in 5"
    :key="index"
    >
    <i v-if="index<=Math.round(media)" class="fas fa-star"></i>
          <i class="far fa-star" v-else ></i>
    </div>
    <h5>Sponsor: {{sponsor_name}}</h5>
    <h5>Scadenza Sponsor: {{exp_date}}</h5>
    <h5>Oggi: {{currentDate()}}</h5>
    <router-link id="id" :to="{name:'doctorPage',params:{'fullname':username,'id':id}}">Vedi Profilo</router-link>
    </div>
    <div class="doc-img">

      <img 
      v-if="!url_img.startsWith('uploads')"
     :src="url_img" alt="">
     <img class="storage" v-else :src="'storage/'+url_img" alt="">

    </div>

  </div>
</template>

<script>
export default {
  name:'Card',
  props:['spec_name','url_img','username','sponsor_name','spec_name','exp_date','city','id','media'],
  methods:{
    currentDate(){
      const current = new Date();
      const date = `${current.getFullYear()}-${current.getMonth()+1}-${current.getDate()}`;
      let scaduta = '- scaduto'
      let diff = Date.now()>(new Date(this.exp_date).getTime());
      return diff;
    }
  }
  
}
</script>

<style lang='scss' scoped>
.fill-star{
  color: black;
  overflow: hidden;
}
  .doctor-container{
    display: flex;
    background-color: #add8e6;
    margin-bottom:10px;
    justify-content:space-between;
    padding:10px 20px;
    background-image: url('../../../public/img/back2.jpg');
    background-size: cover;
    border-radius: 20px;

    .doc-img{
        width: 400px;
    }
  }

  .storage{
     width: 145px;
  }
</style>


