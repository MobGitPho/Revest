<script setup>
  // section: MarketSmallSection

  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res, rHtml } = useGlobal()
  const { openPropertiesPage, getPropertiesLink } = useNews()
  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('market_section')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')
</script>

<template>
  <section>
    <!-- Put your section template code here -->
    <section class="market market--two market--three section__space__bottom">
      <div class="container">
        <div
          class="market__area market__area--two section__space bg__img"
          data-background="('/assets/images/light-two.png')">
          <div class="row d-flex align-items-center">
            <div class="col-lg-6">
              <div class="content">
                <h5 class="neutral-top">{{ tr(uniqueWidget?.subtitle) }}</h5>
                <h2>{{ tr(uniqueWidget?.title) }}</h2>
                <p v-html="rHtml(uniqueWidget?.text)" />
                <a
                  :href="getPropertiesLink()"
                  @click.prevent="openPropertiesPage()"
                  class="button button--effect"
                  >Start Exploring</a
                >
                <img src="/assets/images/arrow.png" alt="Go to" />
              </div>
            </div>
          </div>
          <img
            :src="res(uniqueWidget?.image)"
            alt="Explore the Market"
            class="d-none d-lg-block market__two__thumb" />
        </div>
        <div class="market__features">
          <div class="row">
            <div class="col-md-6 col-xl-4" style="height: 100%">
              <div
                v-if="tr(uniqueWidget?.title_0)"
                class="market__features__single shadow__effect__secondary">
                <img src="/assets/images/icons/gain.png" alt="Gain Instant" />
                <h4>{{ tr(uniqueWidget?.title_0) }}</h4>
                <p class="neutral-bottom" v-html="rHtml(uniqueWidget?.text_0)" />
              </div>
            </div>
            <div class="col-md-6 col-xl-4" style="height: 100%">
              <div
                v-if="tr(uniqueWidget?.title_1)"
                class="market__features__single market__features__single--alt shadow__effect">
                <img src="/assets/images/icons/noticed.png" alt="Get noticed" />
                <h4>{{ tr(uniqueWidget?.title_1) }}</h4>
                <p
                  class="neutral-bottom"
                  v-html="rHtml(uniqueWidget?.text_1)" />
              </div>
            </div>
            <div class="col-md-6 col-xl-4" style="height: 100%">
              <div
                v-if="tr(uniqueWidget?.title_2)"
                class="market__features__single alt shadow__effect__secondary">
                <img
                  src="/assets/images/icons/focus.png"
                  alt="Focus on Deals" />
                <h4>{{ tr(uniqueWidget?.title_2) }}</h4>
                <p
                  class="neutral-bottom"
                  v-html="rHtml(uniqueWidget?.text_2)" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
</template>
