import { defineStore } from 'pinia'

const globalStore = () => useGlobalStore()

const state = () => ({
  menus: [],
  menuItems: [],
  menuLocations: [],
})

const getters = {}

const actions = {
  async getAllMenus() {
    let task = await globalStore().makeRequestToDB({
      url: `/${MENU_CONTEXT}/all`,
    })

    if (task.success) this.menus = task.data
    else task.data = this.menus

    return task
  },
  async getAllMenuItems() {
    let task = await globalStore().makeRequestToDB({
      url: `/${MENU_CONTEXT}/items/all`,
    })

    if (task.success) this.menuItems = task.data
    else task.data = this.menuItems

    return task
  },
  async getAllMenuLocations() {
    let task = await globalStore().makeRequestToDB({
      url: `/${MENU_CONTEXT}/locations`,
    })

    if (task.success) this.menuLocations = task.data
    else task.data = this.menuLocations

    return task
  },
  async getMenuItemsByParent(parent) {
    let task = await globalStore().makeRequestToDB({
      url: `/${MENU_CONTEXT}/items/parent/${parent}`,
    })

    return task
  },
}

export const MENU_CONTEXT = 'menu'

export const useDbMenuStore = defineStore(`db/${MENU_CONTEXT}`, {
  state,
  getters,
  actions,
})
