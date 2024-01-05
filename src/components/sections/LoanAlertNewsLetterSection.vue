<script setup>
  // section: LoanAlertNewsLetterSection

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
    <section class="alert__newsletter alert__newsletter__alt">
        <div class="container">
            <div class="alert__newsletter__area">
                <div class="section__header">
                    <h5 class="neutral-top">Fill out an application</h5>
                    <h2>Grow Your
                        Business Faster!</h2>
                    <p class="neutral-bottom">Getting a business loan secured through collateral
                        is much easier and faster with Revest</p>
                </div>
                <form action="#" name="property__alert__from" method="post">
                    <div class="input input--secondary">
                        <label for="alertAltcom">Company Name*</label>
                        <input type="email" name="alertAlt__com" id="alertAltcom" placeholder="Enter Your Company"
                            required="required" />
                    </div>
                    <div class="input input--secondary">
                        <label for="alertAltRegistrationMail">Company Email*</label>
                        <input type="email" name="alertAlt__registration__email" id="alertAltRegistrationMail"
                            placeholder="Enter Your Email" required="required" />
                    </div>
                    <div class="input input--secondary input__alt">
                        <label for="alertAltNumber">Phone*</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select class="number__code__select" id="numberAltCodeSelectAlert">
                                    <option selected value="0">+1</option>
                                    <option value="1">+2</option>
                                    <option value="2">+3</option>
                                    <option value="3">+4</option>
                                    <option value="4">+5</option>
                                    <option value="5">+6</option>
                                </select>
                            </div>
                            <input type="number" name="alertAlt__number" id="alertAltNumber" required="required"
                                placeholder="345-323-1234" />
                        </div>
                    </div>
                    <div class="regi__type">
                        <label>Amount of money required (not less than 5000 €) **</label>
                        <select class="type__select" id="coutryAltSelect">
                            <option value="5">5000</option>
                            <option value="4">4000</option>
                            <option value="3">3000</option>
                            <option value="2">2000</option>
                            <option value="1">1000</option>
                        </select>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="condtion" name="accept__condition" value="agree" />
                            <span class="checkmark"></span>
                            I have read and I agree to the <a href="privacy-policy.html">
                                Privacy Policy</a>
                        </label>
                    </div>
                    <div class="input__button">
                        <button type="submit" class="button button--effect">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
  </section>
</template>