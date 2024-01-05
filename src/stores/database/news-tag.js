import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  tags: [],
})

const getters = {}

const actions = {
  async getAllTags() {
    let task = await globalStore().makeRequestToDB({
      url: `/${NEWS_TAG_CONTEXT}/all`,
    })

    if (task.success) this.tags = task.data
    else task.data = this.tags

    return task
  },
}

export const NEWS_TAG_CONTEXT = 'news-tag'

export const useDbNewsTagStore = defineStore(`db/${NEWS_TAG_CONTEXT}`, {
  state,
  getters,
  actions,
})
