<template>
  <div class="navbar bg-base-100">
    <div class="navbar-start">
      <a class="btn btn-ghost normal-case text-xl">EZK - Fake news</a>
    </div>
    <div class="navbar-end">
      <a class="btn">Проверить новость</a>
    </div>
  </div>
</template>

<script>
export default {
  name: "Header",
};
</script>

<style>
.navbar {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
}
</style>