<script setup>
  // section: AffiliateMarketSection

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
    <section class="market market__two section__space over__hi">
        <div class="container">
            <div class="market__area">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-6 col-xl-5">
                        <div class="market__thumb thumb__rtl column__space d-none d-lg-block">
                            <img src="/assets/images/affiliate-illustration.png" alt="Affiliate Program" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 offset-xl-1">
                        <div class="content">
                            <h5 class="neutral-top">Earn Money</h5>
                            <h2>Affiliate Program</h2>
                            <p>Earn commission from every revest new user you help to bring.Join our affiliate program,
                                refer your audience, and earn revenue.</p>
                            <a href="registration.html" class="button button--effect">Join As a Affiliate</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>