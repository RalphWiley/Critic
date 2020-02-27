<template>
<div id="friends" class="container">
    <h1>Hello</h1>
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
        email: '',
        friends: []
      }
    },
    
  methods: {
      submit() {
       
      axios({ method: 'POST', url: 'auth/send', headers: {autorization: localStorage.token}, data: { email: this.email } })
      .then( res => {
        console.log(res.data)
        
      
      }).catch(err => {
        console.log(err)
      })
  
      }
  }
}
</script>