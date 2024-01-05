import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  orders: [],
})

const getters = {}

const actions = {
  async getAllOrders() {
    let task = await globalStore().makeRequestToDB({
      url: `/${E_COMMERCE_ORDER_CONTEXT}/all`,
    })

    if (task.success) this.orders = task.data
    else task.data = this.orders

    return task
  },
}

export const E_COMMERCE_ORDER_CONTEXT = 'e-commerce-order'

export const useDbECommerceOrderStore = defineStore(
  `db/${E_COMMERCE_ORDER_CONTEXT}`,
  {
    state,
    getters,
    actions,
  }
)
