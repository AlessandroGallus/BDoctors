<template>
    <div>
        <h2>RICERCA AVANZATA</h2>
        <div class="ricerca">
            <!-- <input type="text" v-model="city" placeholder="Città"> -->
            <!-- <select name="cities" id="cities" v-model="mcity">
        <option value="">--Seleziona una città</option>
          <option 
      v-for="(city,key) in cities"
      :key="key"
      :value="city.city">{{city.city}}</option>
      </select> -->
            <div class="inputs-ricerca d-flex justify-content-between mb-5">
                <div class="d-flex">
                    <select 
                        name="specs"
                        id="specs"
                        v-model="mspecs"
                        class="form-control d-inline"
                    >
                        <option value=""
                            >--Seleziona una specializzazione</option
                        >
                        <option
                            v-for="(spec, key) in specs"
                            :key="key"
                            :value="spec"
                            >{{ spec }}</option
                        >
                    </select>
                    <button class="btn btn-primary d-inline ml-3" v-on:click="search">
                    Cerca
                </button>
                </div>

                
                <div>
                    <label for="orderBy">Media voti:</label>
                    <select name="orderBy" id="orderBy" v-model="orderBy">
                        <option value="asc">Crescente</option>
                        <option value="desc">Decrescente</option>
                    </select>
                </div>
                
            </div>
            <div class="result"></div>
                <div class="noResult" v-if="filteredArray.length==0 && initiated==true"><h3>Nessun risultato per i parametri scelti</h3></div>
                <div class="container" v-else>
                    <Doctor
                        v-for="(doctor, key) in filteredArray"
                        :key="key"
                        :username="doctor.name"
                        :spec_name="doctor.specializations[0].name"
                        :url_img="doctor.url_img"
                        :sponsor_name="doctor.sponsors[0].name"
                        :exp_date="doctor.sponsors[0].pivot.expiring_date"
                        :city="doctor.city"
                        :id="doctor.id"
                        :media="doctor.media"
                    />
                </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Doctor from "../components/Doctor.vue";
export default {
    name: "AdvancedSearch",
    components: {
        Doctor
    },
    data() {
        return {
            filteredArray: [],
            specs: [],
            mcity: "",
            mspecs: "",
            doctors: [],
            cities: [],
            orderBy: "desc",
            initiated:false
        };
    },

    mounted() {
        this.getSpecs();
        this.getDoctors();
        this.getCities();
    },
    watch: {
        orderBy: function() {
            if (this.orderBy == "asc") {
                this.filteredArray.sort(function(a, b) {
                    return a.media - b.media;
                });
            } else if (this.orderBy == "desc") {
                this.filteredArray.sort(function(a, b) {
                    return b.media - a.media;
                });
            }
        }
    },
    methods: {
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
        search() {
            this.initiated=true;
            this.filteredArray = [];
            console.log("test");
            console.log(this.mcity);
            console.log(this.mspecs);
            /* this.filteredArray = this.doctors.filter((doctor)=>{
        if(doctor.city==this.city && doctor.specializations[0].name==this.mspecs){
          return doctor;
        }
      }); */
            for (let i = 0; i < this.doctors.length; i++) {
                // RICERCA CASO MULTIPLE SPECIALIZZAZIONI
                for (
                    let j = 0;
                    j < this.doctors[i].specializations.length;
                    j++
                ) {
                    if (
                        this.doctors[i].specializations[j].name == this.mspecs
                    ) {
                        console.log("trovato");
                        if (!this.filteredArray.includes(this.doctors[i])) {
                            this.filteredArray.push(this.doctors[i]);
                        }
                    } else {
                        console.log("non trovato");
                    }
                }
            }
        },
        getSpecs() {
            axios
                .get("http://127.0.0.1:8000/api/doctors/specs")
                .then(res => {
                    this.specs = res.data;
                    /* console.log(this.specs) */
                })
                .catch(err => {
                    console.error(err);
                });
        },
        getDoctors() {
            axios
                .get("http://127.0.0.1:8000/api/doctors-spec")
                .then(res => {
                    this.doctors = res.data;
                    this.calcoloMedia();
                    /* console.log(this.doctors) */
                })
                .catch(err => {
                    console.error(err);
                });
        },
        getCities() {
            axios
                .get("http://127.0.0.1:8000/api/cities")
                .then(res => {
                    this.cities = res.data;
                })
                .catch(err => {
                    console.error(err);
                });
        }
    }
};
</script>

<style></style>
