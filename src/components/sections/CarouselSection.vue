<script setup>
  // section: CarouselSection

  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res, rHtml } = useGlobal()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('carousel_section')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')
</script>

<template>
  <section>
    <!-- Put your section template code here -->
    <section class="hero pos__rel over__hi bg__img" :data-background="res(uniqueWidget?.imageback)">
        <div class="container">
            <div class="hero__area">
                <div class="row">
                    <div class="col-lg-6 col-xxl-5">
                        <div class="hero__content">
                            <h5 class="neutral-top" v-html="rHtml(uniqueWidget?.subtitle)" />
                            <h1 v-html="rHtml(uniqueWidget?.title)" />
                            <p class="primary neutral-bottom" v-html="rHtml(uniqueWidget?.text)" />
                            <div class="hero__cta__group">
                                <a href="properties.html" class="button button--effect">{{tr(uniqueWidget?.button_prop)}}</a>
                                <a href="business-loan.html" class="button button--secondary button--effect">
                                    {{tr(uniqueWidget?.button_loan)}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xxl-6 offset-xxl-1">
                        <div class="hero__illustration d-none d-lg-block">
                            <img :src="res(uniqueWidget?.imageillus)" alt="Hero Illustration" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>