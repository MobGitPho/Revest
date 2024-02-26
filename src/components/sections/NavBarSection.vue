<script setup>
  // section: NavBarSection
  import { MenuLocations } from '@/utils/enums'

  const { t } = useI18n()
  const isOpen = ref(false)
  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo, websiteOwnerInfo, websitePicsInfo } = useInfo()
  const { tr, res } = useGlobal()
  const { openLoginPage, getLoginLink, openRegisterPage, getRegisterLink } =
    useNews()
  const { currentParentMenuItems, open, currentChildrenMenuItems } = useMenu()
  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('wid_1')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')
  //var mn = currentParentMenuItems(MenuLocations.HEADER);
  //var mc = currentChildrenMenuItems(, MenuLocations.HEADER)

  const openMenu = (op) => {
    isOpen.value = !op
    // console.log('op', isOpen.value)
    return isOpen
  }
  const showSubMen = (op) => {
    var sho = ''
    if (op == true) {
      sho = 'show'
    }

    return sho
  }
</script>

<template>
  <!-- navbar__active    -->
  <header class="header header__active">
    <nav
      :class="
        isOpen == true
          ? 'navbar navbar-expand-xl navbar__active'
          : 'navbar navbar-expand-xl'
      ">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img
            :src="res(websitePicsInfo?.mainLogo)"
            style="width: 131px; height: 40px; object-fit: cover"
            alt="Logo"
            class="logo" />
        </a>
        <div class="navbar__out order-2 order-xl-3">
          <div class="nav__group__btn">
            <a
              :href="getLoginLink()"
              @click.prevent="openLoginPage()"
              class="log d-none d-sm-block">
              {{ t('Log In') }}
            </a>
            <a
              :href="getRegisterLink()"
              @click.prevent="openRegisterPage()"
              class="button button--effect d-none d-sm-block">
              {{ t('Join Now') }} <i class="fa-solid fa-arrow-right-long"></i>
            </a>
          </div>
          <button
            :class="
              isOpen == true
                ? 'navbar-toggler toggle-active'
                : 'navbar-toggler collapsed'
            "
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#primaryNav"
            @click.prevent="openMenu(isOpen)"
            aria-controls="primaryNav"
            :aria-expanded="isOpen == true ? 'true' : 'false'"
            aria-label="Toggle Primary Nav">
            <span class="icon-bar top-bar"></span>
            <span class="icon-bar middle-bar"></span>
            <span class="icon-bar bottom-bar"></span>
          </button>
        </div>
        <div
          :class="`navbar-collapse order-3 order-xl-2 collapse ${showSubMen(
            isOpen
          )}`"
          id="primaryNav">
          <ul class="navbar-nav">
            <li
              v-for="parentMenuItem in currentParentMenuItems(
                MenuLocations.HEADER
              )"
              :key="'menu-' + parentMenuItem.id"
              class="nav-item dropdown">
              <a
                id="navbarHomeDropdown"
                class="nav-link"
                href="javascript:void(0)"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                @click.prevent="open(parentMenuItem)">
                {{ tr(parentMenuItem.name) }}
              </a>

              <ul
                v-show="
                  currentChildrenMenuItems(
                    parentMenuItem.id,
                    MenuLocations.HEADER
                  )
                "
                class="dropdown-menu"
                aria-labelledby="navbarHomeDropdown">
                <li
                  v-for="childrenMenuItem in currentChildrenMenuItems(
                    parentMenuItem.id,
                    MenuLocations.HEADER
                  )"
                  :key="'menu-' + childrenMenuItem.id"
                  @click.prevent="
                    open(childrenMenuItem ? childrenMenuItem : parentMenuItem)
                  ">
                  <a class="dropdown-item" :href="`${childrenMenuItem.path}`"
                    >{{ tr(childrenMenuItem.name) }}
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item d-block d-sm-none">
              <a
                :href="getLoginLink()"
                @click.prevent="openLoginPage()"
                class="nav-link"
                >{{ t('Log In') }}</a
              >
            </li>
            <li class="nav-item d-block d-sm-none">
              <a
                :href="getRegisterLink()"
                @click.prevent="openRegisterPage()"
                class="button button--effect button--last"
                >{{ t('Join Now') }} <i class="fa-solid fa-arrow-right-long"></i
              ></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>
<style scoped>
  nav {
    z-index: 99;
  }

  .navbar__active {
    -webkit-box-shadow: 0px 4px 24px 0px rgba(19, 33, 110, 0.25);
    box-shadow: 0px 4px 24px 0px rgba(19, 33, 110, 0.25);
    background-color: #ffffff;
  }
</style>
