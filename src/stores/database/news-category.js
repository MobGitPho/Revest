import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  categories: [],
})

const getters = {}

const actions = {
  async getAllCategories() {
    let task = await globalStore().makeRequestToDB({
      url: `/${NEWS_CATEGORY_CONTEXT}/all`,
    })

    if (task.success) this.categories = task.data
    else task.data = this.categories

    return task
  },
  async getCategoriesByParent(parent) {
    let task = await globalStore().makeRequestToDB({
      url: `/${NEWS_CATEGORY_CONTEXT}/parent/${parent}`,
    })

    return task
  },
}

export const NEWS_CATEGORY_CONTEXT = 'news-category'

export const useDbNewsCategoryStore = defineStore(
  `db/${NEWS_CATEGORY_CONTEXT}`,
  {
    state,
    getters,
    actions,
  }
)
