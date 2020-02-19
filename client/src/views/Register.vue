<template>
<div id="signin" class="container">
    <div class="row mt-5">
        <div class="col-md-10 mx-auto">
            <form @submit.prevent="submit" class="form-style">
                <div class="form-group">
                    <label for="name">
                        Name
                    </label>

                    <input type="text" name="name" class="form-control" id="name" v-model="form.name">
                </div>
                <div class="form-group">
                    <label for="email">
                        Email
                    </label>

                    <input type="text" name="email" class="form-control" id="email" v-model="form.email">
                </div>
                <div class="form-group">
                    <label for="password">
                        Password
                    </label>

                    <input type="password" name="password" class="form-control" id="password" v-model="form.password">
                </div>
                <div>
                    <button type="submit" class="btn btn-dark">
                        Register
                    </button>
                </div>
            </form>
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
  tbody {
    background-color: #ffffff73;
  }
</style>

<script>
import axios from 'axios'
import { mapActions } from 'vuex'
export default {
    name: 'register',
    data() {
        return {
            form: {
                id: '',
                name: '',
                email: '',
                password: ''
            }
        }
    },
    methods: {
        // ...mapActions({
        //     signIn: 'auth/signIn'
        // }),
        submit() {
            axios.post('/register', { 
                id: this.id,
                name: this.form.name,
                email: this.form.email,
                password: this.form.password
            })
            .then((res) => {
                // this.$router.replace({
                //   name: 'List'
                console.log(res)
                }).catch(err => {
                    console.log(err)
            })
       }
    }
}

</script>