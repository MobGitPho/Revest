<script setup>
  // section: AboutOverviewSection

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
    <section class="about__overview">
        <div class="video video--secondary">
            <div class="container">
                <div class="video__area">
                    <img src="/assets/images/about-video-illustration.png" alt="Video Illustration" />
                    <div class="video__btn">
                        <a class="video__popup" href="https://www.youtube.com/watch?v=LCihLrSehCo" target="_blank"
                            title="YouTube video player">
                            <i class="fa-solid fa-play"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="about__overview__area">
                <div class="section__header">
                    <h5 class="neutral-top">Investing in real estate is now easier than buying stocks</h5>
                    <h2>Make property Investing in simple,
                        accessible and transparent</h2>
                    <p class="neutral-bottom">Our mission is to empower the world to build wealth through modern real
                        estate investing.</p>
                </div>
                <div class="portfolio__overview">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="portfolio__overview__single column__space">
                                <img src="/assets/images/icons/investors.png" alt="Investors" />
                                <div>
                                    <h2 class="counterTwo">6738</h2>
                                    <p>Investors</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="portfolio__overview__single column__space">
                                <img src="/assets/images/icons/completed.png" alt="completed" />
                                <div>
                                    <h2 class="counterTwo">61316</h2>
                                    <p>Investments Completed</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="portfolio__overview__single">
                                <img src="/assets/images/icons/annual-return.png" alt="Average Annual Return" />
                                <div>
                                    <h2><span class="counterTwo">10.36</span>%</h2>
                                    <p>Average Annual Return</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>