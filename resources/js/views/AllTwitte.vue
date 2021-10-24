<template>
  <div>
    <Nav />

    <div class="container-fluid">
      <br /><br /><br /><br /><br />
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-4 offset-md-5">
            <h1>All Twitte</h1>
          </div>
          <br /><br />
        </div>
        <div
          class="col-md-4"
          v-for="(twitte, index) in twittes"
          :index="index"
          :key="twitte.id"
        >
          <div class="card mb-10">
            <div class="card-header">Posted By {{ twitte.user.name }} </div>
            <div class="card-body">
              <h5 class="card-title">
                <router-link v-bind:to="'/tiwtte-comments/' + twitte.id">
                  {{ twitte.title }}
                </router-link>
              </h5>
              <p class="card-text text-justify">
                {{ formatText(twitte.message) }} <br />
                <small>
                  <strong>Posted On : </strong>
                  {{
                    formatDate(twitte.created_at)  +
                    "    " +
                    "Comments : " +
                    " " +
                    twitte.comments.length
                    +
                    "    " +
                    "Likes : " +
                    " " +
                    twitte.likes.length
                  }} 
                </small>
              </p>

              <button
                @click="delteTwitte(twitte.id)"
                href="#"
                v-if="twitte.user.id == user.id"
                class="btn btn-danger btn-sm"
                >Delete
              </button
              >
              <button
                @click="likeTwitte(twitte.id)"
                href="#"
                class="btn btn-primary btn-sm"
                >Like
              </button
              >

              <button
                @click="unLikeTwitte(twitte.id)"
                href="#"
                class="btn btn-info btn-sm"
                >Unlink
              </button
              >

              <router-link class="btn btn-dark btn-sm" v-bind:to="'/tiwtte-comments/' + twitte.id">
                  Comment
              </router-link>

            </div>
          </div>
          <br /><br />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import axios from "axios";

export default {
  name: "AllTwitte",
  data() {
    return {
      twittes: [],
      error: "",
      success: "",
    };
  },
  components: {
    Nav: () => import("../components/Nav.vue"),
    Error: () => import("../components/Error.vue"),
    Success: () => import("../components/Success.vue"),
  },
  created() {
    this.getTwittes();
  },
  updated() {
    this.getTwittes();
  },
  methods: {
    async getTwittes() {
      const response = await axios.get("twittes", {
        headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
      });
      this.twittes = response.data.data;
    },
    formatDate(dateString) {
      const options = { year: "numeric", month: "long", day: "numeric" };
      return new Date(dateString).toLocaleDateString(undefined, options);
    },
    formatText(string) {
      if (string.length > 10) {
        string = string.substring(0, 100) + "...";
        return string;
      }
    },
    async delteTwitte(id) {
      if (confirm('Are you sure')) {
          try {
            const response = await axios.delete("twittes/" + id, {
              headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
            });
            this.success = response.data.message;
          } catch (e) {
            this.error = e.response.data.message;
          }
      }
    },
    async likeTwitte(id) {
        try {
          const response = await axios.get("twittes-like/" + id, {
            headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
          });
          alert(response.data.message)
        } catch (e) {
          alert(e.response.data.message)
        }
    },
    async unLikeTwitte(id) {
        try {
          const response = await axios.get("twittes-unlike/" + id, {
            headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
          });
          alert(response.data.message)
        } catch (e) {
          alert(e.response.data.message)
        }
    },
  },
  computed: {
    ...mapGetters(["user"]),
  },
};
</script>


<style scoped>
</style>
