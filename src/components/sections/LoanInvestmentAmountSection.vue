<script setup>
  // section: LoanInvestmentAmountSection

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
    <section class="investment__amount section__space__top bg__img" data-background="/assets/images/gd-bg.png">
        <div class="container">
            <div class="investment__amount__area">
                <div class="investment__wrapper">
                    <div class="investment__wrapper__inner">
                        <h5>Investment Amount (100 €-30991€)</h5>
                        <div class="input input--secondary">
                            <input type="number" name="invest__amount" id="investAmount" placeholder="5000"
                                required="required" />
                        </div>
                        <div class="radio__group">
                            <div>
                                <input type=radio id="pone" checked class="radio-input" name="radio-group">
                                <label for="pone" class="radio-label"> <span class="radio-border"></span> 13% </label>
                            </div>
                            <div>
                                <input type=radio id="ptwo" checked class="radio-input" name="radio-group">
                                <label for="ptwo" class="radio-label"> <span class="radio-border"></span> 13.25%
                                </label>
                            </div>
                            <div>
                                <input type=radio id="pthree" checked class="radio-input" name="radio-group">
                                <label for="pthree" class="radio-label"> <span class="radio-border"></span> 13.5%
                                </label>
                            </div>
                            <div>
                                <input type=radio id="pfour" checked class="radio-input" name="radio-group">
                                <label for="pfour" class="radio-label"> <span class="radio-border"></span> 14% </label>
                            </div>
                        </div>
                    </div>
                    <div class="investment__footer">
                        <div>
                            <p class="secondary">I will earn ( 01 Month )</p>
                            <h4 class="neutral-bottom">O.72 <i class="fa-solid fa-euro-sign"></i></h4>
                        </div>
                        <div>
                            <p class="secondary">I will earn ( 12 Month )</p>
                            <h4 class="neutral-bottom">11.72 <i class="fa-solid fa-euro-sign"></i></h4>
                        </div>
                        <div>
                            <p class="secondary">I will earn ( 24 Month )</p>
                            <h4 class="neutral-bottom">17.72 <i class="fa-solid fa-euro-sign"></i></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="investment__inner__area section__space__top wow fadeInUp">
                <div class="section__header">
                    <h5 class="neutral-top">Revest Statistic</h5>
                    <h2>Numbers Said
                        More Than Words</h2>
                    <p class="neutral-bottom">Businesses have been able to easily and quickly raise funds for the
                        implementation of real estate projects, business start-ups or its development.</p>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xl-3">
                        <div class="invest__single">
                            <h4 class="neutral-top "><span class="counterThree">23875805</span> <i
                                    class="fa-solid fa-euro-sign"></i></h4>
                            <p class="neutral-bottom">Money lent</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="invest__single">
                            <h4 class="neutral-top"><span class="counterThree">74660 </span><i
                                    class="fa-solid fa-euro-sign"></i></h4>
                            <p class="neutral-bottom">Average loan size</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="invest__single">
                            <h4 class="neutral-top counterThree">327</h4>
                            <p class="neutral-bottom">Funded Loans</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="invest__single">
                            <h4 class="neutral-top"><span class="counterThree">12</span> Mo.</h4>
                            <p class="neutral-bottom">Average Loan Term</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  </section>
</template>