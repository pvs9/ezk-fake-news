<template>
  <div class="MainLayout">
    <Alert />
    <slot name="content" />
  </div>
</template>

<script>
import Alert from "../components/Alert.vue";

export default {
  name: "MainLayout",
  components: {
    Alert,
  },
};
</script>