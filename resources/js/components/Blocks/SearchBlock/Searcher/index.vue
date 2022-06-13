<template>
  <div class="Searcher card shadow-xl">
    <input
      v-model="title"
      type="text"
      placeholder="Введите заголовок статьи..."
      class="input input-bordered input-primary w-full"
      :disabled="isLoading"
    />

    <textarea
      v-model="text"
      class="textarea textarea-primary w-full"
      placeholder="Введите текст статьи..."
      :disabled="isLoading"
    ></textarea>

    <button
      @click="articleRequest"
      :disabled="isButtonDisabled"
      class="btn"
      :class="{'loading': isLoading}"
    >
      {{ isLoading ? '' : "Проверить" }}
    </button>
  </div>
</template>

<script>
import { useArticleStore } from "../../../../store/Article";

export default {
  name: "Searcher",
  data() {
    return {
      title: "",
      text: "",
      isLoading: false,
    };
  },
  computed: {
    isButtonDisabled() {
      return !this.title || !this.text;
    },
  },
  methods: {
    articleRequest() {
      this.isLoading = true;
      const store = useArticleStore();

      store
        .articleAnalyze({ title: this.title, text: this.text })
        .then((response) => {
          this.isLoading = false;
          console.log(response);
        })
        .catch((error) => {
          this.isLoading = false;
          console.log(error);
        });
    },
  },
};
</script>

<style lang="scss">
@import "../../../../assets/scss/_variables.scss";

.Searcher {
  width: 100%;
  background-color: $c-white;
  padding: ($base-size * 3) ($base-size * 10.5);

  display: flex;
  flex-direction: column;
  align-items: center;

  margin-bottom: auto;

  & .input,
  .textarea {
    font-size: $base-size * 1.6;
    padding: $base-size * 1.4;
    height: $base-size * 5;
    margin: $base-size 0;
    background: $c-grey;
    border-width: 0;
  }

  & .textarea {
    min-height: $base-size * 12;
    max-height: $base-size * 36;
  }

  & .btn {
    padding: ($base-size * 1.4) ($base-size * 5);
    background: $c-linear;
    margin: ($base-size * 3) 0 $base-size 0;
    font-size: $font-size-text;
    font-weight: 400;
    height: $base-size * 5;
    // margin: 0 auto;
    &:disabled {
      opacity: 0.6;
      background: $c-darker;
      color: $c-white;
    }

    &.loading {
      &:before {
        height: 2rem;
        width: 2rem;
      }
    }
  }

  @media screen and (max-width: 960px) {
    padding: $base-size ($base-size * 1.5);
  }
}
</style>