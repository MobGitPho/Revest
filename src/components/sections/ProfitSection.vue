<script setup>
  // section: ProfitSection

  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res, rHtml } = useGlobal()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('profit_section')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('profit_section_item')
</script>

<template>
  <section v-if="uniqueWidget" class="profit section__space">
    <div class="container">
      <div class="profit__area wow fadeInUp">
        <div class="section__header">
          <h5 class="neutral-top" v-html="rHtml(uniqueWidget?.subtitle)" />
          <h2 v-html="rHtml(uniqueWidget?.title)" />
          <p class="neutral-bottom" v-html="rHtml(uniqueWidget?.text)" />
        </div>

        <template v-for="(li, index) in duplicableWidgets" :key="index">
          <div class="profit__item__wrapper">
            <div class="row">
              <div class="col-md-6">
                <div class="profit__single__item alt shadow__effect">
                  <div class="img__box">
                    <img
                      :src="res(li?.image_1)"
                      style="width: 120px; height: 120px; object-fit: cover"
                      alt="Passive Income" />
                  </div>
                  <div class="item__content">
                    <h4>{{ tr(li?.title_1) }}</h4>
                    <p>{{ tr(li?.subtitle_1) }}</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="profit__single__item shadow__effect">
                  <div class="img__box">
                    <img
                      :src="res(li?.image_2)"
                      style="width: 120px; height: 120px; object-fit: cover"
                      alt="secure" />
                  </div>
                  <div class="item__content">
                    <h4>{{ tr(li?.title_2) }}</h4>
                    <p>{{ tr(li?.subtitle_2) }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </template>
      </div>
    </div>
  </section>
</template>
