//listen for auth
import store from '@/store'
import axios from 'axios'

store.subscribe((mutation) => {
    //any mutation will be available here
    switch (mutation.type) {
        case 'auth/SET_TOKEN':
            if (mutation.payload) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${mutation.payload}`
            } else {
                axios.defaults.headers.common['Authorization'] = null
            }
            break;
    }
})