<template>
  <header>
    <nav class="d-flex justify-content-between align-items-center">
      <div class="left">
        <img src="img/logo.png" alt="">
        <router-link  class="mr-2  " :to="{name:'home'}">HOME</router-link>
        </div>
      <div class='right'>
        <ul class="list-style-none">
          <li class="d-inline"><router-link :to="{name:'doctorlist'}">Dottori</router-link></li>
          <li class="d-inline"><a href="/register">Register</a></li>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script>
export default {
    name:'Header'
}
</script>

<style lang='scss' scoped>
  header{
    height: 80px;
    background-color: red;
    nav{
      height: inherit;
      img{
        width: 70px;
        border-radius: 50% ;
      }
    }
  }
</style>