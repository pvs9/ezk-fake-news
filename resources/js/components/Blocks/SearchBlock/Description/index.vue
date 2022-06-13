<template>
  <div class="Description">
    <h1 class="Description__title">
      Проверь новости на подлинность
    </h1>
    <h2 class="Description__text">
      Наш сервис поможет отличить оригинальные ности от поддельных. <br />
      Просто укажи заголовок с текстом, чтобы получить результаты.
    </h2>
  </div>
</template>

<script>
export default {
  name: "Description",
};
</script>

<style lang="scss">
@import "../../../../assets/scss/_variables.scss";

.Description {
  display: flex;
  flex-direction: column;
  margin: ($base-size * 4) auto ($base-size * 8) auto;

  &__title {
    font-size: $font-size-h1;
    text-align: center;
    color: $c-white;
    font-weight: 600;
    margin-bottom: $base-size * 2;
  }

  &__text {
    font-size: $font-size-text;
    text-align: center;
    color: $c-white;
    line-height: 1.6;
  }
}
</style>