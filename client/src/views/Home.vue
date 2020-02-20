<template>
    <div class="special">
        <div class="infoCard">
        <div class="container">
            <h3 class="text-white text-center pt-5">Keep track of all your</h3>
            <div class="row pt-5">
                <div class="col col-md-10 mx-auto d-flex justify-content-around" align="center">
                    <div class="move">
                        <img src="../assets/img/books.png" class="circle_icon"/>
                        <h5 class="pt-2 text-white">Books</h5>
                    </div>
                    <div class="move">
                        <img src="../assets/img/games.png" class="circle_icon"/>
                        <h5 class="pt-2 text-white">Games</h5>
                    </div>
                    <div class="move">
                        <img src="../assets/img/movies.png" class="circle_icon"/>
                        <h5 class="pt-2 text-white">Movies</h5>
                    </div>
                    <div class="move">
                        <img src="../assets/img/tv_icon.png" class="circle_icon"/>
                        <h5 class="pt-2 text-white">TV</h5>
                    </div>
                </div>
            </div>
            <div class="row pt-5 pb-5 mx-auto d-flex justify-content-center">
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2 btn-move">
                    <router-link class="nav-link d-flex justify-content-center" :to="{ name: 'signin' }">
                        <button class="btn">Sign In</button>
                    </router-link>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2 btn-move">
                    <router-link class="nav-link d-flex justify-content-center" :to="{ name: 'register' }">
                        <button class="btn">Register
                            <svg class="bi bi-chevron-right" width="20" height="20" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6.646 3.646a.5.5 0 01.708 0l6 6a.5.5 0 010 .708l-6 6a.5.5 0 01-.708-.708L12.293 10 6.646 4.354a.5.5 0 010-.708z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>
<style>
.special {
    background: url('../assets/img/watching-movies.jpg') no-repeat;
    background-size: cover;
    overflow:hidden;
    width: 100%;
    min-height: 100vh;
}

.infoCard {
    background-color: #343a40f2;
    margin: 50px auto;
    padding: 10px;
    width: 80%;
    font-family: 'Noto Serif', serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

h1 {
  font-size: 50px;
}

.circle_icon {
    position: relative;
    border: 3px solid black;
    border-radius: 50%;
    height: 75px;
    width: 75px;
    box-shadow: 1px 1px 10px black;
}

.btn {
    background-color: #477d5d;
    font-size: 15px;
    font-weight: bold;
    padding: 5px;
    width: 100px;
}

svg {
    padding-left: 5px;
    font-weight: bold;
}
@media screen and (min-width: 768px) {
    .circle_icon {
        border-radius: 50%;
        height: 125px;
        width: 125px;
    }

    .btn {
        font-size: 15px;
        padding: 15px;
        min-width: 125px;
    }
}
</style>

<script>
import gsap from 'gsap'
export default {
    name: 'Home',
    data () {
        return {

        }
    },
    mounted: function () {
    var tl = gsap.timeline();
        tl.from(".move", { duration: 1, opacity: 0, y: "random(-400,400)" });
        tl.from(".btn-move", { duration: 1.5, opacity: 0, scale: 0.3, ease: "back", stagger: 0.25 });
  },
    
}
</script>