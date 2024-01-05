import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  categories: [],
})

const getters = {}

const actions = {
  async getAllCategories() {
    let task = await globalStore().makeRequestToDB({
      url: `/${E_COMMERCE_CATEGORY_CONTEXT}/all`,
    })

    if (task.success) this.categories = task.data
    else task.data = this.categories

    return task
  },
  async getCategoriesByParent(parent) {
    let task = await globalStore().makeRequestToDB({
      url: `/${E_COMMERCE_CATEGORY_CONTEXT}/parent/${parent}`,
    })

    return task
  },
}

export const E_COMMERCE_CATEGORY_CONTEXT = 'e-commerce-category'

export const useDbECommerceCategoryStore = defineStore(
  `db/${E_COMMERCE_CATEGORY_CONTEXT}`,
  {
    state,
    getters,
    actions,
  }
)
