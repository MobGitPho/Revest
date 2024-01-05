export function usePage() {
  const route = useRoute()

  const globalStore = useGlobalStore()
  const dbPageStore = useDbPageStore()
  const dbMenuStore = useDbMenuStore()
  const dbSectionStore = useDbSectionStore()

  const currentPage = ref(null)

  const homePage = computed(() => {
    let filteredPages = dbPageStore.pages.filter((page) =>
      parseInt(page.is_home)
    )

    return filteredPages.length ? filteredPages[0] : null
  })

  const pageByMenuItem = computed(() => {
    if (!route.name) return null

    let parts = route.name.split('-')

    let menuItem =
      parts.length === 3
        ? dbMenuStore.menuItems.find((item) => item.id == parseInt(parts[2]))
        : null

    if (menuItem && menuItem.target)
      return dbPageStore.pages.find((page) => page.id == menuItem.target)

    return null
  })

  const sectionsArray = (data) => {
    let sectionsJSONArray = [],
      sections = [],
      array

    try {
      array = JSON.parse(data)
    } catch (e) {
      array = []
    }

    _.forIn(globalStore.sectionsJSONData, function (value, key) {
      sectionsJSONArray.push(value)
    })

    array.forEach((item) => {
      let section = sectionsJSONArray.find((s) => s.uid == item)
      let sectionData = dbSectionStore.sections.find((s) => s.uid == item)

      if (section) sections.push({ sid: section.sid, data: sectionData })
    })

    return sections.map((section) => {
      let finalSid = section.sid

      if (section.sid.includes('__')) finalSid = section.sid.split('__')[0]

      return {
        component: _.upperFirst(_.camelCase(finalSid.trim())),
        id: section.sid.trim(),
        data: section.data,
      }
    })
  }

  currentPage.value =
    route.name == 'home' ? homePage.value : pageByMenuItem.value

  return {
    homePage,
    currentPage,
    pageByMenuItem,
    sectionsArray,
  }
}
