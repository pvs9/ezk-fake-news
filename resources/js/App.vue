<template>
  <MainLayout>
    <template #content>
      <Home />
    </template>
  </MainLayout>
</template>

<script>
// Layouts
import MainLayout from "./layouts/MainLayout.vue";

// Views
import Home from "./views/Home.vue";

export default {
  name: "App",
  components: {
    MainLayout,
    Home,
  },
};
</script>

<style lang="scss">
@import "./assets/scss/_global.scss";
</style>