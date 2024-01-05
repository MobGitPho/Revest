import { getBaseUrl } from '@/utils/functions'

// General
// In development mode, put your server base url value to
// the variable`VITE_SERVER_URL` in `.env.development.local`
export var APP_BASE_URL = import.meta.env.VITE_SERVER_URL || getBaseUrl()
export const X_API_KEY = 'b47e8c19-9e29-4287-acb1-4f34481402a0'
export const API_REQUEST_HEADERS = {
  'X-API-Key': X_API_KEY,
}

// DB Api
export var DATABASE_API_BASE_URL = APP_BASE_URL + '/breeze-server/db-api/'

// Storage Api
export var STORAGE_API_BASE_URL = APP_BASE_URL + '/breeze-server/sto-api/'

// JSON Api
export var FILE_API_BASE_URL = APP_BASE_URL + '/breeze-server/file-api/'

// Client IP Api
export var CLIENT_IP_API_BASE_URL =
  APP_BASE_URL + '/breeze-server/client-ip-api/'

// IP Location Api
export var IP_LOCATION_API_BASE_URL =
  APP_BASE_URL + '/breeze-server/ip-location-api/'

// Send Email Api
export var SEND_EMAIL_API_BASE_URL =
  APP_BASE_URL + '/breeze-server/send-email-api/'
// Send Email Api Settings
// Set your SMTP username & password here
export const SMTP_USERNAME = '4320.smtp@gmail.com'
export const SMTP_PASSWORD = '5s3pN2CxMd5t5k1S2ygf'

// Cookie KeyNames
export const LANG_COOKIE = 'Lang'

// Crypto JS
export const ENCRYPTION_KEY = 'e1c53367-1352-4445-b2c3-be69adc2f428'
