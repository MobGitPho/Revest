import { createRouter, createWebHistory } from 'vue-router'

import { MenuItemTypes } from '@/utils/enums'

import pinia from '@/stores'

export default () => {
  var routes = [
    {
      path: '/',
      name: 'home',
      component: () => import('@/views/Container.vue'),
    },
  ]

  const menuStore = useDbMenuStore(pinia)

  /* Dynamically add page routes */
  menuStore.menuItems.forEach((item) => {
    if (item.type == MenuItemTypes.INTERNAL_LINK) {
      routes.push({
        path: item.path
          ? item.path.charAt(0) === '/'
            ? item.path
            : `/${item.path}`
          : '/',
        name: `route-menu-${item.id}`,
        component: () => import('@/views/Container.vue'),
      })
    }
  })

  routes.push({
    path: '/:pathMatch(.*)*',
    name: '404',
    component: () => import('@/views/NotFound.vue'),
    hidden: true,
  })

  const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
    scrollBehavior(to, from, savedPosition) {
      return new Promise((resolve, reject) => {
        setTimeout(() => {
          if (to.hash) resolve({ el: to.hash, behavior: 'smooth' })
          else resolve({ left: 0, top: 0, behavior: 'smooth' })
        }, 500)
      })
    },
  })

  router.beforeEach((to, from, next) => {
    const sessionStore = useSessionStore(),
      globalStore = useGlobalStore()

    globalStore.previousRouteName = from.name
    globalStore.nextRouteName = to.name

    sessionStore.updateSession(to.path)

    next()
  })

  return router
}
