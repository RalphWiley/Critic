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
    <div class="row" v-for="(user, index) in myFriends" :key="index">
        <div class="col-md-4">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" :id="'v-pills-'+index" :href="'#v-pills-'+index" :aria-controls="'v-pills-'+index" :class="{ active: index === activeItem }" data-toggle="pill" role="tab" @click="selectItem(index)">
                    {{user.friends.name}}
                </a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" :id="'v-pills-'+index" role="tabpanel" :aria-labelledby="'v-pills-'+index+'-tab'" :class="{ active: index === 0 }" v-if="index === activeItem">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Type</th>
                            </tr>
                        </thead>
                        <tbody class="ratings" v-for="(rating, index) in user.friends.user_rating" :key="index">
                            <td>{{rating.title}}</td>
                            <td>{{rating.rating}}</td>
                            <td>{{rating.type}}</td>
                        </tbody>
                    </table>
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

  .tab-content {
    background-color: white;
  }

  .ratings {
    font-weight: 300;
    padding-bottom: 10px;
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
            activeItem: null,
            myArray: [
                {
                    id: '',
                    name: '',
                    user_ratings: [
                        {
                            'title': '',
                            'type': '',
                            'rating': ''
                        }
                    ]
                }
            ]
        }
    },
    mounted: function () {
        this.getUser()
        this.getAllUsers()
        this.getRatings()
    }, 
    computed: {

        myFriends: function() {
            
            var myFriends = this.pendingFriends;
            var newFriendsRatings = this.ratings;
           
            for(var i = 0; i < myFriends.length; i++){
                
                this.myArray.push({'friends' : myFriends[i][0]});  
            }
            
            var friends = this.myArray.filter(user => user.name !== "");
           
            var trueFriends = friends.map(user => {
               var newRatings = this.ratings.filter(rating => rating.user_id === user.friends.id);
               user.friends['user_rating'] = newRatings;
            })
            
          return friends;
        }
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
      
    }
  }
}
</script>