<template>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1>REVIEW</h1>

            <div class="row pt-5">
                <div class="col-md-10 mx-auto d-flex justify-content-around" align="center">
                    <div>
                        <img src="../assets/img/books.png" class="circle_icon"/>
                        <h5 class="pt-2 text-white">Books</h5>
                    </div>
                    <div>
                        <img src="../assets/img/games.png" class="circle_icon"/>
                        <h5 class="pt-2 text-white">Games</h5>
                    </div>
                    <div>
                        <img src="../assets/img/movies.jpg" class="circle_icon"/>
                        <h5 class="pt-2 text-white">Movies</h5>
                    </div>
                    <div>
                        <img src="../assets/img/tv_icon.png" class="circle_icon"/>
                        <h5 class="pt-2 text-white">TV</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
body{
  background-image: url('../assets/img/watching-movies.jpg');
  background-size: cover;
}
.jumbotron {
    margin: 50px;
    background-color: #343a40f2;
    height: 500px;
}

h1 {
    
  font-size: 50px;
}

.circle_icon {
    border: 5px solid black;
    border-radius: 50%;
    height: 150px;
    width:150px;
}

</style>

<script>
export default {
    name: 'Home'

}
</script>