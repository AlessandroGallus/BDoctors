<template>
    <div class="home">

        <!-- inizio carousel -->
                <div
            id="carouselExampleFade"
            class="carousel slide carousel-fade"

            data-bs-ride="carousel"
        >
            <div class="carousel-inner custom-item">
                <div class="carousel-item active">
                    <img
                        src="https://d3043uog1ad1l6.cloudfront.net/uploads/2020/06/Medicina-do-futuro.jpg"
                        class="d-block w-100 image-fluid"
                        alt="..."
                    />
                </div>
                <div class="carousel-item">
                    <img
                        src="https://www.mec2pc.it/wp-content/uploads/2017/06/banner22-2.jpg"
                        class="d-block w-100"
                        alt="..."
                    />
                </div>
                <div class="carousel-item">
                    <img
                        src="https://wallpapercave.com/wp/wp2217871.jpg"
                        class="d-block w-100"
                        alt="..."
                    />
                </div>
                <div class="carousel-item">
                    <img
                        src="https://saocamilo-sp.br/assets/uploads/topo-medicina-diagnostica-01.jpg"
                        class="d-block w-100"
                        alt="..."
                    />
                </div>
                <div class="carousel-item">
                    <img
                        src="https://images3.alphacoders.com/203/thumb-1920-203679.jpg"
                        class="d-block w-100"
                        alt="..."
                    />
                </div>
                <div class="carousel-item">
                    <img
                        src="https://wallpaperaccess.com/full/1267758.jpg"
                        class="d-block w-100"
                        alt="..."
                    />
                </div>
                <div class="carousel-item">
                    <img
                        src="https://pennystocks.news/wp-content/uploads/2020/07/geo.jpg"
                        class="d-block w-100"
                        alt="..."
                    />
                </div>
            </div>
        </div>
        <!-- fine carousel -->

        <div class="container inputs-ricerca d-flex">
            <input
                list="specializations"
                class="input-form form-control d-inline"
                @keyup.enter="searchdoctor()"
                v-model="ricerca"
                type="text"
                placeholder="Specializzazione"
            />
            <datalist v-bind:id="datalistID">
                <option
                    v-for="(spec, index) in specs"
                    :key="index"
                    :value="spec"
                ></option>
            </datalist>
            <router-link
                :to="{ name: 'advancedSearch', params: { spec: ricerca } }"
            >
                <button class="btn btn-primary d-inline ml-3 search">Vai a Ricerca Avanzata</button>
            </router-link>
        </div>

        <section>
            <div class="container title">
                <h3 class="mt-3">Lista dottori PREMIUM:</h3>
            </div>
            <div class="container doctor d-flex flex-wrap">
                <Doctor
                    v-for="(doctor, key) in premium"
                    :key="key"
                    :username="doctor.name"
                    :spec_name="doctor.specializations"
                    :url_img="doctor.url_img"
                    :sponsor_name="doctor.sponsors[0].name"
                    :exp_date="doctor.sponsors[0].pivot.expiring_date"
                    :city="doctor.city"
                    :id="doctor.id"
                    :media="doctor.media.toFixed(2)"
                    :nReviews="doctor.reviews.length"
                    :urlCv="doctor.url_cv"
                />
            </div>
        </section>

        <!-- CAROUSEL DA SISTEMARE -->
      <!--   <div
            id="carouselExampleIndicators"
            class="carousel slide"
            data-bs-ride="carousel"
        >
              <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
  </div>
            <div class="carousel-inner custom-item">
                <div class="carousel-item active">
                    <img
                        src="https://d3043uog1ad1l6.cloudfront.net/uploads/2020/06/Medicina-do-futuro.jpg"
                        class="d-block w-100 image-fluid"
                        alt="..."
                    />
                </div>
                <div class="carousel-item">
                    <img
                        src="https://www.mec2pc.it/wp-content/uploads/2017/06/banner22-2.jpg"
                        class="d-block w-100"
                        alt="..."
                    />
                </div>
                <div class="carousel-item">
                    <img
                        src="https://wallpapercave.com/wp/wp2217871.jpg"
                        class="d-block w-100"
                        alt="..."
                    />
                </div>
                <div class="carousel-item">
                    <img
                        src="https://saocamilo-sp.br/assets/uploads/topo-medicina-diagnostica-01.jpg"
                        class="d-block w-100"
                        alt="..."
                    />
                </div>
                <div class="carousel-item">
                    <img
                        src="https://images3.alphacoders.com/203/thumb-1920-203679.jpg"
                        class="d-block w-100"
                        alt="..."
                    />
                </div>
                <div class="carousel-item">
                    <img
                        src="https://wallpaperaccess.com/full/1267758.jpg"
                        class="d-block w-100"
                        alt="..."
                    />
                </div>
                <div class="carousel-item">
                    <img
                        src="https://pennystocks.news/wp-content/uploads/2020/07/geo.jpg"
                        class="d-block w-100"
                        alt="..."
                    />
                </div>
            </div>
         <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
        </div> -->
    <!-- FINE CAROUSEL-->
       <Jumbotron/>
    <section>
        <div class="prova">

        </div>
    </section>
    </div>

</template>

<script>
import axios from "axios";
import Doctor from "../components/Doctor.vue";
import Jumbotron from "../components/Jumbotron.vue";
export default {
    name: "DoctorList",
    components: {
        Doctor,
        Jumbotron
    },
    mounted() {
        this.getSpecs();
        this.premiumDoctor(this.currentPage);
    },
    data() {
        return {
            ricerca: "",
            premium: [],
            specs: [],
            datalistID: "ciao",
            currentPage:1,
            totalPages:null
        };
    },
    watch: {
        ricerca: function() {
            if (this.ricerca.length > 2) {
                this.datalistID = "specializations";
            } else {
                this.datalistID = "inactive";
            }
        },
        currentPage:function(){
            this.premium(this.currentPage);
        }
    },
    methods: {
        getSpecs() {
            axios
                .get("http://127.0.0.1:8000/api/doctors/specs")
                .then(res => {
                    this.specs = res.data;
                })
                .catch(err => {
                    console.error(err);
                });
        },
        calcoloMedia() {
            this.premium.forEach(doctor => {
                let media = 0;
                for (let i = 0; i < doctor.reviews.length; i++) {
                    media = media + doctor.reviews[i].vote;
                }
                doctor["media"] = media / doctor.reviews.length;
                if (isNaN(doctor.media)) doctor.media = 0;
            });
        },

        premiumDoctor(page) {
            axios
                .get("http://127.0.0.1:8000/api/alldoctors?premium",{params:{page:page}})
                .then(res => {
                    this.premium = res.data.data;
                    this.totalPages=res.data.last_page
                    this.calcoloMedia();
                    console.log("premium: ", this.premium);
                })
                .catch(err => {
                    console.error(err);
                });
        }
    }
};
</script>

<style lang="scss" scoped>
.home {
    margin-bottom: 50px;
    min-height: calc(100vh - 25.1rem);
}
.input-form {
    width: 50%;
    margin-right: 20px;
}
::placeholder {
    font-style: italic;
}


.carousel {
    height: 80vh;
    width: 100%;
    margin-bottom: 50px;
}

.custom-item {
    width: 100%;
    img {
        height: 80vh;
    }
}
a{
    text-decoration: none;
}
button {
    border: none;
    background-image: linear-gradient(135deg, #1e6650 45%, #63987a);
    &:hover {
        background: linear-gradient(135deg, #63987a 45%, #1e6650);
        transition: 0.3s;
        box-shadow: 3px 7px 5px #888888;
    }
}
</style>
