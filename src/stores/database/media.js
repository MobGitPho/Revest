import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({})

const getters = {}

const actions = {
  async generateThumbnails(data) {
    let task = await globalStore().makeRequestToDB({
      url: `/${MEDIA_CONTEXT}/generate/thumbnails`,
      method: 'post',
      data: data,
    })

    return task
  },
  async generateThumbnail(data) {
    let task = await globalStore().makeRequestToDB({
      url: `/${MEDIA_CONTEXT}/generate/thumbnail`,
      method: 'post',
      data: data,
    })

    return task
  },
  async getFolderMedias(payload) {
    let task = await globalStore().makeRequestToDB({
      url: `/${MEDIA_CONTEXT}/get/files/${payload.folder}`,
    })

    return task
  },
  async getMediasPage(payload) {
    let task = await globalStore().makeRequestToDB({
      url: `/${MEDIA_CONTEXT}/get/page/${payload.offset}/${payload.limit}`,
    })

    return task
  },
}

export const MEDIA_CONTEXT = 'media'

export const useDbMediaStore = defineStore(`db/${MEDIA_CONTEXT}`, {
  state,
  getters,
  actions,
})
