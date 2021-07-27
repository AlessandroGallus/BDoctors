<template>
  <header class="mb-3">
    <div class="container ">

        <nav class="d-flex justify-content-between align-items-center">
      <div class="left home">
         <router-link :to="{name:'home'}"><img src="../../../public/img/logo.ong.png" alt="Logo"></router-link>
          <router-link :to="{name:'home'}">HOME</router-link>
     </div>
      <div class='right'>
        <ul class="list-style-none list">
         <router-link :to="{name:'doctorlist'}"> <li class="d-inline">Dottori</li> </router-link>
         <router-link :to="{name:'advancedSearch'}"><li class="d-inline">Ricerca</li> </router-link>
         <a href="/register"><li class="d-inline">Registrati</li></a>

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
    display: flex;
    align-items: center;
    color: white;
    height: 80px;
    /* background-color: #386db3; */
    background-image: linear-gradient( to right , #386db3, #56a7da);
    nav{
      height: inherit;

      img{
          width: 50px;
      }
      .home{
          font-size: 2rem;
      }

      a{
          color: #fff;
          text-decoration: none;
      }

      .right{
          display: flex;
          align-items: center;
          .list{
              margin-bottom: 0;
               font-size:22px;
               a{
                   color: #fff;
                   &:hover{
                       color: #ff6600;
                   }
               }
               li{
                  /*  margin: 0 10px; */
                  height: 100%;
                  padding: 25px;
                  &:hover{
                    background-color: #043d6b;
                    transition: 1s;
                  }
               }
          }
      }
    }
  }
</style>
