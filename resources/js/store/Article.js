import { defineStore } from 'pinia';
import api from "../api";
import { article } from "../helpers/Mockup";

export const useArticleStore = defineStore({
  id: 'article',
  state: () => ({
    article: null,
  }),
  actions: {
    articleAnalyze(payload) {
      this.article = null;
      return new Promise((resolve, reject) => {
        api.post('/article/analyze', JSON.stringify(payload))
          .then(response => {
            this.article = response.data.data;
            resolve(response.data.data);
          })
          .catch(error => {
            if(error.response?.data?.errors) return reject(error.response.data.errors);
            reject(error);
          })
      })
    },
  }
})

setTimeout(() => {
  if(process.env.NODE_ENV === 'development') {
    useArticleStore().$patch({
      article
    })
  }
}, 0);