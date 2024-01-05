import localforage from 'localforage'

import CryptoJS from 'crypto-js'
import { ENCRYPTION_KEY } from '@/utils/constants'

localforage.config({
  driver: [localforage.INDEXEDDB],
  name: 'Local DB',
  storeName: 'cache',
})

export const cacheStorages = [
  {
    storage: {
      getItem: async (key) => {
        try {
          const encrypted = await localforage.getItem(key)
          if (encrypted)
            return CryptoJS.AES.decrypt(encrypted, ENCRYPTION_KEY).toString(
              CryptoJS.enc.Utf8
            )
          else return encrypted
        } catch (error) {
          console.log(error)
        }
      },
      setItem: async (key, value) => {
        try {
          const encrypted = CryptoJS.AES.encrypt(
            value,
            ENCRYPTION_KEY
          ).toString()
          return await localforage.setItem(key, encrypted)
        } catch (error) {
          console.log(error)
        }
      },
      removeItem: async (key) => {
        try {
          return await localforage.removeItem(key)
        } catch (error) {
          console.log(error)
        }
      },
    },
  },
]
