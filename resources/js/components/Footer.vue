<template>
    <footer>
        <div class="footer bg_dark_blue padding_top_60 padding_bottom_60 pt-3">
            <div class="container">
                <div class="row">
                    <div
                        class="col-xs-12 col-md-6 white_opacity_color text-center"
                    >
                        <p class="margin_top_10">
                            <router-link :to="{ name: 'home' }"
                                ><img
                                    src="../../../public/img/logo1.png"
                                    alt="Logo"
                            /></router-link>
                            &copy; bDoctors. All rights reserved.<br />
                        </p>
                        <ul class="social-icon">
                            <li>
                                <a
                                    target="_blank"
                                    href="https://twitter.com/idoctors_it"
                                    class="grey_white_link"
                                    ><i class="fab fa-twitter"></i
                                ></a>
                            </li>
                            <li>
                                <a
                                    target="_blank"
                                    href="https://www.facebook.com/iDoctors.it/"
                                    class="grey_white_link"
                                    ><i class="fab fa-facebook-square"></i
                                ></a>
                            </li>
                            <li>
                                <a
                                    target="_blank"
                                    href="https://www.instagram.com/idoctors.it/?hl=it"
                                    class="grey_white_link"
                                    ><i class="fab fa-instagram"></i
                                ></a>
                            </li>
                            <li>
                                <a
                                    target="_blank"
                                    href="https://www.youtube.com/watch?v=UzFbEJKoRWc"
                                    class="grey_white_link"
                                    ><i class="fab fa-youtube"></i
                                ></a>
                            </li>
                            <li>
                                <a
                                    target="_blank"
                                    href="https://www.linkedin.com/company/idoctors-it/about/"
                                    class="grey_white_link"
                                    ><i class="fab fa-linkedin"></i
                                ></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-md-6 text-center ">
                        <h3 class="white_color">Contatti</h3>
                        <ul class="vertical_menu">
                            <li>
                                <a
                                    target="_blank"
                                    href="https://github.com/merlino79"
                                    class="grey_white_link text-decoration-none"
                                    >Alessandro C. <i class="fab fa-github"></i
                                ></a>
                            </li>
                            <li>
                                <a
                                    target="_blank"
                                    href="https://github.com/AlessandroGallus"
                                    class="grey_white_link text-decoration-none"
                                    >Alessandro G. <i class="fab fa-github"></i
                                ></a>
                            </li>
                            <li>
                                <a
                                    target="_blank"
                                    href="https://github.com/AjayNaruka"
                                    class="grey_white_link text-decoration-none"
                                    >Ajay N. <i class="fab fa-github"></i
                                ></a>
                            </li>
                            <li>
                                <a
                                    target="_blank"
                                    href="https://github.com/bigoroberto"
                                    class="grey_white_link text-decoration-none"
                                    >Roberto B. <i class="fab fa-github"></i
                                ></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- /footer -->
</template>

<script>
export default {
    name: "Footer"
};
</script>

<style lang="scss" scoped>
footer {
    background-image: linear-gradient(to right, #1e6650, #63987a);
    justify-content: space-between;
}
ul.vertical_menu {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
ul.vertical_menu li {
    margin-bottom: 10px;
}
ul.social-icon {
    color: #fff;
    list-style-type: none;
    margin: 0;
    padding: 0;
    &:hover {
        color: #ff6600;
    }
}
ul.social-icon li {
    display: inline-block;
    margin-right: 10px;
    font-size: 1.5em;
}

a {
    color: #fff;
    &:hover {
        color: #ff6600;
    }
}

h3,
p {
    color: #fff;
    text-align: center;
}
img {
    width: 70px;
}
</style>
