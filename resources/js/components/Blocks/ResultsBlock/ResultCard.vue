<template>
  <div class="w-full flex flex-col lg:w-1/3 3xl:w-auto px-4 mb-16 lg:mb-0">
    <div class="flex Card flex-1 flex-col px-12 mx-auto">
      <h3
        :style="isValueNumber ? `color: ${getColorByValue(value)}` : ''"
        class="font-heading Card__value text-4xl mb-2"
      >
        {{ isValueNumber ? `${value}%` : value }}
      </h3>
      <h5
        v-if="title"
        class="font-heading Card__title text-xl mb-5"
      >
        {{ title }}
      </h5>
      <p
        v-if="description"
        class="text-gray-500 Card__description mt-auto"
      >
        {{ description }}
      </p>
    </div>
  </div>
</template>

<script>
// Helpers
import { getColorByValue } from "../../../helpers/Formatter";

export default {
  name: "ResultCard",
  props: {
    value: {
      type: [String, Number],
      required: true,
      default: "",
    },
    title: {
      type: String,
      required: true,
      default: "",
    },
    description: {
      type: String,
      required: false,
      default: "",
    },
  },
  computed: {
    isValueNumber() {
      return typeof this.value === "number";
    },
  },
  methods: {
    getColorByValue(value) {
      return getColorByValue(value);
    },
  },
};
</script>

<style lang="scss">
@import "../../../assets/scss/_variables.scss";

.Card {
  max-width: $base-size * 40;
  width: 100%;

  &__value {
    font-size: $base-size * 3.6;
    line-height: 1.4;
  }

  &__title {
    font-size: $base-size * 2;
    line-height: 1.4;
  }

  &__description {
    font-size: $base-size * 1.6;
    line-height: 1.4;
  }
}
</style>