<script setup>
  // section: MarketSmallSection

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
    <section class="market market--two market--three section__space__bottom">
        <div class="container">
            <div class="market__area market__area--two section__space bg__img"
                data-background="('/assets/images/light-two.png')"
                >
                <div class="row d-flex align-items-center">
                    <div class="col-lg-6">
                        <div class="content">
                            <h5 class="neutral-top">Real exposure to the real estate market</h5>
                            <h2>You Invest. Revest
                                Does the Rest</h2>
                            <p>Transparent Real Estate Investing Through Revest.Join us and
                                experience a smarter,better way to invest in real estate</p>
                            <a href="properties.html" class="button button--effect">Start Exploring</a>
                            <img src="/assets/images/arrow.png" alt="Go to" />
                        </div>
                    </div>
                </div>
                <img src="/assets/images/market-two-illustration.png" alt="Explore the Market"
                    class="d-none d-lg-block market__two__thumb" />
            </div>
            <div class="market__features">
                <div class="row">
                    <div class="col-md-6 col-xl-4">
                        <div class="market__features__single shadow__effect__secondary">
                            <img src="/assets/images/icons/gain.png" alt="Gain Instant" />
                            <h4>Gain Instant</h4>
                            <p class="neutral-bottom">Revest performs deep due diligence on sponsors, giving investors
                                peace of mind.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="market__features__single market__features__single--alt shadow__effect">
                            <img src="/assets/images/icons/noticed.png" alt="Get noticed" />
                            <h4>Get Noticed</h4>
                            <p class="neutral-bottom">REVEST VERIFIED sponsor profiles are available to accredited real
                                estate investment
                                investors.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="market__features__single alt shadow__effect__secondary">
                            <img src="/assets/images/icons/focus.png" alt="Focus on Deals" />
                            <h4>Focus on Deals</h4>
                            <p class="neutral-bottom">Spend less time smiling, reaserching and dialing and more time
                                doing what you love.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
  </section>
</template>