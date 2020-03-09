<template>
<div id="friends" class="container">
    
    <div class="row mt-5 mb-5">
        <div class="col-10 mx-auto">
            <form @submit.prevent="submit" class="form-style">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter User Email" aria-label="Enter User Email" aria-describedby="basic-addon2" id="email" v-model="email">
                    <div class="input-group-append bg-dark">
                        <span class="input-group-text text-white" id="basic-addon2">Send Request</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-1" v-for="(user, index) in myFriends" :key="index">
        <div class="col-4">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action" :class="{ active: index === activeItem }" data-toggle="list" role="tab" :user="user" @click="selectItem(index)">
                    {{user[0]}}
                </a>
            </div>
        </div>
        <div class="col-8">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade active show" role="tabpanel" aria-labelledby="list-home-list">
                    {{user[1]}}
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

  .input-group-append {
      border-radius: 5px;
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
            // console.log(parsedFriends);
            // var friends = parsedFriends;
            var newFriends = parsedFriends.map(a=>a.map(function(val, index){
                return [val.name, val.id];
            }));
            // need to connect friends ratings 
            var newFriendsRatings = parsedRatings.map(a=> [a.rating, a.title, a.type, a.user_id]);

            const myFriends = [];

            const iterator = newFriends.values();
            for (const value of iterator){
                myFriends.push(value);
                
            }
            
            var myArray = [];
            for(var i = 0; i < myFriends.length; i++){
                myArray.push(myFriends[i][0]);  
            }

            for(var i = 0; i < myArray.length; i++){
                var users = myArray[i];
                 for (var x = 0; x < newFriendsRatings.length; x++){
                    var hello = newFriendsRatings[x];
                    if(users[1] === hello[3]){
                        myArray.push([users, hello]);
                       
                    }
               
                }
            }
            
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