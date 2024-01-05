import { WebsiteInfo } from '@/utils/enums'

export function useInfo() {
  const dbWebsiteInfoStore = useDbWebsiteInfoStore()

  const websiteInfo = ref({
    title: '',
    description: '',
    headerText: '',
    metaKeys: '',
  })

  const websitePicsInfo = ref({
    favicon: '',
    mainLogo: '',
    footerLogo: '',
    footerImage: '',
  })

  const websiteOwnerInfo = ref({
    name: '',
    address: '',
    phone: '',
    email: '',
    location: '',
    postalBank: '',
    openingHours: '',
  })

  const websiteMoreInfo = ref({
    facebook: '',
    twitter: '',
    whatsapp: '',
    instagram: '',
    linkedin: '',
    youtube: '',
    twitch: '',
    discord: '',
    websiteUrl: '',
  })

  const socialNetworks = computed(() => {
    let networks = []

    _.forIn(websiteMoreInfo.value, function (value, key) {
      if (key !== 'websiteUrl') networks.push({ name: key, url: value })
    })

    return networks
  })

  const fetchInfoData = () => {
    websitePicsInfo.value.favicon = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.FAVICON.NAME
    )
    websitePicsInfo.value.mainLogo = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.MAIN_LOGO.NAME
    )
    websitePicsInfo.value.footerLogo = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.FOOTER_LOGO.NAME
    )
    websitePicsInfo.value.footerImage = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.FOOTER_IMAGE.NAME
    )

    websiteInfo.value.title = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.TITLE.NAME
    )
    websiteInfo.value.description = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.DESCRIPTION.NAME
    )
    websiteInfo.value.headerText = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.HEADER_TEXT.NAME
    )
    websiteInfo.value.metaKeys = dbWebsiteInfoStore
      .getWebsiteInfoValue(WebsiteInfo.META_KEYS.NAME)
      .replace(';', ', ')

    websiteOwnerInfo.value.name = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.NAME.NAME
    )
    websiteOwnerInfo.value.phone = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.PHONE.NAME
    )
    websiteOwnerInfo.value.email = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.EMAIL.NAME
    )
    websiteOwnerInfo.value.address = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.ADDRESS.NAME
    )
    websiteOwnerInfo.value.location = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.LOCATION.NAME
    )
    websiteOwnerInfo.value.postalBank = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.POSTAL_BANK.NAME
    )
    websiteOwnerInfo.value.openingHours =
      dbWebsiteInfoStore.getWebsiteInfoValue(WebsiteInfo.OPENING_HOURS.NAME)

    websiteMoreInfo.value.facebook = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.FACEBOOK.NAME
    )
    websiteMoreInfo.value.twitter = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.TWITTER.NAME
    )
    websiteMoreInfo.value.whatsapp = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.WHATSAPP.NAME
    )
    websiteMoreInfo.value.instagram = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.INSTAGRAM.NAME
    )
    websiteMoreInfo.value.linkedin = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.LINKEDIN.NAME
    )
    websiteMoreInfo.value.youtube = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.YOUTUBE.NAME
    )
    websiteMoreInfo.value.twitch = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.TWITCH.NAME
    )
    websiteMoreInfo.value.discord = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.DISCORD.NAME
    )
    websiteMoreInfo.value.websiteUrl = dbWebsiteInfoStore.getWebsiteInfoValue(
      WebsiteInfo.WEBSITE_URL.NAME
    )
  }

  watch(
    () => dbWebsiteInfoStore.websiteInfo,
    (val, oldVal) => {
      fetchInfoData()
    },
    {
      immediate: true,
      deep: true,
    }
  )

  return {
    websiteInfo,
    websitePicsInfo,
    websiteOwnerInfo,
    websiteMoreInfo,
    socialNetworks,
    fetchInfoData,
  }
}
