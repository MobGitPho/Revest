<script setup>
  // section: FeaturedPropSection
  import { NProgress } from 'naive-ui'
  import { useRoute } from 'vue-router'
  import { useRouter } from 'vue-router'
  const { t } = useI18n()
  const route = useRoute()
  const router = useRouter()
  const {
    getPropertiesLink,
    openPropertiesPage,
    openPropertiesDetailsPage,
    getPropertiesDetailsLink,
    openRegisterPage,
    getRegisterLink,
  } = useNews()
  var days = ref('00')
  var hours = ref('00')
  var minutes = ref('00')
  var seconds = ref('00')
  var millisecond = ref('00')
  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res } = useGlobal()
  const dbNewsArticleStore = useDbNewsArticleStore()
  var jJ = ref('00')
  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('feature_section')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('properties_section_item')

  const locat = getDuplicableWidgetsData('property_filter_location_section')
  const typLo = getDuplicableWidgetsData('property_filter_type_section')

  function appFeature(proprietes) {
    const mesFeat = proprietes.filter((v) => v?.feature === 'OUI')

    return mesFeat?.slice(-4).reverse()
  }
  function apLocation(id) {
    const loca = locat.find((loc) => loc?._id === id)
    return loca.location
  }
  function typLocation(id) {
    const loca = typLo.find((loc) => loc?._id === id)
    return loca.typ
  }

  const diffComp = computed({
    get() {
      return minutes.value
    },
    set(dte) {
      var da = new Date()
      var dp = new Date(dte)
      if (da > dp) {
        days = '00'
        hours = '00'
        minutes = '00'
        seconds = '00'
        millisecond = '00'
      } else {
        var diffInSeconds = Math.abs(dp - da) / 1000
        days = Math.floor(diffInSeconds / 60 / 60 / 24)
        hours = Math.floor((diffInSeconds / 60 / 60) % 24)
        minutes = Math.floor((diffInSeconds / 60) % 60)
        seconds = Math.floor(diffInSeconds % 60)
        millisecond = Math.round(
          (diffInSeconds - Math.floor(diffInSeconds)) * 1000
        )
      }
      return minutes.value
    },
  })
</script>

<template>
  <section>
    <section class="featured__properties section__space">
      <div class="container">
        <div class="featured__properties__area wow fadeInUp">
          <div class="title__with__cta">
            <div class="row d-flex align-items-center">
              <div class="col-lg-8">
                <h2>{{ tr(uniqueWidget?.title) }}</h2>
              </div>
              <div class="col-lg-4">
                <div class="text-start text-lg-end">
                  <a
                    :href="getPropertiesLink()"
                    @click.prevent="openPropertiesPage()"
                    class="button button--secondary button--effect">
                    {{ tr(uniqueWidget?.button) }}</a
                  >
                </div>
              </div>
            </div>
          </div>
          <template
            v-for="(ap, index) in appFeature(duplicableWidgets)"
            :key="index">
            <div class="property__list__wrapper">
              <div class="row d-flex align-items-center">
                <div class="col-lg-5">
                  <div class="property__item__image column__space--secondary">
                    <div class="img__effect">
                      <a
                        :href="getPropertiesDetailsLink(ap)"
                        @click.prevent="openPropertiesDetailsPage(ap)">
                        <img
                          :src="res(ap?.image)"
                          style="width: 426px; height: 330px; object-fit: cover"
                          alt="Los Angeles" />
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-7">
                  <div class="property__item__content">
                    <div class="item__head">
                      <div class="item__head__left">
                        <h4>{{ apLocation(ap?.ville) }}</h4>
                        <p>
                          <i class="fa-solid fa-location-dot"></i>
                          {{ ap?.localisation }}
                        </p>
                      </div>
                      <div class="item__head__right">
                        <div class="countdown__wrapper">
                          <p class="secondary">
                            <i class="fa-solid fa-clock"></i>
                            {{ t('Left to invest') }}   
                          </p>
                          <div v-if="(diffComp = ap?.time)" class="countdown">
                            <h5>
                              <span class="days">
                                {{ days != 0 ? days : '00' }}</span
                              ><span class="ref">d</span>
                              <span class="seperator">:</span>
                            </h5>
                            <h5>
                              <span class="hours">
                                {{ hours != 0 ? hours : '00' }}</span
                              ><span class="ref">h</span>
                              <span class="seperator">:</span>
                            </h5>
                            <h5>
                              <span class="minutes">{{
                                minutes != 0 ? minutes : '00'
                              }}</span
                              ><span class="ref">m</span>
                              <span class="seperator"></span>
                            </h5>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="progress__type progress__type--two">
                      <div class="progress">
                        <n-progress
                          type="line"
                          :percentage="ap?.percent"
                          :indicator-placement="'inside'"
                          indicator-text-color="green"
                          color="green"
                          processing />
                      </div>
                      <div class="project__info">
                        <p class="project__has">
                          <span class="project__has__investors"
                            >{{ ap?.nbinvest }} {{ t('Investors') }}</span
                          >
                          |
                          <span class="project__has__investors__amount"
                            ><i class="fa-solid fa-dollar-sign"></i>
                            {{ ap?.price }}</span
                          >
                          <span class="project__has__investors__percent"
                            >({{ ap?.percent }}%)</span
                          >
                        </p>
                        <p class="project__goal">
                          <i class="fa-solid fa-dollar-sign"></i>
                          {{ ap?.total }} {{ t('Goal') }}
                        </p>
                      </div>
                    </div>
                    <div class="item__info">
                      <div class="item__info__single">
                        <p>{{ t('Annual Return') }}</p>
                        <h6>{{ ap?.return }}</h6>
                      </div>
                      <div class="item__info__single">
                        <p>{{ t('Maximum Term') }}</p>
                        <h6>{{ ap?.maxterm }} {{ t('Months') }}</h6>
                      </div>
                      <div class="item__info__single">
                        <p>{{ t('Property Type') }}</p>
                        <h6>{{ tr(typLocation(ap?.typ_prop)) }}</h6>
                      </div>
                      <div class="item__info__single">
                        <p>{{ t('Distribution') }}</p>
                        <h6>{{ tr(ap?.distribution) }}</h6>
                      </div>
                    </div>
                    <div class="item__footer">
                      <div class="item__security">
                        <div class="icon__box">
                          <img src="/assets/images/home.png" alt="Security" />
                        </div>
                        <div class="item__security__content">
                          <p class="secondary">{{ t('Security') }}</p>
                          <h6>{{ ap?.security }}</h6>
                        </div>
                      </div>
                      <div class="item__cta__group">
                        <a
                          :href="getRegisterLink()"
                          @click.prevent="openRegisterPage()"
                          class="button button--effect"
                          >{{ t('Invest Now') }}</a
                        >
                        <a
                          class="button button--secondary button--effect"
                          :href="getPropertiesDetailsLink(ap)"
                          @click.prevent="openPropertiesDetailsPage(ap)">
                          {{ t('Details') }}</a
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </template>
        </div>
      </div>
    </section>
  </section>
</template>
