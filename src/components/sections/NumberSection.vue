<script setup>
  // section: NumberSection
  import { NNumberAnimation } from 'naive-ui'
  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res, rHtml } = useGlobal()
  const { openPropertiesPage, getPropertiesLink } = useNews()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('number_section')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_1')

  function expYear(dtfa) {
    var d = new Date().getFullYear()
    var dtfb = new Date(dtfa).getFullYear()
    const resu = d - dtfb
    return resu
  }
</script>

<template>
  <!-- Put your section template code here data-background="/assets/images/globe.png" -->
  <section
    class="numbers section__space bg__img"
    style="`background:url('/assets/images/globe.png') ` ">
    <div class="container">
      <div class="numbers__area wow fadeInUp">
        <div class="row d-flex align-items-center">
          <div class="col-lg-6" v-if="uniqueWidget">
            <div class="content column__space">
              <h5 class="neutral-top" v-html="rHtml(uniqueWidget?.subtitle)" />
              <h2 v-html="rHtml(uniqueWidget?.title)" />
              <p v-html="rHtml(uniqueWidget?.text)" />
              <a
                :href="getPropertiesLink()"
                @click.prevent="openPropertiesPage()"
                class="button button--effect"
                >{{ t('Start Exploring') }}</a
              >
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row d-flex align-items-start align-items-lg-center">
              <div class="col-sm-6">
                <div v-if="uniqueWidget?.nbreinvest" class="numbers__single shadow__effect">
                  <img src="/assets/images/platforms.png" alt="platform" />
                  <h3>
                    <span class="counter">
                      <n-number-animation
                        duration="100000"
                        :from="0"
                        :to="uniqueWidget?.nbreinvest"
                        :active="true"
                        :precision="0" /> </span
                    >+
                  </h3>
                  <p class="neutral-bottom">
                    {{ t('Investors Using Platform') }}
                  </p>
                </div>
                <div v-if="uniqueWidget?.returnpercent" class="numbers__single shadow__effect__secondary">
                  <img src="/assets/images/returns.png" alt="Returns" />
                  <h3>
                    <span class="counter">
                      <n-number-animation
                        duration="100000"
                        :from="0"
                        :to="uniqueWidget?.returnpercent"
                        :active="true"
                        :precision="0" /></span
                    >%
                  </h3>
                  <p class="neutral-bottom">{{ t('Returns upto') }}</p>
                </div>
              </div>
              <div v-if="uniqueWidget?.expannee" class="col-sm-6">
                <div class="numbers__single alt shadow__effect__secondary">
                  <img src="/assets/images/experience.png" alt="Experience" />
                  <h3 class="counter">
                    <n-number-animation
                      duration="100000"
                      :from="0"
                      :to="expYear(uniqueWidget?.expannee)"
                      :active="true"
                      :precision="0" />
                  </h3>
                  <p class="neutral-bottom">{{ t('Years Experience') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
