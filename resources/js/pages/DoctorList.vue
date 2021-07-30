<template>
  <div class=" ">
  <h1 class="mb-3">LISTA DOTTORI:</h1>
    <div class="doctor container d-flex flex-wrap justify-content-center  ">
      <Doctor
    v-for="(doctor,key) in doctors"
    :key="key"
    :username='doctor.name'
    :spec_name='doctor.specializations[0].name'
    :url_img="doctor.url_img"
    :sponsor_name='doctor.sponsors[0].name'
    :exp_date='doctor.sponsors[0].pivot.expiring_date'
    :city='doctor.city'
    :id='doctor.id'
    :media='doctor.media'
    :nReviews="doctor.reviews.length"
    />
    </div>
     <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"
                v-on:click="prevpage(current_page-1)"
                :class="(current_page == 1) ? 'disabled' : null ">
                <button class="page-link">Prev</button></li>
            <li class="page-item"
                v-on:click="getDoctors(indice)"
                v-for="(indice, index) in this.total_pages"
               :key="index">
               <button class="page-link">{{indice}}</button>
            </li>

            <li class="page-item"
                v-on:click="nextpage(current_page+1)"
                :class="(current_page == total_pages) ? 'disabled' : null ">
                <button class="page-link">Next</button></li>
        </ul>
    </nav>
  </div>
</template>

<script>
import axios from 'axios'
import Doctor from '../components/Doctor.vue'
export default {
  name:'DoctorList',
  components:{
    Doctor
  },
  mounted(){
    this.getDoctors(1);
    this.current_page = 1;
  },
  data(){
    return{
      doctors:[],
      current_page: 1,
      total_pages : "",
    }
  },
  methods:{
    calcoloMedia() {
            this.doctors.forEach(doctor => {
                let media = 0;
                for (let i = 0; i < doctor.reviews.length; i++) {
                    media = media + doctor.reviews[i].vote;
                }
                doctor["media"] = media / doctor.reviews.length;
                if (isNaN(doctor.media)) doctor.media = 0;
                console.log("media", doctor["media"]);
            });
        },
    nextpage(page){
      console.log('pagina corrente:',page);
      if(page<=this.total_pages){
        this.current_page++;
        this.getDoctors(this.current_page);
      }
    },
    prevpage(page){
      console.log('pagina corrente:',page);
      if(page>=0){
        this.current_page--;
        this.getDoctors(this.current_page);
      }
    },

    getDoctors(page){
      this.current_page=page
        console.log(this.current_page);
      if(this.current_page !=1 || this.current_page != this.total_pages) this.doctors = [];
      axios.get('http://127.0.0.1:8000/api/doctors', {
          params: {
              page: page
              }
        })
      .then(res => {
        this.doctors=res.data.data;
        this.current_page = res.data.current_page;
        this.total_pages = res.data.last_page;
        console.log(this.doctors)
        this.calcoloMedia();
      })
      .catch(err => {
        console.error(err);
      })
    }
  }
}
</script>

<style lang="scss" scoped>
// .doctor{
//   width: 100%;
//   flex-basis: (100% / 4);
// }

</style>
