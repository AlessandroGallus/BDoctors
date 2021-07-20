<template>
  <div>
    <h3>{{name}}</h3>
    <h5>{{username}}</h5>
    <img :src="url_img" alt="">
  </div>
</template>

<script>
export default {
  name:'Card',
  props:['name','url_img','username'],
}
</script>

<style>

</style>