<template>
  <header class="mb-3">

    <div class="container ">

        <nav class="d-flex justify-content-between align-items-center">
            <div class="left home">
               <router-link :to="{name:'home'}"><img src="../../../public/img/logo1.png" alt="Logo"></router-link>
                <p class="logo-text">bdoctors</p>
             </div>
            
       <div class='right'> 
         <div class="hambuger">
              <div class="dropdown hamburger menu">
              <button class="btn btn-custom btn-secondary dropdown-toggle" type="button" id="#dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> 
                 <i class="fas fa-align-justify"></i>
              </button>
                 <ul class="dropdown-menu width" aria-labelledby="dropdownMenuButton1">
                  <li class="text-center ">
                       <router-link class="dropdown-item " :to="{name:'advancedSearch'}">Ricerca</router-link> 
                   </li>
                  <li class="text-center">
                      <a href="/register">Registrati</a>
                  </li>
                 
                 </ul>
            </div>
         </div>
         
             
          <div class="links">
             <ul class="list-style-none list">

            
              <li class="d-inline">
                   <!-- <router-link :to="{name:'doctorlist'}">Dottori</router-link>  -->
              </li>
              <li class="d-inline">
                   <router-link :to="{name:'advancedSearch'}">Ricerca</router-link> 
              </li>
             <li class="d-inline ">
                <a href="/register">Registrati</a>
             </li>
            </ul>
          </div>
       
       </div> 
    </nav>

  
    </div>
  </header>
</template>

<script>
export default {

  name: "Header",
};

</script>

<style lang='scss' scoped>
header {
  display: flex;
  align-items: center;
  color: white;
  height: 60px;
  line-height: 60px;
  /* background-color: #386db3; */
  background-image: linear-gradient(to right, #1e6650, #63987a);
  nav {
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
      .btn-custom{
         border: none;
         background: none;
         &:focus{
             border: 1px solid #fff;
         }
      }
      i{
        font-size: 20px;
        
      }


    .right {
      display: flex;
      align-items: center;
      .list {
        margin-bottom: 0;
        font-size: 22px;
        a {
          color: white;
          &:hover {
            color: #ff6600;
          }
        }
        li::after {
          display: block;
          position: absolute;
          content: "";
          top: 50px;
          left: 0;
          height: 1px;
          width: 0%;
          background-color: white;
          -webkit-transition: width 0.3s;
        }
        li {
          font-size: 15px;
          position: relative;
          /*  margin: 0 10px; */
          height: 100%;
          padding: 25px;
          &:hover {
            /* background-color: #043d6b;
                    transition: .5s; */
            &::after {
              width: 100%;
              transition: ease-in-out 0.3s;
            }
          }
        }
      }
    }
    .link-hamburger{
      display: block;
    }
    .hamburger{
      display: none;
   
    }
    .dropdown-menu{
      background-color: #56a7da;
    }
    
    @media all and (max-width: 776px) {
      .hamburger{
        display: block;
    
       
      }
      .links{
        display: none;
       
      }
     
   
}
  }
}
</style>
