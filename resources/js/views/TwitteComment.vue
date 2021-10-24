<template>
  <div>
    <Nav />

    <div class="container-fluid">
      <br /><br /><br /><br /><br />
      <div class="row">
        <div class="col-md-10 offset-1">
            <h3> {{ twitte.title }}  </h3>  <small> Posted By : {{ twitte.user.name}}</small> 
          <p class="text-lead text-justify">
            {{ twitte.message }}
          </p>
        </div>

        <div class="col-md-9 offset-2">
          <h5> <strong>Comments</strong>  </h5>
          <span  v-for="(comments, index) in twitte.comments"
          :index="index"
          :key="comments.id">

          <p class="text-lead text-justify"> 
            <strong> @ {{ comments.commentor.name}} : </strong>  {{comments.comment}} <br>
            <small> <strong>Date : </strong> {{ formatDate(comments.created_at) }}</small>
          </p>
          </span>
          
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Leave a Comment
          </button>
        </div>
      </div>
    </div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Leave a Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
              <label for="description">
                <strong>Comment</strong>
              </label>
              <textarea
                id="description"
                v-model="comment"
                class="form-control form-control-md"
                aria-label="With textarea"
              ></textarea>
            </div>
      </div>
      <div class="modal-footer">
          <button
              type="submit"
              @click="onSubmit()"
              class="btn btn-dark btn-lg"
            >
              Comment
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
import $ from 'jquery'

export default {
  name: "CommentOnTwitte",
  data() {
    return {
      comment: "",
      twitte: {},
      error: "",
      success: "",
      id: this.$route.params.id,
    };
  },
  components: {
    Nav: () => import("../components/Nav.vue"),
    Error: () => import("../components/Error.vue"),
    Success: () => import("../components/Success.vue"),
  },
  created() {
    this.findTwitte()
  },
  updated() {
    this.findTwitte()
  },
  methods: {
    async onSubmit() {
      try {
        const response = await axios.post(
          "twittes-comment/" + this.id,
          {
            comment: this.comment,
          },
          {
            headers: {
              Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
          }
        );
        this.success = response.data.message;
        this.setDataToNull();
        $('#exampleModal').modal('hide')
      } catch (e) {
        this.error = e.response.data.message;
      }
    },
    formatDate(dateString) {
      const options = { year: "numeric", month: "long", day: "numeric" };
      return new Date(dateString).toLocaleDateString(undefined, options);
    },
    async findTwitte() {
      try {
        const response = await axios.get("twittes/" + this.id, {
            headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
        });
        this.twitte = response.data.data;
      } catch (e) {
        this.error = e.response.data.message;
      }
    },
    setDataToNull() {
      this.comment = "";
    },
  },
  computed: {
    ...mapGetters(["user"]),
  },
};
</script>


<style scoped>
</style>
