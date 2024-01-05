<script setup>
// section: BannerHowSection
import VideoIllustrationSection from './VideoIllustrationSection.vue';
import BannerLoanApplicationSection from './BannerLoanApplicationSection.vue';
import HowOverviewSection from './HowOverviewSection.vue'
const { t } = useI18n()

const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
const { websiteInfo } = useInfo()
const { tr, res } = useGlobal()

// Get unique widget
const uniqueWidget = getUniqueWidgetData('wid_1')

// Get duplicable widgets
const duplicableWidgets = getDuplicableWidgetsData('wid_2')
</script>

<template>   <!-- Put your section template code here -->
  <!--section class="banner banner-three clear__top bg__img" 
    :style="`background:url('/assets/images/banner/banner-three-bg.png')`">
      <div class="container">
        <div class="banner__area">
          <h1 class="neutral-top">How It Works</h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.html">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Pages
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                How It Works
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </section-->
  <BannerLoanApplicationSection />

  <HowOverviewSection />
</template>