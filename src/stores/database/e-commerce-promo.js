import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  promotions: [],
})

const getters = {}

const actions = {
  async getAllPromotions() {
    let task = await globalStore().makeRequestToDB({
      url: `/${E_COMMERCE_PROMO_CONTEXT}/all`,
    })

    if (task.success) this.promotions = task.data
    else task.data = this.promotions

    return task
  },
}

export const E_COMMERCE_PROMO_CONTEXT = 'e-commerce-promo'

export const useDbECommercePromoStore = defineStore(
  `db/${E_COMMERCE_PROMO_CONTEXT}`,
  {
    state,
    getters,
    actions,
  }
)
