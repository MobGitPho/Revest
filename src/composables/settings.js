import { Settings, VarTypes, DefaultThumbnails } from '@/utils/enums'

export function useSettings() {
  const settingStore = useDbSettingStore()

  const enableEmailNotifications = ref(false)

  const defaultThumbnails = ref([])
  const customThumbnails = ref([])
  const thumbnailsFormat = ref(0)
  const thumbnails = ref([])

  const newsletterEmail = ref('')
  const currency = ref(0)

  const fetchSettingsData = async () => {
    _.forIn(DefaultThumbnails, function (value, key) {
      defaultThumbnails.value.push(value)
    })

    thumbnailsFormat.value = settingStore.getSettingValue(
      Settings.THUMBNAILS_FORMAT.NAME,
      VarTypes.NUMBER
    )
    customThumbnails.value = settingStore.getSettingValue(
      Settings.CUSTOM_THUMBNAILS.NAME,
      VarTypes.ARRAY
    )
    thumbnails.value = defaultThumbnails.value
    customThumbnails.value.forEach((thumbnail) => {
      thumbnails.value.push(thumbnail)
    })

    enableEmailNotifications.value = settingStore.getSettingValue(
      Settings.ENABLE_EMAIL_NOTIFICATIONS.NAME,
      VarTypes.BOOLEAN
    )

    newsletterEmail.value = settingStore.getSettingValue(
      Settings.NEWSLETTER_EMAIL.NAME
    )
    currency.value = settingStore.getSettingValue(
      Settings.WEBSITE_CURRENCY.NAME,
      VarTypes.NUMBER
    )
  }

  watch(
    () => settingStore.settings,
    (val, oldVal) => {
      fetchSettingsData()
    },
    {
      immediate: true,
      deep: true,
    }
  )

  return {
    enableEmailNotifications,
    defaultThumbnails,
    customThumbnails,
    thumbnailsFormat,
    thumbnails,
    newsletterEmail,
    currency,
    fetchSettingsData,
  }
}
