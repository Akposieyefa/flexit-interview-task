<template>
    <nav class="navbar shadow bg-white rounded justify-content-between flex-nowrap flex-row fixed-top">
      <div class="container">
        <router-link class="navbar-brand float-left" to="/">
            FLEXIT-TASK
        </router-link>
        <ul class="nav navbar-nav flex-row float-right">
          <li class="nav-item" v-if="!user">
            <router-link class="nav-link pr-3" to="/register">Register</router-link>
          </li>
            <li class="nav-item" v-if="user">
                <router-link class="nav-link pr-3" to="/all-tiwtte">All Twitte</router-link>
            </li>
            <li class="nav-item" v-if="user">
                <router-link class="nav-link pr-3" to="/post-twitte">Post Twitte</router-link>
            </li>
           <li  class="nav-item" v-if="user">
                <a class="nav-link pr-3"  href="javascript:void(0)" @click="onLogout()" >
                    Logout
                </a>
            </li>
        </ul>
      </div>
    </nav>
</template>

<script>

    import {mapGetters} from 'vuex'
    import axios from 'axios'

  export default{
      name: 'Nav',
       methods: {
            onLogout() {
                axios.post('logout', { token : localStorage.getItem('token') }, {
          headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
        } );
                localStorage.removeItem('token');
                delete axios.defaults.headers.common["Authorization"];
                this.$router.push('/')
            }
        },
        computed: {
            ...mapGetters(['user'])
        }
  }
</script>