import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  sections: [],
})

const getters = {}

const actions = {
  async getAllSections() {
    let task = await globalStore().makeRequestToDB({
      url: `/${SECTION_CONTEXT}/all`,
    })

    if (task.success) this.sections = task.data
    else task.data = this.sections

    return task
  },
}

export const SECTION_CONTEXT = 'section'

export const useDbSectionStore = defineStore(`db/${SECTION_CONTEXT}`, {
  state,
  getters,
  actions,
})
