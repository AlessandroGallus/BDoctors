<template>
    <div>
        <h2>RICERCA AVANZATA</h2>
        <div class="ricerca">
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
                            selected="false"
                            >{{ spec }}</option
                        >
                    </select>
                    <button
                        class="btn btn-primary d-inline ml-3"
                        v-on:click="inizioRicerca()"
                    >
                        Cerca
                    </button>
                </div>

                <div>
                    <label for="orderBy">Media voti:</label>
                    <select name="orderBy" id="orderBy" v-model="orderBy">
                        <option value="default" disabled>--Seleziona--</option>
                        <option value="asc">Crescente</option>
                        <option value="desc">Decrescente</option>
                    </select>
                </div>
                <div>
                    <label for="orderByCount">Numero recensioni:</label>
                    <select
                        name="orderByCount"
                        id="orderByCount"
                        v-model="orderByCount"
                    >
                        <option value="default" disabled>--Seleziona--</option>
                        <option value="asc">Crescente</option>
                        <option value="desc">Decrescente</option>
                    </select>
                </div>
            </div>
            <div class="result"></div>
            <div v-if="isLoading"><h1>LOADING...</h1></div>
            <div
                class="noResult"
                v-if="filteredArray.length == 0 && initiated == true"
            >
                <h3>Nessun risultato per i parametri scelti</h3>
            </div>
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
                    :nReviews="doctor.reviews.length"
                />
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li
                        class="page-item"
                        v-on:click="prevpage(currentPage - 1)"
                        :class="currentPage == 1 ? 'disabled' : null"
                    >
                        <button class="page-link">Prev</button>
                    </li>
                    <li
                        class="page-item"
                        v-for="(indice, index) in this.totalPages"
                        v-on:click="searchnew(indice)"
                        :key="index"
                    >
                        <button class="page-link">{{ indice }}</button>
                    </li>

                    <li
                        class="page-item"
                        v-on:click="nextpage(currentPage + 1)"
                        :class="currentPage == totalPages ? 'disabled' : null"
                    >
                        <button class="page-link">Next</button>
                    </li>
                </ul>
            </nav>
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
            orderBy: "default",
            orderByCount: "default",
            initiated: false,
            isLoading: false,
            currentPage: 1,
            totalPages: null
        };
    },

    mounted() {
        console.log(this.filteredArray.length);
        console.log(this.initiated);
        this.getSpecs();
        console.log("params", this.$route.params.spec);
        console.log(this.$route.params.spec);
       

        if (this.$route.params.spec != undefined) {
            this.mspecs = this.$route.params.spec;
            this.searchnew(this.currentPage,'desc');
            this.orderBy='desc'
        }
    },
    watch: {
        orderBy: function() {
            if (this.orderBy == "asc") {
                this.searchnew(1,'ASC');
            } else if (this.orderBy == "desc") {
                this.searchnew(1,'DESC');
            }
            this.orderByCount='default'
        },

        orderByCount: function() {
            if (this.orderByCount == "asc") {
                this.searchbycount(1,'asc');
            } else if (this.orderByCount == "desc") {
                this.searchbycount(1,'desc');
            }
            this.orderBy='default'
        }
    },

    methods: {
        
        inizioRicerca() {
            this.currentPage = 1;
            this.searchnew(this.currentPage,'desc');
            this.orderBy='desc'
        },
        calcoloMedia() {
            this.filteredArray.forEach(doctor => {
                let media = 0;
                for (let i = 0; i < doctor.reviews.length; i++) {
                    media = media + doctor.reviews[i].vote;
                }
                doctor["media"] = media / doctor.reviews.length;
                if (isNaN(doctor.media)) doctor.media = 0;
            });
        },



    searchbycount(page,orderBy){
        this.filteredArray=[];
            this.currentPage = page;
            this.isLoading = true;
            this.initiated = true;
            console.log("cerco: ", this.mspecs);
            console.log("cerco pagina: ", this.currentPage);

            axios
                .get("http://127.0.0.1:8000/api/alldoctors", {
                    params: { specname: this.mspecs, page: page, orderByCount:orderBy }
                })
                .then(res => {
                    console.log(res.data);
                    this.totalPages = res.data.last_page;
                    this.isLoading = false;
                    this.filteredArray = res.data.data;
                    this.orderByCount=orderBy;
                    this.calcoloMedia();
                    console.log('array filtrato:',this.filteredArray);
                })
                .catch(err => {
                    console.error(err);
                });
    },
        searchnew(page,orderBy) {
            this.filteredArray=[];
            this.currentPage = page;
            this.isLoading = true;
            this.initiated = true;
            console.log("cerco: ", this.mspecs);
            console.log("cerco pagina: ", this.currentPage);

            axios
                .get("http://127.0.0.1:8000/api/alldoctors", {
                    params: { specname: this.mspecs, page: page, orderByAverage:orderBy }
                })
                .then(res => {
                    console.log(res.data);
                    this.totalPages = res.data.last_page;
                    this.isLoading = false;
                    this.filteredArray = res.data.data;
                    this.calcoloMedia();
                    console.log('array filtrato:',this.filteredArray);
                })
                .catch(err => {
                    console.error(err);
                });
        },
        nextpage(page) {
            console.log("pagina corrente:", page);
            if (page <= this.totalPages) {
                console.log("next");
                /* this.currentPage; */
                this.searchnew(++this.currentPage);
            }
        },
        prevpage(page) {
            console.log("pagina corrente:", page);
            if (page >= 0) {
                this.currentPage--;
                this.searchnew(this.currentPage);
            }
        },
        /* STAMPA SELECT SPECIALIZZAZIONI */
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
        }
        /* getDoctors() {
            axios
                .get("http://127.0.0.1:8000/api/alldoctors",{params:{specname:this.mspecs}})
                .then(res => {
                    this.doctors = res.data;
                    this.calcoloMedia();
                    console.log(this.doctors)
                })
                .catch(err => {
                    console.error(err);
                });
        }, */
        /* getCities() {
            axios
                .get("http://127.0.0.1:8000/api/cities")
                .then(res => {
                    this.cities = res.data;
                })
                .catch(err => {
                    console.error(err);
                });
        } */
        /* search() {
            this.initiated=true;
            this.filteredArray = [];
            console.log("cerco: ",this.mspecs);
            console.log(this.doctors);
            for (let i = 0; i < this.doctors.length; i++) {
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
            console.log('array',this.filteredArray);
            this.filteredArray.sort(function(a, b) {
                    return b.media - a.media;
                });

        }, */
    }
};
</script>

<style></style>
