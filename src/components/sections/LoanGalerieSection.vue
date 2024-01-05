<script setup>
  // section: LoanGalerieSection

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
    <section class="p__gallery wow fadeInUp" id="gallery">
        <div class="container">
            <hr class="divider" />
            <div class="p__gallery__area section__space">
                <div class="title__with__cta">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-8">
                            <h2>Property Gallery</h2>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-start text-lg-end">
                                <a href="contact-us.html" class="button button--secondary button--effect">Request
                                    info</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row p__gallery__single">
                    <div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href="/assets/images/gallery/one.png">
                            <img src="/assets/images/gallery/one.png" alt="Property Image" />
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href="/assets/images/gallery/two.png">
                            <img src="/assets/images/gallery/two.png" alt="Property Image" />
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href="/assets/images/gallery/three.png">
                            <img src="/assets/images/gallery/three.png" alt="Property Image" />
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href=":assets/images/gallery/four.png">
                            <img src="/assets/images/gallery/four.png" alt="Property Image" />
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href="/assets/images/gallery/five.png">
                            <img src="/assets/images/gallery/five.png" alt="Property Image" />
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href="/assets/images/gallery/six.png">
                            <img src="/assets/images/gallery/six.png" alt="Property Image" />
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href="/assets/images/gallery/seven.png">
                            <img src="/assets/images/gallery/seven.png" alt="Property Image" />
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href="/assets/images/gallery/eight.png">
                            <img src="/assets/images/gallery/eight.png" alt="Property Image" />
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href="/assets/images/gallery/nine.png">
                            <img src="/assets/images/gallery/nine.png" alt="Property Image" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>