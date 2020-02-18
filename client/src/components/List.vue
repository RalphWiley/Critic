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
        <button v-if="this.isEdit == false" type="submit" class="btn btn-dark">Submit</button>
        <button v-else type="button" @click="updateRating()" class="btn btn-dark">Edit</button>
      </form>
      </div>
  </div>
  <div class="row">
    <div class="col-md-10 mx-auto">
    <table class="table table-striped" id="ratingForm">
      <thead class="thead-dark">
        <tr>
          <th scope="col" @click="sortTable(0)">Title</th>
          <th scope="col" @click="sortTable(1)">Type</th>
          <th scope="col" @click="sortTable(2)">Rating</th>
          <th scope="col" @click="sortTable(3)">Genre</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(title) in titles"
            :key="title.id" :type="title.type">
          <td class="col-sm-1 title">{{ title.title }}</td>
          <td class="col-sm-2">{{ title.type }}</td>
          <td class="col-sm-2">{{ title.rating }}</td>
          <td class="col-sm-2">{{ title.genre }}</td>
          <td><button @click="editRating(title.title, title.id, title.rating, title.type, title.genre)" class="btn btn-default btn-xs btn-dark">Edit</button></td>
        </tr>
      </tbody>
    </table>
    </div>
    </div>
  </div>
  
</template>

<style>
  body {
    background-color: #477d5d9c;
  }
  #ratings {
    margin: 25px auto;
  }
  .form-style {
    background-color: #ffffff73;
    padding: 25px;
    border-radius: 5px;
  }
  .table td {
    vertical-align: middle;
  }
  .title {
    font-size: 20px;
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
      axios({ method: 'GET', url: '/ratings'})
        .then(
          res => {
            console.log(res.data)
            this.titles = res.data
          },
          err => console.log(err)
        )
        
      console.log(this.type);
    },
    addRating () {
      axios.post('/rating', { 
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
      axios.put(`/ratings/${this.id}`, 
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
    },
    sortTable(n){
      var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
      table = document.getElementById("ratingForm");
      console.log(table +'hi');
      switching = true;
      // Set the sorting direction to ascending:
      dir = "asc";
      /* Make a loop that will continue until no switching has been done: */
      while (switching) {
        // Start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /* Loop through all table rows (except the
        first, which contains table headers): */
        for (i = 1; i < (rows.length - 1); i++) {
          // Start by saying there should be no switching:
          shouldSwitch = false;
          /* Get the two elements you want to compare,
          one from current row and one from the next: */
          x = rows[i].getElementsByTagName("TD")[n];
          y = rows[i + 1].getElementsByTagName("TD")[n];
          /* Check if the two rows should switch place,
          based on the direction, asc or desc: */
          if (dir == "asc") {
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
              // If so, mark as a switch and break the loop:
              shouldSwitch = true;
              break;
            }
          } else if (dir == "desc") {
            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
              // If so, mark as a switch and break the loop:
              shouldSwitch = true;
              break;
            }
          }
        }
        if (shouldSwitch) {
          /* If a switch has been marked, make the switch
          and mark that a switch has been done: */
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
          // Each time a switch is done, increase this count by 1:
          switchcount ++;
        } else {
          /* If no switching has been done AND the direction is "asc",
          set the direction to "desc" and run the while loop again. */
          if (switchcount == 0 && dir == "asc") {
            dir = "desc";
            switching = true;
          }
        }
      }
    }
  }
}
</script>