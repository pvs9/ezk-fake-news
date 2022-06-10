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
import Header from "../components/Common/Header.vue";

export default {
  name: "App",
  components: {
    Header,
  },
};
</script>

<style>
/* .layout {
  display: flex;
  flex-direction: column;
}

.layout main {
  flex: 1;
  display: flex;
  flex-direction: column;
} */
</style>