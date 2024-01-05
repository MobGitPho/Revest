import { defineStore } from 'pinia'

import { v4 as uuidv4 } from 'uuid'

import { getCurrentTimestamp } from '@/utils/functions'

const globalStore = () => useGlobalStore()

const SESSION_LIFETIME = 1260

const state = () => ({
  sessionId: null,
  sessionDate: null,
  initSessionDate: null,
  loadingSessionId: null,

  userData: null,
  connected: false,
  rememberMe: false,
})

const getters = {
  isUserConnected(state) {
    return state.userData && state.connected
  },
  isSessionAlive(state) {
    return state.sessionId && state.sessionDate
  },
}

const actions = {
  startSession() {
    if (
      this.sessionId === null ||
      this.sessionDate === null ||
      this.initSessionDate === null
    ) {
      this.setSessionId()
      this.resetSessionData()
    } else this.updateSession()
  },
  async updateSession(page = '') {
    if (getCurrentTimestamp() - this.sessionDate > SESSION_LIFETIME) {
      this.setSessionId()
      if (!this.rememberMe) this.resetSessionData()
    } else {
      this.sessionDate = getCurrentTimestamp()

      let task = await globalStore().makeCustomRequestToDB({
        action: 'select',
        table: 'session',
        conditions: [
          {
            where: ['session_id', this.sessionId],
          },
        ],
        runner: 'one',
      })

      if (task.success && task.data) {
        let session = task.data,
          pages

        try {
          pages = JSON.parse(session.pages)
        } catch (error) {
          pages = []
        }

        if (page) pages.push(page)

        await globalStore().makeCustomRequestToDB({
          action: 'update',
          table: 'session',
          conditions: [
            {
              where: ['session_id', this.sessionId],
            },
          ],
          data: {
            duration: (this.sessionDate - this.initSessionDate).toString(),
            pages: JSON.stringify(pages),
          },
        })
      }
    }
  },
  destroySession() {
    this.sessionId = this.sessionDate = this.initSessionDate = null
    this.resetSessionData()
  },

  resetSessionData() {
    this.userData = null
    this.connected = false
    this.rememberMe = false
  },
  async setSessionId() {
    this.sessionId = uuidv4()
    this.initSessionDate = this.sessionDate = getCurrentTimestamp()

    let task = await globalStore().requestClientLocation()

    let data = task.data

    if (data && data.ip && data.country && data.iso) {
      await globalStore().makeCustomRequestToDB({
        action: 'insert',
        table: 'session',
        data: {
          session_id: this.sessionId,
          session_ip: data.ip,
          duration: '0',
          location: data.country,
          country: data.iso,
          pages: JSON.stringify([]),
        },
      })
    }
  },
  setLoadingSessionId() {
    this.loadingSessionId = uuidv4()
  },

  updateUserData(data) {
    this.userData = data
  },
  updateConnected(c) {
    this.connected = c
  },
  updateRememberMe(r) {
    this.rememberMe = r
  },
}

export const useSessionStore = defineStore('session', {
  state,
  getters,
  actions,
})
