import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  comments: [],
})

const getters = {}

const actions = {
  async getAllComments() {
    let task = await globalStore().makeRequestToDB({
      url: `/${NEWS_COMMENT_CONTEXT}/all`,
    })

    if (task.success) this.comments = task.data
    else task.data = this.comments

    return task
  },
}

export const NEWS_COMMENT_CONTEXT = 'news-comment'

export const useDbNewsCommentStore = defineStore(`db/${NEWS_COMMENT_CONTEXT}`, {
  state,
  getters,
  actions,
})
