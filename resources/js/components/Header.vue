<template>
  <header class="mb-3">
    <div class="container ">

        <nav class="d-flex justify-content-between align-items-center">
      <div class="left home">
         <router-link :to="{name:'home'}"><img src="../../../public/img/logo1.png" alt="Logo"></router-link>
         
     </div>
      <div class='right'>
      
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
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
    height: 60px;
    line-height: 60px;
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
                   color: white;
                   &:hover{
                       color: #ff6600;
                   }
               }
               li::after{
                 display: block;
                 position: absolute;
                 content: '';
                 top: 50px;
                 left: 0;
                 height: 1px;
                 width: 0%;
                 background-color: white;
                 -webkit-transition: width .3s;
               }
               li{
                 font-size: 15px;
                 position: relative;
                  /*  margin: 0 10px; */
                  height: 100%;
                  padding: 25px;
                  &:hover{
                    /* background-color: #043d6b;
                    transition: .5s; */
                    &::after{
                      width: 100%;
                      transition:ease-in-out .3s;
                    }
                  }
               }
          }
      }
    }
  }
</style>
