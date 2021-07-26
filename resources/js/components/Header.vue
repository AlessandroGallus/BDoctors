<template>
  <header>
    <div class="container ">

        <nav class="d-flex justify-content-between align-items-center">
      <div class="left"><router-link :to="{name:'home'}">HOME</router-link></div>
      <div class='right'>
        <ul class="list-style-none mt-4">
          <li class="d-inline"><router-link :to="{name:'doctorlist'}">Dottori</router-link></li>
          <li class="d-inline"><router-link :to="{name:'advancedSearch'}">RICERCA AVANNZATA</router-link></li>
          <li class="d-inline"><a href="/register">Register</a></li>
         
        </ul>
      </div>
    </nav>
    </div>
  
  </header>
</template>

<script>
export default {
    name:'Header'
}
</script>

<style lang='scss' scoped>
  header{
    color: white;
    height: 80px;
    background-color: #386db3;
    nav{
      height: inherit;
      a{
          color: white;
          text-decoration: none;
      }
    }
  }
</style>
