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
                        Register
                    </button>
                </div>  
            </form>
        </div>
    </div>
    <div class="row mt-3" v-for="(user, index) in myFriends" :key="index">
        <div class="col-4">
            <div :class="{ 'is-active': index.isActive }" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action" data-toggle="list" :href="user.href" role="tab"  @click="selectTab(index)">
                    {{user}}
                </a>
            </div>
        </div>
        <div class="col-8">
            <div v-show="isActive" class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show" :id="{index}" role="tabpanel" aria-labelledby="list-home-list">{{user}}</div>
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
        recipient: [],
        selected: '',
        isActive: false
      }
    },
    mounted() {
        this.getUser()
        this.getAllUsers()
        this.isActive = this.selected;
    },
    computed:  {
      myFriends () {
        // get users id and email
        const users = this.allUsers.map(e => [e.id, e.email]);
        //gets recipient id from getFriends request
        const friends = this.pendingFriends.map(a => a.recipient_id);
        
        // match recipient id to a user id and get name back
        for (let i = 0; i < friends.length; i++){
            
            for (let x = 0; x < users.length; x++){
                
                if(friends[i] === users[x][0]){
                    this.recipient.push(users[x][1]);
                }
            }
        }
        
        const myFriends = this.recipient;
        return myFriends;   
        
      },
      href() {
            return '#' + this.user.toLowerCase().replace(/ /g, '-');
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
      async getFriendRequests(id) {
          await axios.get(`auth/requests/${this.id}`).then(
              res => {
                  this.pendingFriends = res.data
              },
              err => console.log(err)
          )
      },
      selectTab(selectedUser) {
            this.recipient.forEach(user => {
                user.isActive = (user.index == selectedUser.index);
                console.log(user)
            });
        }
  }
}
</script>