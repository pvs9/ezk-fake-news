<template>
  <div class="w-full flex flex-col lg:w-1/3 3xl:w-auto px-4 mb-16 lg:mb-0">
    <div class="max-w-xs flex flex-1 flex-col px-12 mx-auto">
      <h3
        :style="isValueNumber ? `color: ${ParseValueToColor(value)}` : ''"
        class="font-heading text-4xl mb-2"
      >
        {{ isValueNumber ? `${value}%` : value }}
      </h3>
      <h5
        v-if="title"
        class="font-heading text-xl mb-5"
      >
        {{ title }}
      </h5>
      <p
        v-if="description"
        class="text-gray-500 mt-auto"
      >
        {{ description }}
      </p>
    </div>
  </div>
</template>

<script>
// Helpers
import { ParseValueToColor } from "../../../helpers/Formatter";

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
    ParseValueToColor(value) {
      return ParseValueToColor(value);
    },
  },
};
</script>