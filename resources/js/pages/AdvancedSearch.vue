<template>
  <div class="container wrapper-top">
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
            <option value="">--Seleziona una specializzazione</option>
            <option
              v-for="(spec, key) in specs"
              :key="key"
              :value="spec"
              selected="false"
            >
              {{ spec }}
            </option>
          </select>
          <button
            class="btn btn-primary d-inline ml-3 search"
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
          <select name="orderByCount" id="orderByCount" v-model="orderByCount">
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
        v-if="(isEmpty == true) && initiated == true"
      >
        <h3>Nessun risultato per i parametri scelti</h3>
      </div>
      <div class="container d-flex flex-wrap">
        <Doctor
          v-for="(doctor, key) in filteredArray"
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
        />
      </div>
      <nav aria-label="Page navigation example" v-if="initiated">
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
            v-on:click="searchIndex(indice)"
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
    Doctor,
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
      isEmpty:false,
      isLoading: false,
      currentPage: 1,
      totalPages: null,
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
      this.searchnew(this.currentPage, "desc");
      this.orderBy = "desc";
    }
  },
  watch: {
    orderBy: function () {
      if (this.orderBy == "asc") {
        this.searchnew(1, "ASC");
      } else if (this.orderBy == "desc") {
        this.searchnew(1, "DESC");
      }
      this.orderByCount = "default";
    },

    orderByCount: function () {
      if (this.orderByCount == "asc") {
        this.searchbycount(1, "asc");
      } else if (this.orderByCount == "desc") {
        this.searchbycount(1, "desc");
      }
      this.orderBy = "default";
    },
  },

  methods: {
    inizioRicerca() {
      this.currentPage = 1;
      this.searchnew(this.currentPage, "desc");
      this.orderBy = "desc";
    },
    calcoloMedia() {
      this.filteredArray.forEach((doctor) => {
        let media = 0;
        for (let i = 0; i < doctor.reviews.length; i++) {
          media = media + doctor.reviews[i].vote;
        }
        doctor["media"] = media / doctor.reviews.length;
        if (isNaN(doctor.media)) doctor.media = 0;
      });
    },

    searchIndex(index) {
      console.log("ricerca su indice");
      if (this.orderBy != "default") {
        this.searchnew(index, this.orderBy);
      } else {
        this.searchbycount(index, this.orderByCount);
      }
    },
    searchbycount(page, orderBy) {
      this.filteredArray = [];
      this.currentPage = page;
      this.isLoading = true;
      this.initiated = true;
      console.log("cerco: ", this.mspecs);
      console.log("cerco pagina: ", this.currentPage);

      axios
        .get("http://127.0.0.1:8000/api/alldoctors", {
          params: { specname: this.mspecs, page: page, orderByCount: orderBy },
        })
        .then((res) => {
          console.log(res.data);
          this.totalPages = res.data.last_page;
          this.isLoading = false;
          this.filteredArray = res.data.data;
          if(this.filteredArray.length==0){
            this.isEmpty=true;
            this.currentPage=1
          }else{
            this.isEmpty=false
          }
          this.orderByCount = orderBy;
          this.calcoloMedia();
          console.log("array filtrato:", this.filteredArray);
        })
        .catch((err) => {
          console.error(err);
        });
    },
    searchnew(page, orderBy) {
      this.filteredArray = [];
      this.currentPage = page;
      this.isLoading = true;
      this.initiated = true;
      console.log("cerco: ", this.mspecs);
      console.log("cerco pagina: ", this.currentPage);

      axios
        .get("http://127.0.0.1:8000/api/alldoctors", {
          params: {
            specname: this.mspecs,
            page: page,
            orderByAverage: orderBy,
          },
        })
        .then((res) => {
          console.log(res.data);
          this.totalPages = res.data.last_page;
          this.isLoading = false;
          this.filteredArray = res.data.data;
          if(this.filteredArray.length==0){
            this.isEmpty=true;
            this.currentPage=1
          }else{
            this.isEmpty=false
          }
          this.calcoloMedia();
          console.log("array filtrato:", this.filteredArray);
        })
        .catch((err) => {
          console.error(err);
        });
    },
    nextpage(page) {
      console.log("pagina corrente:", page);
      if (page <= this.totalPages) {
        console.log("next");
        /* this.currentPage; */
        if (this.orderBy != "default")
          this.searchnew(++this.currentPage, this.orderBy);
        else {
          this.searchbycount(++this.currentPage, this.orderByCount);
        }
      }
    },
    prevpage(page) {
      console.log("pagina corrente:", page);
      if (page > 0) {
        this.currentPage--;
        if (this.orderBy != "default")
          this.searchnew(--this.currentPage, this.orderBy);
        else {
          this.searchbycount(--this.currentPage, this.orderByCount);
        }
      }
    },
    /* STAMPA SELECT SPECIALIZZAZIONI */
    getSpecs() {
      axios
        .get("http://127.0.0.1:8000/api/doctors/specs")
        .then((res) => {
          this.specs = res.data;
          /* console.log(this.specs) */
        })
        .catch((err) => {
          console.error(err);
        });
    },

  },
};
</script>

<style lang="scss" scoped>
.wrapper-top {
  min-height: calc(100vh - 14.8rem);
}

.search {
  margin-left: 15px;
  border: none;
  margin: 0 30px;
  background-image: linear-gradient(135deg, #1e6650 45%, #63987a);
  &:hover {
    background: linear-gradient(135deg, #63987a 45%, #1e6650);
    transition: 0.3s;
    box-shadow: 3px 7px 5px #888888;
  }
}
</style>
