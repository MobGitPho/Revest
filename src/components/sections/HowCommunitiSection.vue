<script setup>
// section: HowCommunitiSection

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
  <!-- Put your section template code here -->
  <section 
    class="community section__space__top over__hi bg__img"
    :style="`background:url('/assets/images/community-bg.png');top ; left`">
    <div class="container">
      <div class="community__area">
        <div class="section__header">
          <h5 class="neutral-top">Smart way to raise money</h5>
          <h2>Join Thousands of
            Investors</h2>
          <p class="neutral-bottom">Individual and institutional investors invest $10–$100,000
            per deal on Revest.</p>
        </div>
        <div class="comunity-wrapper section__space">
          <div class="buttons">
            <a href="registration.html" class="button button--effect">Become an Investor</a>
          </div>
          <div class="comunity-area">
            <div class="comunity-item"><img src="/assets/images/community/1.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/2.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/3.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/4.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/5.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/6.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/7.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/8.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/9.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/10.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/11.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/12.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/13.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/14.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/15.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/16.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/17.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/18.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/19.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/22.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/20.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/21.png" alt="comunity"></div>
          </div>
          <div class="comunity-area two">
            <div class="comunity-item"><img src="/assets/images/community/1.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/2.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/3.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/4.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/5.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/6.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/7.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/8.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/9.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/10.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/11.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/12.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/13.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/14.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/15.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/16.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/17.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/18.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/19.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/22.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/20.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/21.png" alt="comunity"></div>
          </div>
          <div class="comunity-area three">
            <div class="comunity-item"><img src="/assets/images/community/1.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/2.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/3.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/4.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/5.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/6.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/7.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/8.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/9.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/10.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/11.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/12.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/13.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/14.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/15.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/16.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/17.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/18.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/19.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/22.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/20.png" alt="comunity"></div>
            <div class="comunity-item"><img src="/assets/images/community/21.png" alt="comunity"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>