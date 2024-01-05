<script setup>
  // section: LoyalProgramSection

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
    <section>
    <!-- Put your section template code here -->
    <section class="program section__space">
        <div class="container">
            <div class="program__area wow fadeInUp">
                <div class="section__header">
                    <h2 class="neutral-top">Loyalty Program</h2>
                    <p class="neutral-bottom">Revest Loyalty Program aims to reward our most active and larger
                        investors, whilst at the same time encouraging investors to minimize risk by spreading their
                        investments into multiple investment opportunities.</p>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xl-3">
                        <div class="program__single shadow__effect">
                            <div class="box">
                                <h3><span class="counterFive">10</span>%</h3>
                            </div>
                            <h5>STARTER</h5>
                            <p class="neutral-bottom">10% discount when participating in 25 opportunities or at least
                                €25,000 invested.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="program__single shadow__effect">
                            <div class="box">
                                <h3><span class="counterFive">20</span>%</h3>
                            </div>
                            <h5>Premium</h5>
                            <p class="neutral-bottom">20% discount when participating in 25 opportunities or at least
                                €25,000 invested.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="program__single shadow__effect">
                            <div class="box">
                                <h3><span class="counterFive">30</span>%</h3>
                            </div>
                            <h5>Platinum</h5>
                            <p class="neutral-bottom">30% discount when participating in 25 opportunities or at least
                                €25,000 invested.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="program__single shadow__effect">
                            <div class="box">
                                <h3><span class="counterFive">40</span>%</h3>
                            </div>
                            <h5>Diamond</h5>
                            <p class="neutral-bottom">40% discount when participating in 25 opportunities or at least
                                €25,000 invested.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </section>
  </section>
</template>