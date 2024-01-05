<script setup>
  // section: CareerOpenJobSection

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
    <section class="open__tab__position section__space__bottom">
        <div class="container">
            <h2 class="neutral-top">Open Positions</h2>
            <div class="d-flex justify-content-center">
                <div class="open__tab">
                    <a href="javascript:void(0)" class="button button--effect open__tab__btn" data-target='all'>All</a>
                    <a href="javascript:void(0)" class="button button--effect open__tab__btn"
                        data-target='sales'>Sales</a>
                    <a href="javascript:void(0)" class="button button--effect open__tab__btn"
                        data-target='marketing'>Marketing</a>
                    <a href="javascript:void(0)" class="button button--effect open__tab__btn"
                        data-target='engineering'>Engineering</a>
                    <a href="javascript:void(0)" class="button button--effect open__tab__btn"
                        data-target='design'>Design</a>
                </div>
            </div>
            <div class="open__position__tab__wrapper">
                <div class="job__single open__job__single" data-groups='["all","sales"]'>
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
                <div class="job__single open__job__single" data-groups='["all","engineering"]'>
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
                <div class="job__single open__job__single" data-groups='["all","design"]'>
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
                <div class="job__single open__job__single" data-groups='["all","marketing"]'>
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
                <div class="job__single open__job__single" data-groups='["all","design"]'>
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
                <div class="job__single open__job__single" data-groups='["all","sales"]'>
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
                <div class="job__single open__job__single" data-groups='["all","engineering"]'>
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
                <div class="job__single open__job__single" data-groups='["all","marketing"]'>
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
            </div>
        </div>
    </section>
  </section>
</template>