<template>
  <div>
    <Nav />

    <div class="container-fluid"><br><br><br><br><br>
        <div class="row">
            <div class="col-md-7 offset-3">
                       <div>
            <Error v-if="error" :error="error" />
            <Success v-if="success" :success="success" />
            <div class="form-group">
              <label for="name"> <strong>Title</strong></label>
              <input
                type="text"
                id="name"
                v-model="title"
                class="form-control form-control-md"
              />
            </div>
            <div class="form-group">
              <label for="description">
                <strong>Message</strong>
              </label>
              <textarea
                id="description"
                v-model="message"
                class="form-control form-control-md"
                aria-label="With textarea"
              ></textarea>
            </div>
            <button
              type="submit"
              @click="onSubmit()"
              class="btn btn-dark btn-lg"
            >
              Submit
            </button>
          </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import axios from "axios";

export default {
  name: "PostTwitte",
  data() {
    return {
      title: "",
      message: "",
      error: "",
      success: "",
    };
  },
  components: {
    Nav: () => import("../components/Nav.vue"),
    Error: () => import("../components/Error.vue"),
    Success: () => import("../components/Success.vue"),

  },
  methods: {
    async onSubmit() {
      try {
        const response = await axios.post('twittes', {
          title: this.title,
          message: this.message,
        }, {
            headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
        });
        this.success = response.data.message;
        this.setDataToNull();
      } catch (e) {
        this.error = e.response.data.message;
      }
    },
    setDataToNull() {
      this.title = "";
      this.message = "";
    },
  },
  computed: {
    ...mapGetters(["user"]),
  },
};
</script>


<style scoped>
</style>
