<template>
  <div class="layout min-h-screen">
    <Header />
    <main>
      <router-view />
    </main>
  </div>
</template>

<script>
// Components
import Header from "../components/Common/Navbar.vue";

export default {
  name: "App",
  components: {
    Header,
  },
};
</script>

<style>
</style>