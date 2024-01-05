import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  pages: [],
})

const getters = {}

const actions = {
  async updateHomePage(payload) {
    let task = await globalStore().makeRequestToDB({
      url: `/${PAGE_CONTEXT}/update/is-home/${payload.id}/${payload.value}`,
      method: 'put',
    })

    return task
  },
  async getAllPages() {
    let task = await globalStore().makeRequestToDB({
      url: `/${PAGE_CONTEXT}/all`,
    })

    if (task.success) this.pages = task.data
    else task.data = this.pages

    return task
  },
}

export const PAGE_CONTEXT = 'page'

export const useDbPageStore = defineStore(`db/${PAGE_CONTEXT}`, {
  state,
  getters,
  actions,
})
