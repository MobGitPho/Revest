<script setup>
  // section: LoginPageSection
  import LoginHeaderSection from './LoginHeaderSection.vue'
  import LoginRegistrationSection from './LoginRegistrationSection.vue'

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
    <div class="wrapper bg__img" 
    :style="`background:url('/assets/images/registration-bg.png');top ; left`">
      <LoginHeaderSection />
      <loginRegistrationSection />
      
    </div>
  


  </section>
</template>