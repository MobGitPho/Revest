import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  accounts: [],
})

const getters = {}

const actions = {
  async getAllAccounts() {
    let task = await globalStore().makeRequestToDB({
      url: `/${SUBSCRIPTION_CONTEXT}/all`,
    })

    if (task.success) this.accounts = task.data
    else task.data = this.accounts

    return task
  },
  async checkAccount(uid) {
    let task = await globalStore().makeRequestToDB({
      url: `/${SUBSCRIPTION_CONTEXT}/check/${uid}`,
    })

    return task
  },
}

export const SUBSCRIPTION_CONTEXT = 'subscription'

export const useDbSubscriptionStore = defineStore(
  `db/${SUBSCRIPTION_CONTEXT}`,
  {
    state,
    getters,
    actions,
  }
)
