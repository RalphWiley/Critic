<template>
<div>
  <form>
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" placeholder="Enter Title">
    </div>
    <div class="input-group mb-3">
    <select class="custom-select" id="type">
      <option selected>Type</option>
      <option value="1">Film</option>
      <option value="2">TV</option>
      <option value="3">Book</option>
      <option value="4">Graphic Novel</option>
    </select>
  </div>
  <div class="input-group mb-3">
    <select class="custom-select" id="rating">
      <option selected>Rate</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
    </select>
  </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  <h1>Rated</h1>
    <ul class="list-group">
      <li class="list-group-item" 
          v-for="(title, index) in titles"
          :key="index">
        <strong>{{title.name}}</strong> {{title.rating}}
        <!-- <button @click="showContact(contact.id)" class="btn btn-default btn-xs">Edit</button> -->
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data(){
    return {
      titles: [],
      title: {
        id: '',
        name: '',
        rating: '',
        genre: ''
      },
      type: {
        book: '',
        movie: '',
        tv: '',
        graphic: ''
      }
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
    }
  }
}
</script>