import { createPinia } from 'pinia'
import { persistencePlugin } from 'pinia-persistence-plugin'

import CryptoJS from 'crypto-js'
import { ENCRYPTION_KEY } from '@/utils/constants'

export default createPinia().use(
  persistencePlugin({
    storeKeysPrefix: 'template',
    persistenceDefault: true,
    storageItemsDefault: [
      {
        storage: {
          getItem: (key) => {
            try {
              const encrypted = localStorage.getItem(key)
              if (encrypted)
                return CryptoJS.AES.decrypt(encrypted, ENCRYPTION_KEY).toString(
                  CryptoJS.enc.Utf8
                )
              else return encrypted
            } catch (error) {
              console.log(error)
            }
          },
          setItem: (key, value) => {
            try {
              const encrypted = CryptoJS.AES.encrypt(
                value,
                ENCRYPTION_KEY
              ).toString()
              return localStorage.setItem(key, encrypted)
            } catch (error) {
              console.log(error)
            }
          },
          removeItem: (key) => {
            try {
              return localStorage.removeItem(key)
            } catch (error) {
              console.log(error)
            }
          },
        },
      },
    ],
  })
)
