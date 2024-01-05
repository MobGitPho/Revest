import { defineStore } from 'pinia'

import {
  DATABASE_API_BASE_URL,
  FILE_API_BASE_URL,
  CLIENT_IP_API_BASE_URL,
  IP_LOCATION_API_BASE_URL,
  API_REQUEST_HEADERS,
} from '@/utils/constants'

const state = () => ({
  globalCache: {},

  nextRouteName: null,
  previousRouteName: null,

  widgetsJSONData: {},
  sectionsJSONData: {},
})

const getters = {}

const actions = {
  async requestClientIp() {
    let success = false

    let response = null
    let error = null

    try {
      response = await axios.request({
        method: 'get',
        baseURL: CLIENT_IP_API_BASE_URL,
        headers: API_REQUEST_HEADERS,
      })

      success = response && response.data !== ''
    } catch (error) {
      success = false

      this.handleError(error)
    }

    return {
      success,
      failure: !success,
      data: response ? response.data : null,
      error,
    }
  },
  async requestClientLocation(ip = '') {
    let success = false

    let response = null
    let error = null

    try {
      response = await axios.request({
        method: 'get',
        baseURL: IP_LOCATION_API_BASE_URL,
        headers: API_REQUEST_HEADERS,
        url: ip,
      })

      success = response && response.data !== ''
    } catch (error) {
      success = false

      this.handleError(error)
    }

    return {
      success,
      failure: !success,
      data: response ? response.data : null,
      error,
    }
  },
  async makeRequestToFileApi(payload) {
    let success = false

    let response = null
    let error = null

    try {
      response = await axios.request({
        method: 'post',
        baseURL: FILE_API_BASE_URL,
        headers: API_REQUEST_HEADERS,
        data: payload.data || {},
        url: payload.url || '/',
      })

      success = response && response.data !== ''
    } catch (error) {
      success = false

      if (import.meta.env.DEV) {
        if (error.response) {
          console.log(error.response.data)
          console.log(error.response.status)
          console.log(error.response.headers)
        } else if (error.request) {
          console.log(error.request)
        } else {
          console.log('Error', error.message)
        }

        console.log(error.config)
      }
    }

    return {
      success: success,
      failure: !success,
      data: response ? response.data : null,
      error: error,
    }
  },
  async loadJSONData() {
    let task1 = await this.makeRequestToFileApi({
      url: '/file/get',
      data: {
        file: 'widgets/index.json',
      },
    })

    let task2 = await this.makeRequestToFileApi({
      url: '/file/get',
      data: {
        file: 'sections/index.json',
      },
    })

    this.widgetsJSONData = task1.data || {}
    this.sectionsJSONData = task2.data || {}
  },

  async addItemInDB(payload) {
    let task = await this.makeRequestToDB({
      url: isGlobalRequest(payload)
        ? `/${GLOBAL_CONTEXT}/${payload.table}/add`
        : `/${payload.context}/add`,
      method: 'post',
      data: payload.data,
    })

    return task
  },
  async deleteItemInDB(payload) {
    let task = await this.makeRequestToDB({
      url: isGlobalRequest(payload)
        ? `/${GLOBAL_CONTEXT}/${payload.table}/delete/${payload.id}`
        : `/${payload.context}/delete/${payload.id}`,
      method: 'delete',
    })

    return task
  },
  async updateItemInDB(payload) {
    let task = await this.makeRequestToDB({
      url: isGlobalRequest(payload)
        ? `/${GLOBAL_CONTEXT}/${payload.table}/update/${payload.id}`
        : `/${payload.context}/update/${payload.id}`,
      method: 'put',
      data: payload.data,
    })

    return task
  },
  async getAllItemsFromDB(payload) {
    let task = await this.makeRequestToDB({
      url: isGlobalRequest(payload)
        ? `/${GLOBAL_CONTEXT}/${payload.table}/all`
        : `/${payload.context}/all`,
    })

    if (isGlobalRequest(payload)) {
      if (task.success) this.globalCache[payload.table] = task.data
      else task.data = this.globalCache[payload.table]
    }

    return task
  },
  async getItemFromDB(payload) {
    let task = await this.makeRequestToDB({
      url: isGlobalRequest(payload)
        ? `/${GLOBAL_CONTEXT}/${payload.table}/get/${payload.id}`
        : `/${payload.context}/get/${payload.id}`,
    })

    return task
  },
  async makeCustomRequestToDB(payload, type = 'json') {
    let task = await this.makeRequestToDB({
      url: `/${GLOBAL_CONTEXT}/custom-request/${type}`,
      method: 'post',
      data: payload,
    })

    return task
  },
  async makeRequestToDB(payload) {
    let success = false

    let response = null
    let error = null

    try {
      response = await axios.request({
        method: payload.method || 'get',
        baseURL: DATABASE_API_BASE_URL,
        headers: API_REQUEST_HEADERS,
        params: payload.params || {},
        data: payload.data || {},
        url: payload.url || '/',
      })

      success = response && response.data !== ''
    } catch (err) {
      error = err

      success = false

      this.handleError(err)
    }

    return {
      success: success,
      failure: !success,
      data: response ? response.data : null,
      error: error,
    }
  },
  handleError(error) {
    if (import.meta.env.DEV) {
      if (error.response) {
        console.log(error.response.data)
        console.log(error.response.status)
        console.log(error.response.headers)
      } else if (error.request) {
        console.log(error.request)
      } else {
        console.log('Error', error.message)
      }

      console.log(error.config)
    }
  },
}

function isGlobalRequest(payload) {
  let context = payload.context || GLOBAL_CONTEXT

  if (context == GLOBAL_CONTEXT) {
    if (!payload.table)
      throw new Error('Table name must be provided on global context request !')

    return true
  }

  return false
}

export const GLOBAL_CONTEXT = 'global'

export const useGlobalStore = defineStore(GLOBAL_CONTEXT, {
  state,
  getters,
  actions,
})
