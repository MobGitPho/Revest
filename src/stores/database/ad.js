import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  ads: [],
  identifiers: [],
})

const getters = {}

const actions = {
  async getAllAds() {
    let task = await globalStore().makeRequestToDB({
      url: `/${AD_CONTEXT}/all`,
    })

    if (task.success) this.ads = task.data
    else task.data = this.ads

    return task
  },

  async updateIdentifier(payload) {
    let task = await globalStore().makeRequestToDB({
      url: `/${AD_CONTEXT}/id/update/${payload.id}`,
      method: 'put',
      data: payload.data,
    })

    return task
  },
  async deleteIdentifier(id) {
    let task = await globalStore().makeRequestToDB({
      url: `/${AD_CONTEXT}/id/delete/${id}`,
      method: 'delete',
    })

    return task
  },
  async addIdentifier(data) {
    let task = await globalStore().makeRequestToDB({
      url: `/${AD_CONTEXT}/id/add`,
      method: 'post',
      data: data,
    })

    return task
  },
  async getAllIdentifiers() {
    let task = await globalStore().makeRequestToDB({
      url: `/${AD_CONTEXT}/id/all`,
    })

    if (task.success) this.identifiers = task.data
    else task.data = this.identifiers

    return task
  },
}

export const AD_CONTEXT = 'ad'

export const useDbAdStore = defineStore(`db/${AD_CONTEXT}`, {
  state,
  getters,
  actions,
})
