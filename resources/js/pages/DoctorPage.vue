<template>
  <div class="doctor-page">

      <div class="wrapper">
          <div class="header">

              <div class="doc-details d-flex justify-content-between">
                  <div class="infos">
                    <h3>Indirizzo: {{doctor.address}}</h3>
                   <h3>Città: {{doctor.city}}</h3>
                   <h3>Telefono: {{doctor.phone_number}}</h3>
                    <div v-if="doctor.visit_types!=null">
                       <h3>Prestazioni:</h3>
                        <p>{{doctor.visit_types}}</p>
                    </div>
        <h3>Specializzazioni:</h3>
        <ul>
          <li
          v-for="(spec,index) in doctor.specializations"
          :key="index"
          >{{spec.name}}</li>
        </ul>
        <h3>Curriculum Vitae:</h3>
         <a target="_blank" :href="doctor.url_cv">Clicca qui per accedere al curriculum</a>
        <h3>Reviews:</h3>
        <ul>
          <li v-for="(review,index) in doctor.reviews" :key='index'>
            <p>{{review.description}} <span class="star d-inline"
    v-for="index in 5"
    :key="index"
    >
    <i v-if="index<=Math.round(review.vote)" class="fas fa-star"></i>
          <i class="far fa-star" v-else ></i>
    </span></p>
          </li>
        </ul>

                </div>
      <div class="doc-details d-flex justify-content-between">
        <div class="infos">
          <h4>
            Indirizzo: <span>{{ doctor.address }}</span>
          </h4>
          <h4>
            Città: <span>{{ doctor.city }}</span>
          </h4>
          <h4>
            Telefono: <span>{{ doctor.phone_number }}</span>
          </h4>
          <h4>Specializzazioni:</h4>
          <ul>
            <li v-for="(spec, index) in doctor.specializations" :key="index">
              {{ spec.name }}
            </li>
          </ul>
          <h4>Curriculum Vitae:</h4>
          <a target="_blank" :href="doctor.url_cv"
            >Clicca qui per accedere al curriculum</a
          >
          <h4>Reviews:</h4>
          <ul>
            <li v-for="(review, index) in doctor.reviews" :key="index">
              <p>
                {{ review.description }}
                <span class="star d-inline" v-for="index in 5" :key="index">
                  <i
                    v-if="index <= Math.round(review.vote)"
                    class="fas fa-star"
                  ></i>
                  <i class="far fa-star" v-else></i>
                </span>
              </p>
            </li>
          </ul>
        </div>
        <div class="img">
          <img :src="doctor.url_img" alt="" />
        </div>
      </div>
      <div class="msgNot" v-if="msgNot">
        <h3>MESSAGGIO INVIATO CORRETTAMENTE</h3>
      </div>
              </div>
    <div class="buttons">
      <button
        class="btn btn-primary"
        type="button"
        v-on:click="
          () => {
            isHidden = !isHidden;
            isHiddenReview = true;
          }
        "
      >
        Invia Messaggio
      </button>
      <button
        class="btn btn-primary"
        type="button"
        v-on:click="
          () => {
            isHiddenReview = !isHiddenReview;
            isHidden = true;
          }
        "
      >
        Invia Recensione
      </button>
    </div>

    <!-- MESSAGE FORM -->

    <div class="form" v-if="!isHidden">
      <ContactForm @confermaInviato="confirmSent()" :doctorId="doctor.id" />
    </div>

    <div class="form" v-if="!isHiddenReview">
      <ReviewForm :doctorId="doctor.id" />
    </div>
  </div>
  </div>
  </div>
</template>

<script>
import axios from "axios";
import ContactForm from "../components/ContactForm.vue";
import ReviewForm from "../components/ReviewForm.vue";
export default {
  name: "DoctorPage",
  components: {
    ContactForm,
    ReviewForm,
  },
  data() {
    return {
      doctor: {},
      isHidden: true,
      isHiddenReview: true,
      msgNot: false,
    };
  },
  mounted() {
    console.log("id", this.$route.params.id);
    this.getDoctorById();
  },
  methods: {
    confirmSent() {
      this.isHidden = true;
      this.msgNot = true;
    },
    getDoctorById() {
      axios
        .get("http://127.0.0.1:8000/api/doctors/" + this.$route.params.id)
        .then((res) => {
          this.doctor = res.data;
          console.log(this.doctor);
          if (this.doctor.url_img.startsWith("uploads")) {
            this.doctor.url_img = "../storage/" + this.doctor.url_img;
          }
        })
        .catch((err) => {
          console.error(err);
        });
    },
  },
};
</script>

<style lang='scss' scoped>
.doctor-page {
  margin-bottom: 7.1rem;
  min-height: calc(100vh - 25.1rem);
}
/* .container-top {
  min-height: calc(100vh - 15.8rem);
} */
.wrapper {
  width: 40%;
  margin: 0 auto;
  margin-top: 50px;
  border-radius: 16px;
  margin-bottom: 20px;
  border: 3px solid #676161;
  overflow: hidden;
  background-image: url("https://img.freepik.com/premium-vector/abstract-medical-background-with-icons-symbols-template-with-concept-idea-healthcare-technology-innovation-medicine-health-science-research_120542-540.jpg?size=626&ext=jpg&ga=GA1.2.1623233742.1618531200");
  background-size: cover;
  .header {
    width: 100%;
    height: 70px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 30px;
    background-image: linear-gradient(135deg, #1e6650 45%, #63987a);
    /*       border-radius: 16px 16px 0 0; */
  }
  .infos {
    margin-left: 30px;
    /*     h3{
            font-size: 30px;
        } */
    a {
      font-size: 16px;
      color: rgb(50, 13, 153);
    }
    span {
      font-size: 20px;
    }
    i {
      font-size: 18px;
      color: #1e6650;
    }
  }
  img {
    width: 150px;
    margin-right: 50px;
  }
}
.buttons {
  width: 100%;
  height: 50px;
  display: flex;
  justify-content: center;
  button {
    border: none;
    margin: 0 30px;
    background-image: linear-gradient(135deg, #1e6650 45%, #63987a);
    &:hover {
      background: linear-gradient(135deg, #63987a 45%, #1e6650);
      transition: 0.3s;
      box-shadow: 3px 7px 5px #888888;
    }
  }
}
</style>
