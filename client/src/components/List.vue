<template>
<div id="ratings" class="container">
  <div class="row mb-5">
    <div class="col-md-10 mx-auto">
      <form @submit.prevent="addRating" class="form-style">
        <div class="form-group">
          <label for="title">Title</label>
          <input v-model="title" type="text" class="form-control" id="title" placeholder="Enter Title">
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="type">Type</label>
            <select v-model="type" class="custom-select" id="type">
              <option selected>{{ title.type }}</option>
              <option value="1">Film</option>
              <option value="2">TV</option>
              <option value="3">Book</option>
              <option value="4">Graphic Novel</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="rating">Rating</label>
            <input v-model="rating" type="text" class="form-control" id="rating" placeholder="0.0 to 10">
          </div>
        </div>
        <div class="form-group">
          <label for="genre">Genre</label>
          <input v-model="genre" type="text" class="form-control" id="genre" placeholder="Genre">
        </div>
        <button v-if="this.isEdit == false" type="submit" class="btn btn-primary">Submit</button>
        <button v-else type="button" @click="updateRating()" class="btn btn-primary">Edit</button>
      </form>
      </div>
  </div>
  <div class="row">
    <div class="col-md-10 mx-auto">
  <h1>Rated</h1>
    
        <!-- <button @click="showContact(contact.id)" class="btn btn-default btn-xs">Edit</button> -->
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Title</th>
          <th scope="col">Type</th>
          <th scope="col">Rating</th>
          <th scope="col">Genre</th>
          <th scope="col-1"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(title) in titles"
            :key="title.id">
          <td>{{ title.title }}</td>
          <td>{{ title.type }}</td>
          <td>{{ title.rating }}</td>
          <td>{{ title.genre }}</td>
          <td><button @click="editRating(title.title, title.id, title.rating, title.type, title.genre)" class="btn btn-default btn-xs">Edit</button></td>
        </tr>
      </tbody>
    </table>
    </div>
    </div>
  </div>
  
</template>

<style>
  #ratings {
    margin: 25px auto;
  }
  .form-style {
    background-color: #ddd;
    padding: 25px;
    border-radius: 5px;
  }
</style>

<script>
import axios from 'axios'
export default {
  data(){
    return {
      titles: [],
      id: '',
      title: '',
      rating: '',
      genre: '',
      type: '',
      isEdit: false
      }
    },
  mounted: function () {
    this.getRatings()
    console.log('Component mounted')
  },
  methods: {
    getRatings () {
      axios({ method: 'GET', url: '/api/ratings'})
        .then(
          res => {
            console.log(res.data)
            this.titles = res.data
          },
          err => console.log(err)
        )
    },
    addRating () {
      axios.post('/api/rating', { 
        id: this.id,
        title: this.title,
        rating: this.rating,
        type: this.type,
        genre: this.genre
        })
      .then( res => {
        console.log(res)
        this.getRatings()
      
      }).catch(err => {
        console.log(err)
      })
    },
    editRating(title, id, rating, type, genre){
      this.id = id
      this.title = title
      this.rating = rating
      this.type = type
      this.genre = genre
      this.isEdit = true
    },
    updateRating(){
      axios.put(`/api/ratings/${this.id}`, 
      { id: this.id,
        title: this.title,
        rating: this.rating,
        type: this.type,
        genre: this.genre
      })
      .then(res => {
        this.title = ''
        this.rating = ''
        this.type = ''
        this.genre = ''
        this.isEdit = false
        this.getRatings()
        console.log(res)
      })
      .catch(err => {
        console.log(err)
      })
    }
  }
}
</script>