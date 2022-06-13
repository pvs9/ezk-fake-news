<template>
  <div
    :class="`alert-${type}`"
    class="Alert alert shadow-lg"
  >
    <div>
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none"
        viewBox="0 0 24 24"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
        />
      </svg>
      <span>
        {{ text }}
      </span>
    </div>
  </div>
</template>

<script>
export default {
  name: "Alert",
  props: {
    type: {
      type: String,
      default: "error",
      required: false,
    },
    text: {
      type: String,
      default: "Произошла ошибка",
      required: true,
    },
  },
};
</script>

<style lang="scss">
@import "../assets/scss/_variables.scss";

.Alert {
  position: fixed;
  left: 50%;
  transform: translate(-50%, 0);
  top: 20px;
  //   width: 100%;
  max-width: 400px;
  display: inline-block;
  & span {
    font-size: $base-size * 2;
    // color: $c-white;
  }
}
</style>