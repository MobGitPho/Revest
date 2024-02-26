<script setup>
  // section: AllPropSection
  import { NProgress } from 'naive-ui'
  import { useRoute } from 'vue-router'
  import { useRouter } from 'vue-router'
  import { NCarousel, NSpace, NPagination } from 'naive-ui'
  const { t } = useI18n()
  const route = useRoute()
  const router = useRouter()
  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res } = useGlobal()
  const page = ref(1)
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

 /* const diffDate = (dte) => {
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
    return millisecond
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
    <section class="properties__grid section__space">
      <div class="container">
        <div class="properties__grid__area wow fadeInUp">
          <div class="title__with__cta">
            <div class="row d-flex align-items-center">
              <div class="col-lg-8">
                <h2>{{ t('All Properties') }}</h2>
              </div>
              <div class="col-lg-4">
                <div class="text-start text-lg-end">
                  <a
                    :href="getPropertiesLink()"
                    @click.prevent="openPropertiesPage()"
                    class="button button--secondary button--effect">
                    {{ t('Browse All Properties') }}</a
                  >
                </div>
              </div>
            </div>
          </div>
          <div class="property__grid__wrapper">
            <div class="row">
              <template
                v-for="(al, index) in paginateArray(
                  duplicableWidgets,
                  6,
                  page
                ).reverse()"
                :key="index">
                <div class="col-lg-4 col-xl-4">
                  <div class="property__grid__single">
                    <div class="img__effect">
                      <a
                        :href="getPropertiesDetailsLink(al)"
                        @click.prevent="openPropertiesDetailsPage(al)">
                        <img :src="res(al?.image)"  style="width: 336px; height: 2000px; object-fit: cover" alt="Property" />
                      </a>
                    </div>
                    <div class="property__grid__single__inner">
                      <h4>{{ apLocation(al?.ville) }}</h4>
                      <p class="sub__info">
                        <i class="fa-solid fa-location-dot"></i>
                        {{ al?.localisation }}s
                      </p>
                      <div class="progress__type">
                        <div class="progress">
                          <n-progress
                            type="line"
                            :percentage="al?.percent"
                            :indicator-placement="'inside'"
                            indicator-text-color="green"
                            color="green"
                            processing />
                        </div>

                        <p class="project__has">
                          <span class="project__has__investors"
                            >{{ al?.nbinvest }} {{t('Investors')}}</span
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
                      </div>
                      <div class="item__info">
                        <div class="item__info__single">
                          <p>{{t('Annual Return')}}</p>
                          <h6>{{ al?.return }}</h6>
                        </div>
                        <div class="item__info__single">
                          <p>{{t('Property Type')}}</p>
                          <h6>{{ tr(typLocation(al?.typ_prop)) }}</h6>
                        </div>
                      </div>
                      <div class="invest__cta__wrapper">
                        <div class="countdown__wrapper">
                          <p class="secondary">
                            <i class="fa-solid fa-clock"></i> {{t('Left to invest')}}
                          </p>
                          <div class="countdown" v-if="diffComp = al?.time">
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
                        <div class="invest__cta">
                          <a
                            :href="getPropertiesDetailsLink(al)"
                            class="button button--effect"
                            @click.prevent="openPropertiesDetailsPage(al)">
                            {{ t('Invest Now') }}
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </template>
            </div>
            <!--section>
              <n-space justify="center" style="margin-top: 2rem">
                <n-pagination
                  v-model:page="page"
                  :page-count="Math.ceil(duplicableWidgets.length / 6)" />
              </n-space>
            </section-->
          </div>
        </div>
      </div>
    </section>
  </section>
</template>
<style scoped>
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
