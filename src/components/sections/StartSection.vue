<script setup>
  // section: StartSection
  import VideoIllustrationSection from './VideoIllustrationSection.vue'
  import StartSpaceSection from './StartSpaceSection.vue'
  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res, rHtml } = useGlobal()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('start_section')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('start_section_item')

  function limitText(text, maxLength) {
  if (text.length <= maxLength) {
    return text
  } else {
    const trimmedText = text.substring(0, maxLength - 3) + '...'
    return trimmedText
  }
}


</script>
<!--   data-background="/assets/images/step/start-bg.png" -->
<template>
  <section v-if="duplicableWidgets"
    class="start section__space__top bg__img"
    style="`background:url('/assets/images/step/start-bg.png') ` ">
    <div class="container">
      <div class="start__area wow fadeInUp">
        <div class="section__header">
          <h5 class="neutral-top" v-html="rHtml(uniqueWidget?.subtitle)" />
          <h2 v-html="rHtml(uniqueWidget?.title)" />
          <p class="neutral-bottom" v-html="rHtml(uniqueWidget?.text)" />
        </div>
        <div class="row">
          <template v-for="(st, index) in duplicableWidgets" :key="index">
            <div class="col-md-6 col-xl-4">
              <div class="start__single__item column__space--secondary">
                <div class="img__box">
                  <img :src="res(st?.image)" alt="Browse Properties" />
                  <div class="step__count">
                    <h4>0{{ index + 1 }}</h4>
                  </div>
                </div>
                <h4>{{ tr(st?.title) }}</h4>
                <p class="neutral-bottom" v-html="limitText(rHtml(st?.subtitle), 95)" />
              </div>
            </div>
          </template>
        </div>
      </div>
    </div>
  </section>
  <div v-if="(uniqueWidget?.linkvideo)" class="video">
        <div class="container">
            <div class="video__area">
                <img :src="res(uniqueWidget?.video)" style="width:;height:;object-fit: fill;" alt="Video Illustration" />
                <div class="video__btn">
                    <a class="video__popup" :href="uniqueWidget?.linkvideo" target="_blank"
                        title="video">
                        <i class="fa-solid fa-play"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.start {
    padding-bottom: 260px;
    background-color: #f4f6ff;
}
</style>
