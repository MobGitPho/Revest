import { STORAGE_API_BASE_URL } from '@/utils/constants'

export function useGlobal() {
  const { locale } = useI18n()

  const isXLargeScreen = useMediaQuery('(max-width: 1200px)')
  const isLargeScreen = useMediaQuery('(max-width: 992px)')
  const isMediumScreen = useMediaQuery('(max-width: 768px)')
  const isSmallScreen = useMediaQuery('(max-width: 576px)')

  const globalStore = useGlobalStore()

  const resolveLink = (part) => {
    if (part) {
      if (_v.isURL(part)) return encodeURI(part)
      else return encodeURI(STORAGE_API_BASE_URL + part)
    }

    return ''
  }

  const res = (part) => {
    return resolveLink(part)
  }

  const getTranslation = (data) => {
    let parsedData

    try {
      parsedData = JSON.parse(data)
    } catch (e) {
      parsedData = {}
    }

    return (
      parsedData[locale.value.toUpperCase()] || (parsedData['FR'] ?? data )|| ''
    )
  }

  const tr = (data) => {
    return getTranslation(data)
  }

  const resolveHtmlLinks = (data) => {
    if (!data) return ''

    let str = getTranslation(data).replace(
      new RegExp('{{BASE_URL}}', 'g'),
      STORAGE_API_BASE_URL
    )
    let audioList = str.match(/\[audio\](.*?)\[\/?audio\]/g)
    let videoList = str.match(/\[video\](.*?)\[\/?video\]/g)

    audioList?.forEach((item) => {
      let url = item.replace(/\[\/?audio\]/g, '')

      str = str.replace(
        item,
        `<br><p><audio preload="all" controls style="width: 100%"><source src="${
          STORAGE_API_BASE_URL + 'root/medias/' + url
        }"></audio></p><br>`
      )
    })

    videoList?.forEach((item) => {
      let url = item.replace(/\[\/?video\]/g, '')

      str = str.replace(
        item,
        `<br><p><video controls style="width: 100%"><source src="${
          STORAGE_API_BASE_URL + 'root/medias/' + url
        }"></video></p><br>`
      )
    })

    return str
  }

  const rHtml = (data) => {
    return resolveHtmlLinks(data)
  }

  const request = async (payload, type = 'json') => {
    return await globalStore.makeCustomRequestToDB(payload, type)
  }

  return {
    tr,
    res,
    rHtml,
    request,
    resolveLink,
    getTranslation,
    resolveHtmlLinks,
    isXLargeScreen,
    isLargeScreen,
    isMediumScreen,
    isSmallScreen,
  }
}
