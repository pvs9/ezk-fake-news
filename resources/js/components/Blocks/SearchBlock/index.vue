<template>
  <div class="Search">
    <div class="Search__wrapper min-h-screen">
      <div class="container">
        <div class="Search__hacklogo">
          <HackLogo />
        </div>
        <Description />
        <Searcher />
      </div>
    </div>
  </div>
</template>

<script>
import Description from "./Description/index.vue";
import HackLogo from "./HackLogo.vue";
import Searcher from "./Searcher/index.vue";

export default {
  name: "SearchBlock",
  components: {
    Description,
    HackLogo,
    Searcher,
  },
};
</script>

<style lang="scss">
@import "../../../assets/scss/_variables.scss";

.Search {
  &__wrapper {
    background: url("../../../assets/images/SearchBackground.png");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;

    padding: ($base-size * 4) 0;

    display: flex;
    flex-direction: column;

    & .container {
      display: flex;
      flex-direction: column;
      flex: 1;
    }
  }

  &__hacklogo {
    margin-bottom: auto;
  }
}
</style>