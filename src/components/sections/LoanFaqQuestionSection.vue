<script setup>
  // section: LoanFaqQuestionSection

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
    <section class="faq section__space">
        <div class="container">
            <div class="faq__area">
                <div class="section__header">
                    <h2 class="neutral-top">Frequently Asked
                        Questions</h2>
                </div>
                <div class="faq__group">
                    <div class="accordion" id="accordionExampleQuestions">
                        <div class="accordion-item content__space">
                            <h5 class="accordion-header" id="headingQuestionsOne">
                                <span class="icon_box">
                                    <img src="/assets/images/icons/message.png" alt="Questions" />
                                </span>
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseQuestionsOne" aria-expanded="true"
                                    aria-controls="collapseQuestionsOne">
                                    Who may apply for investment ?
                                </button>
                            </h5>
                            <div id="collapseQuestionsOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingQuestionsOne" data-bs-parent="#accordionExampleQuestions">
                                <div class="accordion-body">
                                    <p>combined with a handful of model sentence structures, to generate Lorem Ipsum
                                        which looks reasonable. The generated Lorem Ipsum is therefore always free from
                                        repetition, injected humour, or</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item content__space">
                            <h5 class="accordion-header" id="headingQuestionsTwo">
                                <span class="icon_box">
                                    <img src="/assets/images/icons/message.png" alt="Questions" />
                                </span>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseQuestionsTwo" aria-expanded="false"
                                    aria-controls="collapseQuestionsTwo">
                                    How long does it take to collect the amount necessary for my project?
                                </button>
                            </h5>
                            <div id="collapseQuestionsTwo" class="accordion-collapse collapse"
                                aria-labelledby="headingQuestionsTwo" data-bs-parent="#accordionExampleQuestions">
                                <div class="accordion-body">
                                    <p>combined with a handful of model sentence structures, to generate Lorem Ipsum
                                        which looks reasonable. The generated Lorem Ipsum is therefore always free from
                                        repetition, injected humour, or</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item content__space">
                            <h5 class="accordion-header" id="headingQuestionsThree">
                                <span class="icon_box">
                                    <img src="/assets/images/icons/message.png" alt="Questions" />
                                </span>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseQuestionsThree" aria-expanded="false"
                                    aria-controls="collapseQuestionsThree">
                                    What will happen if the full amount required for the project
                                    is not collected?
                                </button>
                            </h5>
                            <div id="collapseQuestionsThree" class="accordion-collapse collapse"
                                aria-labelledby="headingQuestionsThree" data-bs-parent="#accordionExampleQuestions">
                                <div class="accordion-body">
                                    <p>combined with a handful of model sentence structures, to generate Lorem Ipsum
                                        which looks reasonable. The generated Lorem Ipsum is therefore always free from
                                        repetition, injected humour, or</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item content__space">
                            <h5 class="accordion-header" id="headingQuestionsFour">
                                <span class="icon_box">
                                    <img src="/assets/images/icons/message.png" alt="Questions" />
                                </span>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseQuestionsFour" aria-expanded="false"
                                    aria-controls="collapseQuestionsFour">
                                    Is it possible to change the term of the project, the schedule of
                                    repayment of the received investments?
                                </button>
                            </h5>
                            <div id="collapseQuestionsFour" class="accordion-collapse collapse"
                                aria-labelledby="headingQuestionsFour" data-bs-parent="#accordionExampleQuestions">
                                <div class="accordion-body">
                                    <p>combined with a handful of model sentence structures, to generate Lorem Ipsum
                                        which looks reasonable. The generated Lorem Ipsum is therefore always free from
                                        repetition, injected humour, or</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item content__space">
                            <h5 class="accordion-header" id="headingQuestionsFive">
                                <span class="icon_box">
                                    <img src="/assets/images/icons/message.png" alt="Questions" />
                                </span>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseQuestionsFive" aria-expanded="false"
                                    aria-controls="collapseQuestionsFive">
                                    Do I need to present any documents on the use of the collected
                                    investments?
                                </button>
                            </h5>
                            <div id="collapseQuestionsFive" class="accordion-collapse collapse"
                                aria-labelledby="headingQuestionsFive" data-bs-parent="#accordionExampleQuestions">
                                <div class="accordion-body">
                                    <p>combined with a handful of model sentence structures, to generate Lorem Ipsum
                                        which looks reasonable. The generated Lorem Ipsum is therefore always free from
                                        repetition, injected humour, or</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item content__space">
                            <h5 class="accordion-header" id="headingQuestionsSix">
                                <span class="icon_box">
                                    <img src="/assets/images/icons/message.png" alt="Questions" />
                                </span>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseQuestionsSix" aria-expanded="false"
                                    aria-controls="collapseQuestionsSix">
                                    What should I do if the project is unsuccessful and I am unable to
                                    repay the sum borrowed?
                                </button>
                            </h5>
                            <div id="collapseQuestionsSix" class="accordion-collapse collapse"
                                aria-labelledby="headingQuestionsSix" data-bs-parent="#accordionExampleQuestions">
                                <div class="accordion-body">
                                    <p class="neutral-top neutral-bottom">combined with a handful of model sentence
                                        structures, to generate Lorem Ipsum
                                        which looks reasonable. The generated Lorem Ipsum is therefore always free from
                                        repetition, injected humour, or</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>