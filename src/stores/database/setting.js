import _ from 'lodash'

import { VarTypes } from '@/utils/enums'

import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  settings: [],
})

const getters = {
  getSetting: (state) => (name) => {
    return state.settings.find((s) => s.name === name)
  },
  getSettingValue:
    (state) =>
    (name, type = VarTypes.STRING) => {
      let setting = state.settings.find((s) => s.name === name)

      let value = ''

      switch (type) {
        case VarTypes.NUMBER:
          value =
            setting && parseInt(setting.value) ? parseInt(setting.value) : 0

          break

        case VarTypes.BOOLEAN:
          value = setting && parseInt(setting.value) > 0

          break

        case VarTypes.OBJECT:
          value = setting && setting.value ? JSON.parse(setting.value) : {}

          break

        case VarTypes.ARRAY:
          value = setting && setting.value ? JSON.parse(setting.value) : []

          break

        default:
          value = setting && setting.value ? setting.value : ''

          break
      }

      return value
    },
}

const actions = {
  async getAllSettings() {
    let task = await globalStore().makeRequestToDB({
      url: `/${SETTING_CONTEXT}/all`,
    })

    if (task.success) this.settings = task.data
    else task.data = this.settings

    return task
  },
}

export const SETTING_CONTEXT = 'setting'

export const useDbSettingStore = defineStore(`db/${SETTING_CONTEXT}`, {
  state,
  getters,
  actions,
})
