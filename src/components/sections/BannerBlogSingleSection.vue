<script setup>
// section: BannerBlogSingleSection

const { t } = useI18n()

const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
const { websiteInfo } = useInfo()
const { tr, res } = useGlobal()

// Get unique widget
const uniqueWidget = getUniqueWidgetData('wid_1')

// Get duplicable widgets
const duplicableWidgets = getDuplicableWidgetsData('wid_2')
</script>

<template>
  <section>
    <!-- Put your section template code here -->
    <div 
      class="blog__single__banner clear__top bg__img"
      :style="`background:url('/assets/images/banner/blog-single-banner.png')`">
    </div>
  </section>
</template>