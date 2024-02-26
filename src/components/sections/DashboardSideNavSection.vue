<script setup>
  // section: DashboardSideNavSection

  import { useRouter } from 'vue-router'

  const { t } = useI18n()

  const route = useRoute()
  const router = useRouter()
  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res } = useGlobal()

  const props = defineProps({
    sideState: String,
  })

  const emit = defineEmits(['update:sideState'])

  const sideStateComputed = computed({
    get: () => {
      return props.sideState
    },
    set: (value) => {
      emit('update:sideState', value)
    },
  })
  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('wid_1')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')

  const closeSidebar = () => {
    sideStateComputed.value = false
  }

  const isId = ref()
  const clickActive = (id,nav) => {
    isId.value = id
    router.push(`/${nav}`)
  }
</script>

<template>
  <div :class="`col-xxl-3`">
    <div class="sidebar" :class="{ sidebar__active: sideStateComputed }">
      <a href="" class="close__sidebar" @click.prevent="closeSidebar()">
        <i class="fa-solid fa-xmark"></i>
      </a>
      <div class="sidenav__wrapper">
        <ul>
          <li>
            <a
              href="/dashboard"
              :class="isId == 0 ? 'sidenav__active' : ''"
              @click.prevent="clickActive(0,'dashboard')">
              <img src="/assets/images/icons/dashboard.png" alt="Dashboard" />
              Dashboard
            </a>
          </li>
          <li>
            <a
              href="/investment"
              :class="isId == 1 ? 'sidenav__active' : ''"
              @click.prevent="clickActive(1,'investment')">
              <img
                src="/assets/images/icons/investments.png"
                alt="Investments" />
              Investments
            </a>
          </li>
          <li>
            <a
              href="/transaction"
              :class="isId == 2 ? 'sidenav__active' : ''"
              @click.prevent="clickActive(2,'transaction')">
              <img
                src="/assets/images/icons/transactions.png"
                alt="Transactions" />
              Transactions
            </a>
          </li>
          <li>
            <a
              href="/withdraw"
              :class="isId == 3 ? 'sidenav__active' : ''"
              @click.prevent="clickActive(3,'withdraw')">
              <img src="/assets/images/icons/withdraw.png" alt="Withdraw" />
              Withdraw
            </a>
          </li>
          <li>
            <a
              href="/account"
              :class="isId == 4 ? 'sidenav__active' : ''"
              @click.prevent="clickActive(4,'account')">
              <img src="/assets/images/icons/account.png" alt="Account" />
              Account
            </a>
          </li>
        </ul>
        <hr />
        <ul class="logout">
          <li>
            <a href="/login">
              <img src="/assets/images/icons/logout.png" alt="Logout" /> Logout
            </a>
          </li>
        </ul>
      </div>
      <div class="sidenav__wrapper sidenav__footer">
        <h6>Last Login</h6>
        <hr />
        <div class="sidenav__time">
          <p class="secondary">
            <img src="/assets/images/icons/calendar.png" alt="Calendar" />
            02.01.2022
          </p>
          <p class="secondary">15:48:13</p>
        </div>
      </div>
    </div>
  </div>
</template>
