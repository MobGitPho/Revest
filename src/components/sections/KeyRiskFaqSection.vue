<script setup>
  // section: KeyRiskFaqSection

  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res, rHtml } = useGlobal()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('wid_1')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('faq_risk_cle')

  const isId = ref('headingFundOne-0')

  const openFaq = (id) => {
    isId.value = id

    return isId
  }
</script>

<template>
  <section class="faq key-faq section__space">
    <div class="container">
      <div class="key-faq__area">
        <div class="section__header">
          <h2 class="neutral-top">{{t('Key Risks')}}</h2>
          <p class="neutral-bottom">
            Investing in property can be rewarding but, as with any investment
            there are risks. The Info Packs and the Investment Terms and
            Conditions cover the risks specific to a particular investment but
            it is also important that, before investing, you understand the
            following general risks..
          </p>
        </div>
        <div class="faq__group">
          <div class="accordion" id="accordionExampleFund">
            <template v-for="(a, i) in duplicableWidgets" :key="i">
              <div class="accordion-item content__space">
                <h5 class="accordion-header" :id="`headingFundOne-${i}`">
                  <span class="icon_box">
                    <img src="/assets/images/icons/message.png" alt="Fund" />
                  </span>
                  <button
                    :class="
                      isId == `headingFundOne-${i}`
                        ? 'accordion-button'
                        : 'accordion-button collapsed'
                    "
                    type="button"
                    data-bs-toggle="collapse"
                    :data-bs-target="`#collapseFundOne-${i}`"
                    :aria-expanded="
                      isId == `headingFundOne-${i}` ? 'true' : 'false'
                    "
                    aria-controls="collapseFundOne"
                    @click.prevent="openFaq(`headingFundOne-${i}`)">
                    {{tr(a?.title)}}
                  </button>
                </h5>
                <div
                  :id="`collapseFundOne-${i}`"
                  :class="
                    isId == `headingFundOne-${i}`
                      ? 'accordion-collapse collapse show'
                      : 'accordion-collapse collapse'
                  "
                  :aria-labelledby="`headingFundOne-${i}`"
                  data-bs-parent="#accordionExampleFund">
                  <div class="accordion-body">
                    <p v-html="rHtml(a?.text)"  />
                  </div>
                </div>
              </div>
            </template>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
