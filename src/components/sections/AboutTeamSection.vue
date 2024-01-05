<script setup>
  // section: AboutTeamSection
    import TeamSection from './TeamSection.vue';
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
    <section class="team section__space__bottom">
        <div class="container">
            <div class="team__area wow fadeInUp">
                <div class="section__header">
                    <h5 class="neutral-top">Meet Our Incredible Team</h5>
                    <h2>Built by a Diverse Team With Deep
                        Expertise in Investing</h2>
                    <p class="neutral-bottom">We're on a mission to build a better financial system by empowering the
                        individual.</p>
                </div>
                <TeamSection />
            </div>
        </div>
    </section>
  </section>
</template>