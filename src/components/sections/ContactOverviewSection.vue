<script setup>
  // section: ContactOverviewSection

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
    <section class="contact__overview">
        <div class="container">
            <div class="contact__overview__area">
                <div class="row">
                    <div class="col-md-6 col-xl-4">
                        <div class="contact__overview__single column__space--secondary shadow__effect">
                            <img src="/assets/images/icons/email.png" alt="email" />
                            <h5>Send Us an Email</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing.</p>
                            <hr />
                            <p class="neutral-bottom">
                                <a href="https://pixner.net/cdn-cgi/l/email-protection#610419000c110d04210419000c110d044f020e0c"><span class="__cf_email__" data-cfemail="34575b5a40555740744651425147401a575b59">[email&#160;protected]</span></a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="contact__overview__single column__space--secondary shadow__effect">
                            <img src="/assets/images/icons/phone.png" alt="Call" />
                            <h5>Give Us a Call</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing.</p>
                            <hr />
                            <p class="neutral-bottom">
                                <a href="tel:+17087362094">(414) 807 - 7478</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="contact__overview__single shadow__effect">
                            <img src="/assets/images/icons/chat.png" alt="Chat" />
                            <h5>Chat with us</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing.</p>
                            <hr />
                            <p class="neutral-bottom">
                                <a href="#0">Open live chat</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>