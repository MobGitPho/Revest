import { defineStore } from 'pinia'
import { persistencePlugin } from 'pinia-persistence-plugin'
import { v4 as uuidv4 } from 'uuid'
import { getCurrentTimestamp } from '@/utils/functions'

const globalStore = () => useGlobalStore()


export const useAuthStore = defineStore('auth', {
  state: () => ({
    authDate: null,
    userData: null,
    isAuthenticated: false,
  }),
  getters: {
    isUserAuthenticated(state) {
      return computed(() =>  state.isAuthenticated)
    },
  },
  actions: {
    setUserData(data){
      this.userData = data;
      this.authDate = getCurrentTimestamp()
      this.isAuthenticated = true
    },
    logOut() {
      this.userData = null;
      this.authDate = null
      this.isAuthenticated = false
    },

    updateUserData(data) {
      this.userData = data;
    }
  }
})