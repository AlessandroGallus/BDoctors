<template>
  <div>
    <h3>{{name}}</h3>
    <img :src="url_img" alt="">
  </div>
</template>

<script>
export default {
  name:'Card',
  props:['name','url_img'],
}
</script>

<style>

</style>