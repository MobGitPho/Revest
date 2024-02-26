<script setup>
  // section: LoginHeaderSection

  const { t } = useI18n()
  const isOpen = ref(false)
  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo, websitePicsInfo } = useInfo()
  const { tr, res } = useGlobal()
  const { openLoginPage, getLoginLink, openRegisterPage, getRegisterLink } =
    useNews()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('wid_1')

  // Get duplicable widgets  class="collapse navbar-collapse order-3 order-xl-2"
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')

  const openMenu = (op) => {
    isOpen.value = !op
    //console.log('op', isOpen.value)
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
  <header class="header header--secondary">
    <nav class="navbar navbar-expand-xl">
      <div class="container">
        <a class="navbar-brand" href="/">
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
            class="navbar-toggler d-block d-sm-none"
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
