import { MenuItemTypes } from '@/utils/enums'
import { removeTrailingSlash, openWindowWithJS } from '@/utils/functions'

export function useMenu() {
  const dbMenuStore = useDbMenuStore()
  const globalStore = useGlobalStore()

  const route = useRoute()
  const router = useRouter()

  const currentMenuItem = computed(() => {
    let rawPath = route?.matched[0]?.path

    if (!rawPath) return null

    return dbMenuStore.menuItems.find(
      (item) => item.type == MenuItemTypes.INTERNAL_LINK && item.path == rawPath
    )
  })

  const getMenuByLocation = (location) => {
    let menuLocation = dbMenuStore.menuLocations.find(
      (ml) => ml.location == location
    )

    if (menuLocation)
      return dbMenuStore.menus.find((menu) => menu.id == menuLocation.menu)

    return null
  }

  const orderMenuItems = (items) => {
    let orderedItems = _.sortBy(items, function (obj) {
      return parseInt(obj.position, 10)
    })

    orderedItems.forEach((item) => {
      switch (parseInt(item.type)) {
        case MenuItemTypes.INTERNAL_LINK:
          item.href = item.path
            ? item.path.charAt(0) === '/'
              ? item.path
              : `/${item.path}`
            : '/'
          break

        case MenuItemTypes.EXTERNAL_LINK:
          item.href = item.target
          break

        case MenuItemTypes.MEGA:
          item.href = '#'
          break

        case MenuItemTypes.SECTION:
          {
            let menuItem = dbMenuStore.menuItems.find(
              (i) =>
                i.type == MenuItemTypes.INTERNAL_LINK && i.target == item.path
            )

            if (menuItem) {
              let path = menuItem.path
                ? menuItem.path.charAt(0) === '/'
                  ? menuItem.path
                  : `/${menuItem.path}`
                : '/'

              let sectionsJSONArray = []

              _.forIn(globalStore.sectionsJSONData, function (value, key) {
                sectionsJSONArray.push(value)
              })

              let section = sectionsJSONArray.find((s) => s.uid == item.target)

              item.href = `${path == '/' ? path : removeTrailingSlash(path)}#${
                section.sid
              }`
            } else item.href = '#'
          }
          break
      }
    })

    return orderedItems
  }

  const currentParentMenuItems = (location) => {
    let currentMenu = getMenuByLocation(location)

    if (currentMenu && dbMenuStore.menuItems) {
      let items = dbMenuStore.menuItems.filter(
        (item) =>
          item.menu == currentMenu.id &&
          !parseInt(item.parent) &&
          parseInt(item.display)
      )

      return orderMenuItems(items)
    } else return []
  }

  const currentChildrenMenuItems = (parent, location) => {
    let currentMenu = getMenuByLocation(location)

    if (currentMenu && dbMenuStore.menuItems) {
      let items = dbMenuStore.menuItems.filter(
        (item) =>
          item.menu == currentMenu.id &&
          item.parent == parent &&
          parseInt(item.display)
      )

      return orderMenuItems(items)
    } else return []
  }

  const open = (item) => {
    switch (parseInt(item.type)) {
      case MenuItemTypes.SECTION:
        router.push(item.href)
        break

      case MenuItemTypes.INTERNAL_LINK:
        router.push(item.href)
        break

      case MenuItemTypes.EXTERNAL_LINK:
        openWindowWithJS(item.href, [], { target: '_blank', method: 'GET' })
        break
    }
  }

  return {
    currentMenuItem,
    getMenuByLocation,
    orderMenuItems,
    currentParentMenuItems,
    currentChildrenMenuItems,
    open,
  }
}
