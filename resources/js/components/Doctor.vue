<template>
  <div class="doctor-container">

    <div class="card" style="width: 18rem;">

              <img  class="card-img-top"
                  v-if="!url_img.startsWith('uploads')"
                  :src="url_img" alt="">
              <img class="storage" v-else :src="'storage/'+url_img" alt="">
    
            <h5 class="card-title">Doctor page</h5>
            <ul>
                  <li>nome: {{username}}</li>
                  <li>città: {{city}}</li>
                  <li>Specializzazione/i: {{spec_name}}</li>
                  <li>Media Voti: {{(!isNaN(media))? media: 'Non disponibile'}} ({{nReviews}})</li>
            </ul>
   
          <div class="stars d-flex">
              <div class="star d-inline "
              v-for="index in 5"
              :key="index"
              >
              <i v-if="index<=Math.round(media)" class="fas fa-star"></i>
              <i class="far fa-star" v-else ></i>
            </div>
         </div> 
         
          <div class="card-body">
            <h5>Sponsor: {{sponsor_name}}</h5>
            <h5>Scadenza Sponsor: {{exp_date}}</h5>
            <h5>Oggi: {{currentDate()}}</h5>
            <router-link id="id" :to="{name:'doctorPage',params:{'fullname':username,'id':id}}">Vedi Profilo</router-link> 
          </div>
     </div>
    <!-- <div class="doc-img">

      <img 
      v-if="!url_img.startsWith('uploads')"
     :src="url_img" alt="">
     <img class="storage" v-else :src="'storage/'+url_img" alt="">

    </div> -->

  </div>
</template>

<script>
export default {
  name:'Card',
  props:['spec_name','url_img','username','sponsor_name','spec_name','exp_date','city','id','media','nReviews'],
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
.star{
   color: rgb(243, 230, 148);
  overflow: hidden;
}
  .doctor-container{
   
    // width: 33%;
    // height: 550px;
    margin: 1px;
    margin-bottom:50px;
    justify-content:space-between;
    padding:10px 10px;
        // background: linear-gradient( #56a7da 45%, #386db3);
    background-size: cover;
    
    // border-radius: 20px;

    .doc-img{
        width:397px;
    }
  }
  .card{
     background: linear-gradient( #56a7da 45%, #386db3);
     overflow: hidden;
     border-radius: 25px ;
       &:hover{
            transition: 0.3s;
            transform: scale(1.05 ,1.05);
             background: linear-gradient(#75a3d6 45%, #56a7da);
            box-shadow: 5px 5px 15px 5px rgba(0,0,0,0.78)
            
           
          }
    
  }
  

  li{
    list-style: none;
   
  }
   a{
      color: white;
      &:hover{
        color: #ff6600;
      } 
    }
  
  .storage{
  
     height:287px ;
  }
</style>


