import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  widgets: [],
})

const getters = {}

const actions = {
  async addUniqueWidget(data) {
    let task = await globalStore().makeRequestToDB({
      url: `/${WIDGET_CONTEXT}/add/unique`,
      method: 'post',
      data: data,
    })

    return task
  },
  async addReplicableWidget(data) {
    let task = await globalStore().makeRequestToDB({
      url: `/${WIDGET_CONTEXT}/add/replicable`,
      method: 'post',
      data: data,
    })

    return task
  },
  async getAllWidgets() {
    let task = await globalStore().makeRequestToDB({
      url: `/${WIDGET_CONTEXT}/all`,
    })

    if (task.success) this.widgets = task.data
    else task.data = this.widgets

    return task
  },
}

export const WIDGET_CONTEXT = 'widget'

export const useDbWidgetStore = defineStore(`db/${WIDGET_CONTEXT}`, {
  state,
  getters,
  actions,
})
