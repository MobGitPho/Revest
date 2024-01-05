<script setup>
  // section: ListPropertieNumberSection

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
    <section class="numbers numbers__two section__space__bottom">
        <div class="container">
            <div class="numbers__area wow fadeInUp">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-6">
                        <div class="content column__space">
                            <h5 class="neutral-top">Your success is our success.</h5>
                            <h2>Why sell through
                                Revest?</h2>
                            <p>Revest enables real estate owners to sell their properties through its platform. Submit
                                your property quickly and easily!</p>

                            <p><a href="contact-us.html">Let us know about your property</a></p>
                            <a href="login.html" class="button button--effect">Submit Your Property</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row d-flex align-items-start align-items-lg-center">
                            <div class="col-sm-6">
                                <div class="numbers__single shadow__effect">
                                    <img src="/assets/images/icons/attractive.png" alt="Attractive" />
                                    <h5>Attractive conditions</h5>
                                    <p class="neutral-bottom">With us you sell your property without paying a brokerage
                                        commission.</p>
                                </div>
                                <div class="numbers__single shadow__effect">
                                    <img src="/assets/images/icons/fast.png" alt="Fast" />
                                    <h5>Fast processing</h5>
                                    <p class="neutral-bottom">Receive an initial offer and a property assessment within
                                        48 hours.</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="numbers__single alt shadow__effect">
                                    <img src="/assets/images/icons/innovation.png" alt="Innovation" />
                                    <h5>Innovation</h5>
                                    <p class="neutral-bottom">Sell your property online through an innovative business
                                        model.</p>
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