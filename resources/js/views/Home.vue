<template>
    <div class="vue-tempalte">
         <Nav />
        <div class="App">
            <div class="vertical-center mt-30">
                <div class="inner-block" v-if="!user" >
                    <div>
                        <h3>Sign In</h3>
                        <Error v-if="error" :error="error" />
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" v-model="email" class="form-control form-control-lg" />
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" v-model="password" class="form-control form-control-lg" />
                        </div>

                        <button type="submit" @click="onSubmit" class="btn btn-dark btn-lg btn-block">Sign In</button>

                        <p class="forgot-password text-right mt-2 mb-4">
                            <router-link to="/register">Register ?</router-link>
                        </p>
                    </div>
                </div>
                <div class="inner-block" v-else>
                    <strong>Welcome you are already logged in</strong>
                </div>   
            </div>
        </div>
    </div>
</template>

<script>

    import {mapGetters} from 'vuex'
    import axios from 'axios'

    export default {

        name: 'Login',
        components: {
            Error: () => import('../components/Error.vue'),
            Nav: () => import("../components/Nav.vue"),
        },
        data() {
            return {
                email: '',
                password: '',
                error: ''
            }
        },
        methods: {

             async onSubmit() {
               try {
                    const response = await axios.post('login', {
                        email: this.email,
                        password: this.password
                    });
                    localStorage.setItem('token', response.data.token.original.access_token);
                    this.$store.dispatch('user', response.data.token.original.user);
                    this.$router.push('/all-tiwtte');
                } catch (e) {
                   this.error = e.response.data.message;
               }
            }
        },
        computed: {
            ...mapGetters(['user'])
        }
    }
</script>

<style scoped>
    @import "../css/app.css";
</style>
