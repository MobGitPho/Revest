import _ from 'lodash'

import { WebsiteInfo } from '@/utils/enums'

import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  websiteInfo: [],
})

const getters = {
  getWebsiteInfo: (state) => (name) => {
    return state.websiteInfo.find((s) => s.name === name)
  },
  getWebsiteInfoValue: (state) => (name) => {
    let data = state.websiteInfo.find((s) => s.name === name)

    return data ? data.value : ''
  },
}

const actions = {
  async initWebsiteInfoDB() {
    var self = this

    await this.getAllWebsiteInfo()

    _.forIn(WebsiteInfo, async function (value, key) {
      if (self.websiteInfo && _.isArray(self.websiteInfo)) {
        let index = self.websiteInfo.findIndex((s) => s.name === value.NAME)

        if (index === -1) {
          await self.addWebsiteInfo({
            name: value.NAME,
            value: value.DEFAULT,
          })
        }
      } else {
        await self.addWebsiteInfo({
          name: value.NAME,
          value: value.DEFAULT,
        })
      }
    })

    await this.getAllWebsiteInfo()
  },
  async getAllWebsiteInfo() {
    let task = await globalStore().makeRequestToDB({
      url: `/${WEBSITE_INFO_CONTEXT}/all`,
    })

    if (task.success) this.websiteInfo = task.data
    else task.data = this.websiteInfo

    return task
  },
  async updateWebsiteInfo(data) {
    let task = await globalStore().makeRequestToDB({
      url: `/${WEBSITE_INFO_CONTEXT}/update`,
      method: 'put',
      data: data,
    })

    return task
  },
  async addWebsiteInfo(data) {
    let task = await globalStore().makeRequestToDB({
      url: `/${WEBSITE_INFO_CONTEXT}/add`,
      method: 'post',
      data: data,
    })

    return task
  },
}

export const WEBSITE_INFO_CONTEXT = 'website-info'

export const useDbWebsiteInfoStore = defineStore(`db/${WEBSITE_INFO_CONTEXT}`, {
  state,
  getters,
  actions,
})
