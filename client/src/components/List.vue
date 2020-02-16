<template>
<div id="ratings" class="container">
  <div class="row">
    <div class="col-md-10 mx-auto">
  <form @submit.prevent="addRating">
    <div class="form-group">
      <label for="title">Title</label>
      <input v-model="title" type="text" class="form-control" id="title" placeholder="Enter Title">
    </div>
    <div class="input-group mb-3">
    <select v-model="type" class="custom-select" id="type">
      <option selected>Type</option>
      <option value="1">Film</option>
      <option value="2">TV</option>
      <option value="3">Book</option>
      <option value="4">Graphic Novel</option>
    </select>
    </div>
    <div class="form-group">
      <label for="rating">Rating</label>
      <input v-model="rating" type="text" class="form-control" id="rating" placeholder="0.0 to 10">
    </div>
    <div class="form-group">
      <label for="genre">Genre</label>
      <input v-model="genre" type="text" class="form-control" id="genre" placeholder="Genre">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  </div>
  </div>
  <div class="row">
    <div class="col-md-10 mx-auto">
  <h1>Rated</h1>
    
        <!-- <button @click="showContact(contact.id)" class="btn btn-default btn-xs">Edit</button> -->
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Type</th>
          <th scope="col">Rating</th>
          <th scope="col">Genre</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(title) in titles"
            :key="title.id">
          <th scope="row">{{title.id}}</th>
          <td>{{ title.title }}</td>
          <td>{{ title.type }}</td>
          <td>{{ title.rating }}</td>
          <td>{{ title.genre }}</td>
        </tr>
      </tbody>
    </table>
    </div>
    </div>
  </div>
  
</template>

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
        type: ''
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
        // this.title = '',
        // this.type = '',
        // this.rating = '',
        // this.genre = ''
        this.getRatings()
      
      }).catch(err => {
        console.log(err)
      })
    }
  }
}
</script>