import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  articles: [],
  article: null,
})

const getters = {}

const actions = {
  async getAllArticles() {
    let task = await globalStore().makeRequestToDB({
      url: `/${NEWS_ARTICLE_CONTEXT}/all`,
    })

    if (task.success) this.articles = task.data
    else task.data = this.articles

    return task
  },
}

export const NEWS_ARTICLE_CONTEXT = 'news-article'

export const useDbNewsArticleStore = defineStore(`db/${NEWS_ARTICLE_CONTEXT}`, {
  state,
  getters,
  actions,
})
