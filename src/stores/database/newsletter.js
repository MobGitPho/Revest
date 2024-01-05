import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  emails: [],
})

const getters = {}

const actions = {
  async addEmail(data) {
    let task = await globalStore().makeRequestToDB({
      url: `/${NEWSLETTER_CONTEXT}/email/add`,
      method: 'post',
      data: data,
    })

    return task
  },
  async getAllEmails() {
    let task = await globalStore().makeRequestToDB({
      url: `/${NEWSLETTER_CONTEXT}/email/all`,
    })

    if (task.success) this.emails = task.data
    else task.data = this.emails

    return task
  },
}

export const NEWSLETTER_CONTEXT = 'newsletter'

export const useDbNewsletterStore = defineStore(`db/${NEWSLETTER_CONTEXT}`, {
  state,
  getters,
  actions,
})
