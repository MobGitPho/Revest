<script setup>
  // section: KeyRiskFaqSection

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
    <section class="faq key-faq section__space">
        <div class="container">
            <div class="key-faq__area">
                <div class="section__header">
                    <h2 class="neutral-top">Key Risks</h2>
                    <p class="neutral-bottom">Investing in property can be rewarding but, as with any investment there
                        are risks.
                        The Info Packs and the Investment Terms and Conditions cover the risks specific to a particular
                        investment but it is also important that, before investing, you understand the following general
                        risks..</p>
                </div>
                <div class="faq__group">
                    <div class="accordion" id="accordionExampleFund">
                        <div class="accordion-item content__space">
                            <h5 class="accordion-header" id="headingFundOne">
                                <span class="icon_box">
                                    <img src="/assets/images/icons/message.png" alt="Fund" />
                                </span>
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFundOne" aria-expanded="true"
                                    aria-controls="collapseFundOne">
                                    What is Revest?
                                </button>
                            </h5>
                            <div id="collapseFundOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingFundOne" data-bs-parent="#accordionExampleFund">
                                <div class="accordion-body">
                                    <p>combined with a handful of model sentence structures, to generate Lorem Ipsum
                                        which looks reasonable. The generated Lorem Ipsum is therefore always free
                                        from
                                        repetition, injected humour, or</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item content__space">
                            <h5 class="accordion-header" id="headingFundTwo">
                                <span class="icon_box">
                                    <img src="/assets/images/icons/message.png" alt="Fund" />
                                </span>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFundTwo" aria-expanded="false"
                                    aria-controls="collapseFundTwo">
                                    What are the benefits of investing via Revest?
                                </button>
                            </h5>
                            <div id="collapseFundTwo" class="accordion-collapse collapse"
                                aria-labelledby="headingFundTwo" data-bs-parent="#accordionExampleFund">
                                <div class="accordion-body">
                                    <p>combined with a handful of model sentence structures, to generate Lorem Ipsum
                                        which looks reasonable. The generated Lorem Ipsum is therefore always free
                                        from
                                        repetition, injected humour, or</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item content__space">
                            <h5 class="accordion-header" id="headingFundThree">
                                <span class="icon_box">
                                    <img src="/assets/images/icons/message.png" alt="Fund" />
                                </span>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFundThree" aria-expanded="false"
                                    aria-controls="collapseFundThree">
                                    What makes Revest different?
                                </button>
                            </h5>
                            <div id="collapseFundThree" class="accordion-collapse collapse"
                                aria-labelledby="headingFundThree" data-bs-parent="#accordionExampleFund">
                                <div class="accordion-body">
                                    <p>combined with a handful of model sentence structures, to generate Lorem Ipsum
                                        which looks reasonable. The generated Lorem Ipsum is therefore always free
                                        from
                                        repetition, injected humour, or</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item content__space">
                            <h5 class="accordion-header" id="headingFundFour">
                                <span class="icon_box">
                                    <img src="/assets/images/icons/message.png" alt="Fund" />
                                </span>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFundFour" aria-expanded="false"
                                    aria-controls="collapseFundFour">
                                    What happens to my investments if Revest goes into bankruptcy?
                                </button>
                            </h5>
                            <div id="collapseFundFour" class="accordion-collapse collapse"
                                aria-labelledby="headingFundFour" data-bs-parent="#accordionExampleFund">
                                <div class="accordion-body">
                                    <p>combined with a handful of model sentence structures, to generate Lorem Ipsum
                                        which looks reasonable. The generated Lorem Ipsum is therefore always free
                                        from
                                        repetition, injected humour, or</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item content__space">
                            <h5 class="accordion-header" id="headingFundFive">
                                <span class="icon_box">
                                    <img src="/assets/images/icons/message.png" alt="Fund" />
                                </span>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFundFive" aria-expanded="false"
                                    aria-controls="collapseFundFive">
                                    What regulations apply to Revest?
                                </button>
                            </h5>
                            <div id="collapseFundFive" class="accordion-collapse collapse"
                                aria-labelledby="headingFundFive" data-bs-parent="#accordionExampleFund">
                                <div class="accordion-body">
                                    <p>combined with a handful of model sentence structures, to generate Lorem Ipsum
                                        which looks reasonable. The generated Lorem Ipsum is therefore always free
                                        from
                                        repetition, injected humour, or</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item content__space">
                            <h5 class="accordion-header" id="headingFundSix">
                                <span class="icon_box">
                                    <img src="/assets/images/icons/message.png" alt="Fund" />
                                </span>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFundSix" aria-expanded="false"
                                    aria-controls="collapseFundSix">
                                    How do I Fund investing in Revest?
                                </button>
                            </h5>
                            <div id="collapseFundSix" class="accordion-collapse collapse"
                                aria-labelledby="headingFundSix" data-bs-parent="#accordionExampleFund">
                                <div class="accordion-body">
                                    <p class="neutral-top neutral-bottom">combined with a handful of model sentence
                                        structures, to generate Lorem Ipsum
                                        which looks reasonable. The generated Lorem Ipsum is therefore always free
                                        from
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