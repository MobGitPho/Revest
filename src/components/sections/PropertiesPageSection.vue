<script setup>
  // section: PropertiesPageSection
  import { useRoute } from 'vue-router'
  import { useRouter } from 'vue-router'
  import { NCarousel, NSpace, NPagination, NProgress } from 'naive-ui'
  const { t } = useI18n()
  const route = useRoute()
  const router = useRouter()
  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { openPropertiesDetailsPage, getPropertiesDetailsLink } = useNews()
  const { websiteInfo } = useInfo()
  const { tr, res, rHtml } = useGlobal()
  const page = ref(1)
  var days = ref('00')
  var hours = ref('00')
  var minutes = ref('00')
  var seconds = ref('00')
  var millisecond = ref('00')
  const dbNewsArticleStore = useDbNewsArticleStore()
  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('wid_1')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('properties_section_item')
  const locat = getDuplicableWidgetsData('property_filter_location_section')
  const typLo = getDuplicableWidgetsData('property_filter_type_section')

  function apLocation(id) {
    const loca = locat.find((loc) => loc._id === id)
    return loca.location
  }
  function typLocation(id) {
    const loca = typLo.find((loc) => loc._id === id)
    return loca.typ
  }
  function paginateArray(array, pageSize, pageNumber) {
    const startIndex = (pageNumber - 1) * pageSize
    const endIndex = startIndex + pageSize
    return array.slice(startIndex, endIndex)
  }
  /*const openArticlePage = (article) => {
  if (article) {
    dbNewsArticleStore.article = article
    router.push(`/propertiesdetails/${article.slug}`)

  }
}*/

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
    <!-- Put your section template code here -->
    <section class="properties__filter section__space__bottom">
      <div class="container wow fadeInUp">
        <div class="properties__filter__wrapper">
          <h6>
            {{ t('Showing') }}
            <span>{{ duplicableWidgets.length }}</span> {{t('properties')}}
          </h6>
          <div class="grid__wrapper">
            <select class="grid__select">
              <option data-display="Sort By">{{t('Sort By')}}</option>
              <option value="grid">Date</option>
              <option value="list">{{t('Price')}}</option>
            </select>
          </div>
        </div>
        <div class="row property__grid__area__wrapper">
          <template
            v-for="(al, index) in paginateArray(
              duplicableWidgets,
              3,
              page
            ).reverse()"
            :key="index">
            <div class="col-xl-4 col-md-6 property__grid__area__wrapper__inner">
              <div class="property__list__wrapper property__grid">
                <div class="row d-flex align-items-center">
                  <div class="property__grid__area__wrapper__inner__two">
                    <div class="property__item__image column__space--secondary">
                      <div class="img__effect">
                        <a
                          :href="getPropertiesDetailsLink(al)"
                          @click.prevent="openPropertiesDetailsPage(al)">
                          <img :src="res(al?.image)" :alt="al.ville" />
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="property__grid__area__wrapper__inner__three">
                    <div class="property__item__content">
                      <div class="item__head">
                        <div class="item__head__left">
                          <h4>{{ apLocation(al?.ville) }}</h4>
                          <p>
                            <i class="fa-solid fa-location-dot"></i>
                            {{ al?.localisation }}
                          </p>
                        </div>
                        <div class="item__head__right">
                          <div class="countdown__wrapper">
                            <p class="secondary">
                              <i class="fa-solid fa-clock"></i>
                              {{ t('Left to invest') }}
                            </p>
                            <div class="countdown" v-if="diffComp = al?.time">
                              <h5>
                                <span class="days">
                                  {{ days != 0 ? days : '00' }}</span
                                ><span class="ref">d</span>
                                <span class="seperator">:</span>
                              </h5>
                              <h5>
                                <span class="hours">{{
                                  hours != 0 ? hours : '00'
                                }}</span
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
                            :percentage="al?.percent"
                            :indicator-placement="'inside'"
                            indicator-text-color="green"
                            color="green"
                            processing />
                        </div>
                        <div class="project__info">
                          <p class="project__has">
                            <span class="project__has__investors"
                              >{{ al?.nbinvest }} {{ t('Investors') }}</span
                            >
                            |
                            <span class="project__has__investors__amount"
                              ><i class="fa-solid fa-dollar-sign"></i>
                              {{ al?.price }}</span
                            >
                            <span class="project__has__investors__percent"
                              >({{ al?.percent }}%)</span
                            >
                          </p>
                          <p class="project__goal">
                            <i class="fa-solid fa-dollar-sign"></i>
                            {{ al?.total }} {{ t('Goal') }}
                          </p>
                        </div>
                      </div>
                      <div class="item__info">
                        <div class="item__info__single">
                          <p>{{ t('Annual Return') }}</p>
                          <h6>{{ al?.return }}</h6>
                        </div>
                        <div class="item__info__single">
                          <p>{{ t('Maximum Term') }}</p>
                          <h6>{{ al?.maxterm }} Months</h6>
                        </div>
                        <div class="item__info__single">
                          <p>{{ t('Property Type') }}</p>
                          <h6>{{ tr(typLocation(al?.typ_prop)) }}</h6>
                        </div>
                        <div class="item__info__single">
                          <p>{{ t('Distribution') }}</p>
                          <h6>{{ tr(al?.distribution) }}</h6>
                        </div>
                      </div>
                      <div class="item__footer">
                        <div class="item__security">
                          <div class="icon__box">
                            <img src="/assets/images/home.png" alt="Security" />
                          </div>
                          <div class="item__security__content">
                            <p class="secondary">{{ t('Security') }}</p>
                            <h6>{{ al?.security }}</h6>
                          </div>
                        </div>
                        <div class="item__cta__group">
                          <a
                            href="/registration"
                            class="button button--effect"
                            >{{ t('Invest Now') }}</a
                          >
                          <a
                            href="#"
                            class="button button--secondary button--effect"
                            @click.prevent="openArticlePage(al)"
                            >{{ t('Details') }}</a
                          >t
                        </div>
                      </div>
                      <div class="invest__cta__wrapper">
                        <div class="countdown__wrapper">
                          <p class="secondary">
                            <i class="fa-solid fa-clock"></i>
                            {{ t('Left to invest') }}
                          </p>
                          <div class="countdown" v-if="diffComp = al?.time">
                            <h5>
                              <span class="days">{{
                                days != 0 ? days : '00'
                              }}</span
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
                        <div class="invest__cta">
                          <a
                            href=""
                            class="button button--effect"
                            @click.prevent="openArticlePage(al)">
                            {{ t('Invest Now') }}
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </template>
        </div>
        <section>
          <n-space justify="center" style="margin-top: 2rem">
            <n-pagination
              v-model:page="page"
              :page-count="Math.ceil(duplicableWidgets.length / 3)" />
          </n-space>
        </section>
      </div>
    </section>
  </section>
</template>
<style scoped>
  select {
    border: 1px solid gainsboro;
    border-radius: 10px;
  }

  .grid__select {
    width: auto;
    align-items: center;
    padding-top: 10px;
    padding-bottom: 10px;
  }

  .n-pagination
    .n-pagination-item:not(
      .n-pagination-item--disabled
    ).n-pagination-item--active {
    color: #143b50;
    border-color: #e7bd67;
  }

  .n-pagination .n-pagination-item:not(.n-pagination-item--disabled):hover {
    color: #e7bd67;
  }
</style>
