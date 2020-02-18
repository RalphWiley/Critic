<template>
<div id="signin" class="container">
    <div class="row mt-5">
        <div class="col-md-10 mx-auto">
            <form @submit.prevent="submit" class="form-style">
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
                        Sign In
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
import { mapActions } from 'vuex'
export default {
    name: 'signin',
    data() {
        return {
            form: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        ...mapActions({
            signIn: 'auth/signIn'
        }),
        submit() {
          this.signIn(this.form).then(() => {
              this.$router.replace({
                  name: 'List'
              }).catch(() => {
                  console.log('failed')
              })
          })
       }
    }
}
</script>