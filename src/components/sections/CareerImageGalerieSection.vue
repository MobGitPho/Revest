<script setup>
  // section: CareerImageGalerieSection
  import AboutImageGalerie from './AboutImageGallerieSection.vue'
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
    <section class="image__gallery image__gallery--two section__space">
        <div class="section__header wow fadeInUp">
            <h5 class="neutral-top">Join Our Team Today</h5>
            <h2>Join a Team of
                Passionate Tinkerers</h2>
            <p class="neutral-bottom">We wanna hear from you! Revest is a growing startup and we're always
                on the lookout for kindred spirits.</p>
        </div>
        <!--div class="image__gallery__area">
            <div class="gallery__single">
                <a href="assets/images/one.png">
                    <img src="assets/images/one.png" alt="Proect Image" />
                </a>
            </div>
            <div class="gallery__single">
                <a href="assets/images/two.png">
                    <img src="assets/images/two.png" alt="Proect Image" />
                </a>
            </div>
            <div class="gallery__single">
                <a href="assets/images/three.png">
                    <img src="assets/images/three.png" alt="Proect Image" />
                </a>
            </div>
            <div class="gallery__single">
                <a href="assets/images/one.png">
                    <img src="assets/images/one.png" alt="Proect Image" />
                </a>
            </div>
            <div class="gallery__single">
                <a href="assets/images/two.png">
                    <img src="assets/images/two.png" alt="Proect Image" />
                </a>
            </div>
            <div class="gallery__single">
                <a href="assets/images/three.png">
                    <img src="assets/images/three.png" alt="Proect Image" />
                </a>
            </div>
        </div-->
          <AboutImageGalerie />
        </section>
    </section>
</template>

<style scoped>
AboutImageGalerie {
    padding-bottom: 0px;
}
</style>