<template>
<div id="friends" class="container">
    <h1>Friends</h1>
    <div class="row">
        <div class="col-10">
            <form @submit.prevent="submit" class="form-style">
                <div class="form-group">
                    <label for="email">
                        Email
                    </label>

                    <input type="text" name="email" class="form-control" id="email" v-model="email">
                </div>
                <div>
                    <button type="submit" class="btn btn-dark">
                        Send Request
                    </button>
                </div>  
            </form>
        </div>
    </div>
    <div class="row mt-3" v-for="(user, index) in myFriends" :key="index">
        <div class="col-4">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action" :class="{ active: index === activeItem }" data-toggle="list" role="tab" :user="user" @click="selectItem(index)">
                    {{user}}
                </a>
            </div>
        </div>
        <div class="col-8">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade active show" role="tabpanel" aria-labelledby="list-home-list">
                    {{index}}
                </div>
            </div>
        </div>
    </div>    
</div>
</template>

<style>
 body {
    background-color: #477d5d9c;
  }
.form-style {
    background-color: #ffffff73;
    padding: 25px;
    border-radius: 5px;
  }

  .current{
  background:rgb(56,184,131);
}
</style>

<script>
import axios from 'axios'
export default {
    data(){
        return {
            id: '',
            email: '',
            name: '',
            user: [],
            allUsers: [],
            pendingFriends: [],
            ratings: [],
            recipient: [],
            current: 0,
            activeItem: null
        }
    },
    mounted: function () {
        this.getUser()
        this.getAllUsers()
        this.getRatings()
    }, 
    computed: {
        myFriends: function() {
            
            var parsedFriends = this.pendingFriends;
            var parsedRatings = this.ratings;
            console.log(parsedRatings);
            // var friends = parsedFriends;
            var newFriends = parsedFriends.map(a=>a.map(function(val, index){
                return val.name;
            }));
            const myFriends = [];

            const iterator = newFriends.values();
            for (const value of iterator){
                myFriends.push(value);
                
            }
            var myArray = [];
            for(var i = 0; i < myFriends.length; i++){
                myArray.push(myFriends[i][0])
            }
            console.log(myArray);
            
            return myArray;
        },
    },
  methods: {
      submit() {
        axios({ 
            method: 'POST', 
            url: 'auth/send', 
            headers: {autorization: localStorage.token}, 
            data: { 
                email: this.email, 
            } 
        })
        .then( res => {
            // console.log('Post ' + JSON.stringify(res.data))
            this.recipient.push(res.data.recipient)
            this.getFriendRequests(this.id)
        }).catch(err => {
            console.log(err)
        })
        this.email = ''
      },
      getAllUsers(){
        axios.get('auth/users').then(
            res => {
              this.allUsers = res.data
            },
            err => console.log(err)
          )
      },
      getUser() {
        axios.get('auth/me').then(
        res => {
            this.id = res.data.id
            this.user = res.data
            this.getFriendRequests(this.id)
        },
        err => console.log(err)
        )
      },
      getFriendRequests(id) {
        axios.get(`auth/friends/${this.id}`).then(
              res => {
                  this.pendingFriends = res.data
                //   console.log('Get Requests ' + JSON.stringify(this.friends))
              },
              err => console.log(err)
          )
      },
      selectItem(index){
          this.activeItem = index;
      },
      getRatings () {

      axios({ method: 'GET', url: `/ratings`})
        .then( 
          res => {
            console.log('getRatings ' + res.data)
            this.ratings = res.data
          },
          err => console.log(err)
        )
      
    },
  }
}
</script>