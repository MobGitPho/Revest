<script setup>
  // section: AlertNewsLetterSection

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
    <section class="alert__newsletter section__space__bottom">
        <div class="container">
            <div class="alert__newsletter__area">
                <div class="section__header">
                    <h5 class="neutral-top">Property Alert</h5>
                    <h2>Never Miss <br />
                        A New Property!</h2>
                    <p class="neutral-bottom">Get the Revest Property Alert for a complete summary
                        of our new properties.</p>
                </div>
                <form action="#" name="property__alert__from" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input input--secondary">
                                <label for="alertFirstName">First Name*</label>
                                <input type="text" name="alert__first__name" id="alertFirstName"
                                    placeholder="Enter Your First Name" required="required" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input input--secondary">
                                <label for="alertLastName">Last Name*</label>
                                <input type="text" name="alert__last__name" id="alertLastName"
                                    placeholder="Enter Your Last Name" required="required" />
                            </div>
                        </div>
                    </div>
                    <div class="input input--secondary">
                        <label for="alertRegistrationMail">Email*</label>
                        <input type="email" name="alert__registration__email" id="alertRegistrationMail"
                            placeholder="Enter your email" required="required" />
                    </div>
                    <div class="input input--secondary input__alt">
                        <label for="alertNumber">Phone*</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select class="number__code__select" id="numberCodeSelectAlert">
                                    <option selected value="0">+1</option>
                                    <option value="1">+2</option>
                                    <option value="2">+3</option>
                                    <option value="3">+4</option>
                                    <option value="4">+5</option>
                                    <option value="5">+6</option>
                                </select>
                            </div>
                            <input type="number" name="alert__number" id="alertNumber" required="required"
                                placeholder="345-323-1234" />
                        </div>
                    </div>
                    <div class="regi__type">
                        <label>Location*</label>
                        <select class="type__select" id="coutrySelect">
                            <option value="particular">Desired Location</option>
                            <option value="particular">Australia</option>
                            <option value="individual">New Zeeland</option>
                            <option value="individual">Japan</option>
                            <option value="individual">China</option>
                        </select>
                    </div>
                    <div class="input__button">
                        <button type="submit" class="button button--effect">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
  </section>
</template>