import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  shelves: [],
})

const getters = {}

const actions = {
  async getAllShelves() {
    let task = await globalStore().makeRequestToDB({
      url: `/${E_COMMERCE_SHELF_CONTEXT}/all`,
    })

    if (task.success) this.shelves = task.data
    else task.data = this.shelves

    return task
  },
}

export const E_COMMERCE_SHELF_CONTEXT = 'e-commerce-shelf'

export const useDbECommerceShelfStore = defineStore(
  `db/${E_COMMERCE_SHELF_CONTEXT}`,
  {
    state,
    getters,
    actions,
  }
)
