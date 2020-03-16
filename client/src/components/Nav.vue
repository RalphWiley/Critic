<template>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <h1 class="text-white">REVIEW</h1>
    <ul class="nav ml-auto">
        <!-- <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'home' }">
            Home
            </router-link>
        </li> -->
        <template v-if="authenticated">
            <li class="nav-item my-auto">
                <router-link class="nav-link" :to="{ name: 'List' }">
                    {{ user.name }}
                </router-link>
            </li>
            <li class="nav-item my-auto">
                <router-link class="nav-link" :to="{ name: 'Friends' }">
                    Friends
                </router-link>
            </li>
            <li class="nav-item my-auto">
                <a href="#" @click.prevent="signOut" class="nav-link">
                    Sign Out
                </a>
            </li>
        </template>
        <template v-else>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'signin' }">
                Sign In
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'register' }">
                Register
                </router-link>
            </li>
        </template>
    </ul>
    </nav>
</template>
<style>
@import url('https://fonts.googleapis.com/css?family=Noto+Serif');

h1 {
  font-family: 'Noto Serif', serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
}
#nav {
  padding: 30px;
  color: white;
}
li {
    color: white;
}
a {
    font-weight: bold;
    color: white;
}


</style>
<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user'
        })
    },

    methods: {
        ...mapActions({
            signOutAction: 'auth/signOut'
        }),

        signOut() {
            this.signOutAction().then(() => {
                this.$router.replace({
                    name: 'home'
                })
            })
        }
    }
}
</script>