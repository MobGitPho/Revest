<script setup>
  // section: ContactFormSection

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
    <section class="ask section__space bg__img" 
    :style="`background:url('/assets/images/ask-bge.png'); top`">
        <div class="container">
            <div class="ask__area">
                <div class="alert__newsletter__area">
                    <div class="section__header">
                        <h2 class="neutral-top">Ask a Question</h2>
                    </div>
                    <form action="#" name="ask__from" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input input--secondary">
                                    <label for="askFirstName">First Name*</label>
                                    <input type="text" name="ask__first__name" id="askFirstName"
                                        placeholder="Enter Your First Name" required="required" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input input--secondary">
                                    <label for="askLastName">Last Name*</label>
                                    <input type="text" name="ask__last__name" id="askLastName"
                                        placeholder="Enter Your Last Name" required="required" />
                                </div>
                            </div>
                        </div>
                        <div class="input input--secondary">
                            <label for="askRegistrationMail">Email*</label>
                            <input type="email" name="ask__registration__email" id="askRegistrationMail"
                                placeholder="Enter your email" required="required" />
                        </div>
                        <div class="input input--secondary input__alt">
                            <label for="askNumber">Phone*</label>
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
                                <input type="number" name="ask__number" id="askNumber" required="required"
                                    placeholder="345-323-1234" />
                            </div>
                        </div>
                        <div class="input input--secondary">
                            <label for="askSubject">Subject*</label>
                            <input type="text" name="ask__subject" id="askSubject" placeholder="Write Subject"
                                required="required" />
                        </div>
                        <div class="input input--secondary">
                            <label for="askMessage">Message*</label>
                            <textarea name="ask_message" id="askMessage" required="required"
                                placeholder="Write Message"></textarea>
                        </div>
                        <div class="input__button">
                            <button type="submit" class="button button--effect">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>
<style scoped>
.input__alt .input-group .nice-select .current::before {
  content: "";
  width: 30px;
  height: 16px;
  background-image: url("../images/flag.png");
  background-size: cover;
  margin-right: 10px;
  color: #434e9e80;
}
</style>