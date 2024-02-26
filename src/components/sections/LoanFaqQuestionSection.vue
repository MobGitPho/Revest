<script setup>
  // section: LoanFaqQuestionSection

  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res, rHtml } = useGlobal()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('wid_1')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('faq_question_item')

  const isId = ref('headingQuestionsOne-0')

  const openFaq = (id) => {
    isId.value = id

    return isId
  }
</script> 

<template>
  <section class="faq section__space">
    <div class="container">
      <div class="faq__area">
        <div class="section__header">
          <h2 class="neutral-top">{{ t('Frequently Asked Questions') }}</h2>
        </div>
        <div class="faq__group">
          <div class="accordion" id="accordionExampleQuestions">
            <template v-for="(fa, i) in duplicableWidgets" :key="i">
              <div class="accordion-item content__space">
                <h5 class="accordion-header" :id="`headingQuestionsOne-${i}`">
                  <span class="icon_box">
                    <img
                      src="/assets/images/icons/message.png"
                      alt="Questions" />
                  </span>
                  <button
                    :class="
                      isId == `headingQuestionsOne-${i}`
                        ? 'accordion-button'
                        : 'accordion-button collapsed'
                    "
                    type="button"
                    data-bs-toggle="collapse"
                    :data-bs-target="`#collapseQuestionsOne-${i}`"
                    :aria-expanded="
                      isId == `headingQuestionsOne-${i}` ? 'true' : 'false'
                    "
                    aria-controls="collapseQuestionsOne"
                    @click.prevent="openFaq(`headingQuestionsOne-${i}`)">
                    {{ tr(fa?.title) }}
                  </button>
                </h5>
                <div
                  :id="`collapseQuestionsOne-${i}`"
                  :class="
                    isId == `headingQuestionsOne-${i}`
                      ? 'accordion-collapse collapse show'
                      : 'accordion-collapse collapse'
                  "
                  :aria-labelledby="`headingQuestionsOne-${i}`"
                  data-bs-parent="#accordionExampleQuestions">
                  <div class="accordion-body">
                    <p v-html="rHtml(fa?.text)" />
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
