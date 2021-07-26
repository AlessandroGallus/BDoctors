<template>
  <div class="doctor-container">
    <div class="doc-infos">
      <h3>Nome: {{username}}</h3>
    <h5>Spec: {{spec_name}}</h5>
    <h5>Sponsor: {{sponsor_name}}</h5>
    <h5>City: {{city}}</h5>
    <h5>Exp: {{exp_date}}</h5>
    <router-link id="id" :to="{name:'doctorPage',params:{'fullname':username,'id':id}}">Vedi Profilo</router-link>
    </div>
    <div class="doc-img">
      <img
      v-if="!url_img.startsWith('uploads')"
     :src="url_img" alt="">
     <img v-else :src="'storage/'+url_img" alt="">
    </div>
    
  </div>
</template>

<script>
export default {
  name:'Card',
  props:['spec_name','url_img','username','sponsor_name','spec_name','exp_date','city','id'],
}
</script>

<style lang='scss' scoped>
  .doctor-container{
    display: flex;
    background-color: red;
    margin-bottom:10px;
    justify-content:space-between;
    padding:10px 20px;
  }
</style>