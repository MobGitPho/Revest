import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  products: [],
})

const getters = {}

const actions = {
  async getAllProducts() {
    let task = await globalStore().makeRequestToDB({
      url: `/${E_COMMERCE_PRODUCT_CONTEXT}/all`,
    })

    if (task.success) this.products = task.data
    else task.data = this.products

    return task
  },
  async getProductsPage(payload) {
    let task = await globalStore().makeRequestToDB({
      url: `/${E_COMMERCE_PRODUCT_CONTEXT}/get/page/${payload.offset}/${payload.limit}`,
    })

    return task
  },
}

export const E_COMMERCE_PRODUCT_CONTEXT = 'e-commerce-product'

export const useDbECommerceProductStore = defineStore(
  `db/${E_COMMERCE_PRODUCT_CONTEXT}`,
  {
    state,
    getters,
    actions,
  }
)
