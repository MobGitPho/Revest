import pinia from './stores'

export default async () => {
  const dbAdStore = useDbAdStore(pinia)
  const menuStore = useDbMenuStore(pinia)
  const globalStore = useGlobalStore(pinia)
  const dbPageStore = useDbPageStore(pinia)
  const sessionStore = useSessionStore(pinia)
  const dbWidgetStore = useDbWidgetStore(pinia)
  const dbSectionStore = useDbSectionStore(pinia)
  const dbNewsTagStore = useDbNewsTagStore(pinia)
  const dbWebsiteInfoStore = useDbWebsiteInfoStore(pinia)
  const dbNewsCategoryStore = useDbNewsCategoryStore(pinia)

  /* Start user session */
  sessionStore.setLoadingSessionId()
  sessionStore.startSession()

  if (window.infoItems) dbWebsiteInfoStore.websiteInfo = window.infoItems
  else await dbWebsiteInfoStore.initWebsiteInfoDB()

  if (window.newsCategories)
    dbNewsCategoryStore.categories = window.newsCategories
  else await dbNewsCategoryStore.getAllCategories()

  if (window.sections) dbSectionStore.sections = window.sections
  else await dbSectionStore.getAllSections()

  if (window.widgets) dbWidgetStore.widgets = window.widgets
  else await dbWidgetStore.getAllWidgets()

  if (window.pages) dbPageStore.pages = window.pages
  else await dbPageStore.getAllPages()

  if (window.menus) menuStore.menus = window.menus
  else await menuStore.getAllMenus()

  if (window.menuItems) menuStore.menuItems = window.menuItems
  else await menuStore.getAllMenuItems()

  if (window.menuLocations) menuStore.menuLocations = window.menuLocations
  else await menuStore.getAllMenuLocations()

  if (window.widgetsJsonData && window.sectionsJsonData) {
    globalStore.widgetsJSONData = window.widgetsJsonData
    globalStore.sectionsJSONData = window.sectionsJsonData
  } else await globalStore.loadJSONData()

  dbAdStore.getAllIdentifiers()
  dbNewsTagStore.getAllTags()
  dbAdStore.getAllAds()
}
