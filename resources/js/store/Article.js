import { defineStore } from 'pinia'
import $Request from "../utils/Request";

export const useArticleStore = defineStore({
  id: 'article',
  state: () => ({
    article: null,
  }),
  actions: {
    getArticle(payload) {
      this.article = null;
      return new Promise((resolve, reject) => {
        $Request.post(payload).then(response => {
          this.article = response;
          resolve(response);
        })
      })
    },
  }
})