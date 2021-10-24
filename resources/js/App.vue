<template>
  <router-view />
</template>
<script>
import axios from "axios";
export default {
  name: "App",
  async updated() {
    const response = await axios.get("user-profile", {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
    await this.$store.dispatch("user", response.data.data);
  },
};
</script>

