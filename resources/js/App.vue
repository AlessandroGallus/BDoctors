<template>
  <div>
    <Header />
    <div>
      <router-view></router-view>
    </div>

    <Footer />
  </div>
</template>

<script>
import Header from "./components/Header.vue";

import Doctor from "./components/Doctor.vue";
import Footer from "./components/Footer.vue";

import axios from "axios";
export default {
  name: "App",
  components: {
    Header,
    Doctor,
    Footer,
  },
  mounted() {},
  data() {
    return {
      doctors: [],
    };
  },
};
</script>

<style lang="scss">
body{
    background: #d9ffe6;
    color: #666;
font-family: Arial,Verdana,sans-serif;
}

</style>
