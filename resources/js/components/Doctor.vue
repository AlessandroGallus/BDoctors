<template>
    <div class="doctor-container">
        <div class="card" style="width: 18rem">
            <div class="premium-icon" v-if="sponsor_name != 'basic'">
                <i class="fas fa-bookmark"></i>
            </div>
            <img
                class="card-img-top"
                v-if="!url_img.startsWith('uploads')"
                :src="url_img"
                alt=""
            />
            <img class="storage" v-else :src="'storage/' + url_img" alt="" />
            <span class="badge badge-secondary">{{spec_name[0]['name']}}</span>

            <div class="card-infos container">
                <h6>Nome: {{ username }}</h6>
                <h6>Città: {{ city }}</h6>
                <h6>Specializzazione/i:</h6>
                <ul>
                    <li v-for="(spec, index) in spec_name" :key="index">
                        {{ spec.name }}
                    </li>
                </ul>
                <h6>
                    Media Voti:
                    {{ !isNaN(media) ? media : "Non disponibile" }} ({{
                        nReviews
                    }})
                </h6>

                <div class="stars d-flex">
                    <div class="star d-inline" v-for="index in 5" :key="index">
                        <i
                            v-if="index <= Math.round(media)"
                            class="fas fa-star"
                        ></i>
                        <i class="far fa-star" v-else></i>
                    </div>
                </div >
                <div class="text-center"><router-link
                    id="id"
                    :to="{
                        name: 'doctorPage',
                        params: { fullname: username, id: id }
                    }"
                    ><button class="btn btn-success profile ">Vedi Profilo</button></router-link>
                    </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Card",
    props: [
        "spec_name",
        "url_img",
        "username",
        "sponsor_name",
        "spec_name",
        "exp_date",
        "city",
        "id",
        "media",
        "nReviews"
    ],
    methods: {
        currentDate() {
            const current = new Date();
            const date = `${current.getFullYear()}-${current.getMonth() +
                1}-${current.getDate()}`;
            let scaduta = "- scaduto";
            let diff = Date.now() > new Date(this.exp_date).getTime();
            return diff;
        }
    }
};
</script>

<style lang="scss" scoped>
.stars{
    position: relative;
    width: 100%;
    &::after{
        position: absolute;
        top: 28px;
        content: '';
        display: block;
        transform: translate(-50%,-50%);
        width: 75%;
        left: 50%;
        height: 1px;
        background-color: black;
    }
}
.star {
    color: rgb(0, 0, 0);
    overflow: hidden;
}
.doctor-container {
    margin: 1px;
    margin-bottom: 50px;
    justify-content: space-between;
    padding: 10px 10px;
    background-size: cover;
    .doc-img {
        width: 397px;
    }
}
.card {
    position: relative;
    /* height: 286px; */
    .premium-icon {
        position: absolute;
        top: 5px;
        right: 10px;
        color: gold;
        font-size: 2rem;
        text-shadow: 2px 2px 1px #ff0000;
    }
    background-image: linear-gradient(#1e6650 45%, #63987a);
    overflow: hidden;
    /* padding-bottom: 20px; */
    /* border-radius: 25px; */
    &:hover {
        transition: 0.3s;
        transform: scale(1.05, 1.05);
        background-image: linear-gradient(#1e6650 45%, #63987a);
        box-shadow: 5px 5px 15px 5px rgba(0, 0, 0, 0.78);
        .card-infos{
        display: block;
        top:0%;
        }
    }
}
.card-infos{
    overflow: auto;
    display: block;
    padding:15px 15px;
    background-color: rgba($color: white, $alpha: .8);
    color:black;
    position: absolute;
    top: 100%;
    height: 100%;
    transition: top .3s;
    button.profile{
        border-radius: 25px;
        padding: 5px 25px;
        margin-top: 20px;
    }
}

li {
    list-style: none;
}
a {
    color: white;
    &:hover {
        color: #ff6600;
    }
}

.storage {
    height: 287px;
}
</style>
