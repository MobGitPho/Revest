import { LANG_COOKIE } from '@/utils/constants'
import i18n from '@/i18n'

i18n.global.locale.value =
  localStorage.getItem(LANG_COOKIE) ||
  import.meta.env.VITE_I18N_FALLBACK_LOCALE ||
  'fr'

const { t } = i18n.global

export const VarTypes = {
  ARRAY: 'array',
  NUMBER: 'number',
  OBJECT: 'object',
  STRING: 'string',
  SYMBOL: 'symbol',
  BIGINT: 'bigint',
  BOOLEAN: 'boolean',
  FUNCTION: 'function',
  UNDEFINED: 'undefined',
}

export const Settings = {
  DATE_FORMAT: {
    NAME: 'DATE_FORMAT',
    DEFAULT: 'DD MMM YYYY',
  },
  COMPRESS_IMAGES: {
    NAME: 'COMPRESS_IMAGES',
    DEFAULT: 0,
  },
  COMPRESS_THRESHOLD: {
    NAME: 'COMPRESS_THRESHOLD',
    DEFAULT: 1,
  },
  WEBSITE_CURRENCY: {
    NAME: 'WEBSITE_CURRENCY',
    DEFAULT: 1,
  },
  ADMIN_FOLDER: {
    NAME: 'ADMIN_FOLDER',
    DEFAULT: 'breeze',
  },
  E_COMMERCE_MODULE: {
    NAME: 'E_COMMERCE_MODULE',
    DEFAULT: 0,
  },
  NEWS_MODULE: {
    NAME: 'NEWS_MODULE',
    DEFAULT: 0,
  },
  NEWSLETTER_MODULE: {
    NAME: 'NEWSLETTER_MODULE',
    DEFAULT: 1,
  },
  ADS_MODULE: {
    NAME: 'ADS_MODULE',
    DEFAULT: 0,
  },
  SUBSCRIPTION_MODULE: {
    NAME: 'SUBSCRIPTION_MODULE',
    DEFAULT: 0,
  },
  KEEP_DELETED_FILES: {
    NAME: 'KEEP_DELETED_FILES',
    DEFAULT: 1,
  },
  DISPLAY_TRASH: {
    NAME: 'DISPLAY_TRASH',
    DEFAULT: 1,
  },
  CUSTOM_THUMBNAILS: {
    NAME: 'CUSTOM_THUMBNAILS',
    DEFAULT: '',
  },
  THUMBNAILS_FORMAT: {
    NAME: 'THUMBNAILS_FORMAT',
    DEFAULT: 1,
  },
  IMAGE_PROCESSING_LIBRARY: {
    NAME: 'IMAGE_PROCESSING_LIBRARY',
    DEFAULT: 'gd',
  },
  ENABLE_ADMIN_NOTIFICATIONS: {
    NAME: 'ENABLE_ADMIN_NOTIFICATIONS',
    DEFAULT: 1,
  },
  ENABLE_EMAIL_NOTIFICATIONS: {
    NAME: 'ENABLE_EMAIL_NOTIFICATIONS',
    DEFAULT: 1,
  },
  DISCOURAGE_INDEXING: {
    NAME: 'DISCOURAGE_INDEXING',
    DEFAULT: 0,
  },
  NEWSLETTER_EMAIL: {
    NAME: 'NEWSLETTER_EMAIL',
    DEFAULT: '',
  },
}

export const WebsiteInfo = {
  FAVICON: {
    NAME: 'FAVICON',
    DEFAULT: '',
  },
  MAIN_LOGO: {
    NAME: 'MAIN_LOGO',
    DEFAULT: '',
  },
  FOOTER_LOGO: {
    NAME: 'FOOTER_LOGO',
    DEFAULT: '',
  },
  FOOTER_IMAGE: {
    NAME: 'FOOTER_IMAGE',
    DEFAULT: '',
  },
  TITLE: {
    NAME: 'TITLE',
    DEFAULT: '',
  },
  DESCRIPTION: {
    NAME: 'DESCRIPTION',
    DEFAULT: '',
  },
  HEADER_TEXT: {
    NAME: 'HEADER_TEXT',
    DEFAULT: '',
  },
  META_KEYS: {
    NAME: 'META_KEYS',
    DEFAULT: '',
  },
  NAME: {
    NAME: 'NAME',
    DEFAULT: '',
  },
  ADDRESS: {
    NAME: 'ADDRESS',
    DEFAULT: '',
  },
  PHONE: {
    NAME: 'PHONE',
    DEFAULT: '',
  },
  EMAIL: {
    NAME: 'EMAIL',
    DEFAULT: '',
  },
  POSTAL_BANK: {
    NAME: 'POSTAL_BANK',
    DEFAULT: '',
  },
  OPENING_HOURS: {
    NAME: 'OPENING_HOURS',
    DEFAULT: '',
  },
  LOCATION: {
    NAME: 'LOCATION',
    DEFAULT: '{"lat": 0.0, "lng": 0.0}',
  },
  FACEBOOK: {
    NAME: 'FACEBOOK',
    DEFAULT: '',
  },
  TWITTER: {
    NAME: 'TWITTER',
    DEFAULT: '',
  },
  WHATSAPP: {
    NAME: 'WHATSAPP',
    DEFAULT: '',
  },
  INSTAGRAM: {
    NAME: 'INSTAGRAM',
    DEFAULT: '',
  },
  LINKEDIN: {
    NAME: 'LINKEDIN',
    DEFAULT: '',
  },
  YOUTUBE: {
    NAME: 'YOUTUBE',
    DEFAULT: '',
  },
  TWITCH: {
    NAME: 'TWITCH',
    DEFAULT: '',
  },
  DISCORD: {
    NAME: 'DISCORD',
    DEFAULT: '',
  },
  WEBSITE_URL: {
    NAME: 'WEBSITE_URL',
    DEFAULT: '',
  },
}

export const MediaTypes = {
  DOCUMENT: 1,
  IMAGE: 2,
  VIDEO: 3,
  AUDIO: 4,
  OTHERS: 5,
}

export const MenuLocations = {
  TOP_HEADER: 1,
  HEADER: 2,
  FOOTER: 3,
}

export const MenuItemTypes = {
  INTERNAL_LINK: 1,
  EXTERNAL_LINK: 2,
  MEGA: 3,
  SECTION: 4,
}

export const WidgetTypes = {
  UNIQUE: 0,
  REPLICABLE: 1,
}

export const Currencies = {
  XOF: {
    id: 1,
    code: 'CFA',
    label: 'XOF',
    precision: 0,
    step: 1,
  },
  EUR: {
    id: 2,
    code: '€',
    label: 'EUR',
    precision: 2,
    step: 0.1,
  },
  USD: {
    id: 3,
    code: '$',
    label: 'USD',
    precision: 2,
    step: 0.1,
  },
}

export const DefaultThumbnails = {
  MINI: {
    label: 'MINI',
    height: 150,
    width: 150,
  },
  SMALL: {
    label: 'SMALL',
    height: 300,
    width: 300,
  },
  MEDIUM: {
    label: 'MEDIUM',
    height: 800,
    width: 800,
  },
  LARGE: {
    label: 'LARGE',
    height: 1024,
    width: 1024,
  },
}

export const ThumbnailFormats = {
  AUTOHEIGHT: 1,
  AUTOWIDTH: 2,
  STRICT: 3,
}

export const ArticleStatus = {
  DRAFT: 1,
  PENDING: 2,
  PUBLISHED: 3,
  TRASH: 4,
}
