<template>
  <div>
    <h3>Nome: {{username}}</h3>
    <h5>Spec: {{spec_name}}</h5>
    <h5>Sponsor: {{sponsor_name}}</h5>
    <img :src="url_img" alt="">
  </div>
</template>

<script>
export default {
  name:'Card',
  props:['spec_name','url_img','username','sponsor_name','spec_name'],
}
</script>

<style>

</style>