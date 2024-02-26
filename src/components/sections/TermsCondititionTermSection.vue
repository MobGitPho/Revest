<script setup>
  // section: TermsCondititionTermSection

  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res, rHtml } = useGlobal()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('cgu')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')
</script>

<template>
  <section>
    <!-- Put your section template code here -->
    <section class="terms section__space">
      <div class="container">
        <div class="terms-area">
          <div class="terms__single">
            <p  v-html="rHtml(uniqueWidget?.terms_conditions)"  />
          </div>
        </div>
      </div>
    </section>
  </section>
</template>
