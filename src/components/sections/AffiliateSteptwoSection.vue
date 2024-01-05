<script setup>
  // section: AffiliateSteptwoSection
  import VideoIllustration  from './VideoIllustrationSection.vue'
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
    <section 
    class="step__two section__space__top bg__img" 
    :style="`background:url('/assets/images/step-two-bg.png')`">
        <div class="container">
            <div class="step__two-area wow fadeInUp">
                <div class="section__header">
                    <h5 class="neutral-top">How the program Works</h5>
                    <h2>Start to make money in
                        3 easy steps</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="step__two__single shadow__effect">
                            <img src="/assets/images/icons/join.png" alt="Join" />
                            <h4>Join</h4>
                            <p class="neutral-bottom">It’s free to get started. Access marketing materials, tools, and
                                more!</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="step__two__single shadow__effect">
                            <img src="/assets/images/icons/promote.png" alt="Promote" />
                            <h4>Promote</h4>
                            <p class="neutral-bottom">Share with your target audience. There’s a match for every need
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="step__two__single shadow__effect">
                            <img src="/assets/images/icons/earn.png" alt="Earn" />
                            <h4>Earn</h4>
                            <p class="neutral-bottom">Rake in the moment your traffic converts. Check our commission
                                plans</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ==== video popup section start ==== -->
        <!--div class="video video__two section__space__top">
            <div class="container">
                <div class="video__area">
                    <img src="assets/images/video-illustration.png" alt="Video Illustration" />
                    <div class="video__btn">
                        <a class="video__popup" href="https://www.youtube.com/watch?v=LCihLrSehCo" target="_blank"
                            title="YouTube video player">
                            <i class="fa-solid fa-play"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div-->
        
        <VideoIllustration />
        <!-- ==== #video popup section end ==== -->
    </section>
  </section>
</template>