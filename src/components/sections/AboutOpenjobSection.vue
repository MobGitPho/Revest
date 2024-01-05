<script setup>
  // section: AboutOpenjobSection

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
    <section class="open__job section__space">
        <div class="container">
            <div class="open__job__area">
                <h2 class="neutral-top">Join Us</h2>
                <div class="job__single">
                    <div class="open__job__inner">
                        <img src="/assets/images/icons/sales.png" alt="Sales" />
                        <div class="open__job__info">
                            <h5><a href="career-details.html">Director of Sales</a></h5>
                            <ul>
                                <li>Sales</li>
                                <li>Remote</li>
                                <li>Full Time</li>
                            </ul>
                        </div>
                    </div>
                    <a href="career-details.html" class="arrw">
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                </div>
                <div class="job__single">
                    <div class="open__job__inner">
                        <img src="/assets/images/icons/marketing.png" alt="Product Marketing Lead" />
                        <div class="open__job__info">
                            <h5><a href="career-details.html">Product Marketing Lead</a></h5>
                            <ul>
                                <li>Marketing</li>
                                <li>Remote</li>
                                <li>Full Time</li>
                            </ul>
                        </div>
                    </div>
                    <a href="career-details.html" class="arrw">
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                </div>
                <div class="job__single">
                    <div class="open__job__inner">
                        <img src="/assets/images/icons/business.png" alt="Business Development Representative" />
                        <div class="open__job__info">
                            <h5><a href="career-details.html">Business Development Representative</a></h5>
                            <ul>
                                <li>Business</li>
                                <li>Remote</li>
                                <li>Full Time</li>
                            </ul>
                        </div>
                    </div>
                    <a href="career-details.html" class="arrw">
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                </div>
                <div class="job__single">
                    <div class="open__job__inner">
                        <img src="/assets/images/icons/development.png" alt="Business Development Representative" />
                        <div class="open__job__info">
                            <h5><a href="career-details.html">Business Development Representative</a></h5>
                            <ul>
                                <li>Business</li>
                                <li>Remote</li>
                                <li>Full Time</li>
                            </ul>
                        </div>
                    </div>
                    <a href="career-details.html" class="arrw">
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                </div>
            </div>
            <div class="cta__btn">
                <a href="career.html" class="button button--effect">See all open roles <i
                        class="fa-solid fa-arrow-right-long"></i></a>
            </div>
        </div>
    </section>
  </section>
</template>