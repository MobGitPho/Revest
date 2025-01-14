<script setup>
  // section: FooterSection
  import { MenuLocations } from '@/utils/enums'
  const { t } = useI18n()
  const { RegisterEmailStatus, registerEmail } = useNewsletter()
  const { currentMenuItem, open, currentParentMenuItems } = useMenu()
  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo, websiteOwnerInfo, websitePicsInfo, websiteMoreInfo } =
    useInfo()
  const { tr, res, rHtml } = useGlobal()
  const { sendEmail } = useMailing()
  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('footer_section')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')
  const email = ref()
  const message = ref({})

  const submit = async () => {
    const res = await registerEmail(email.value)
    if (res === RegisterEmailStatus.SUCCESS) {
      message.value.msg = t('emailSave')
      message.value.status = 'success'
      email.value = ''
    }
    if (res === RegisterEmailStatus.FAILED) {
      message.value.msg = t('We encountered an error')
      message.value.status = 'failed'
    }
    if (res === RegisterEmailStatus.EXIST) {
      message.value.msg = t('emailExist')
      message.value.status = 'exist'
    }
    if (res === RegisterEmailStatus.ABORTED) {
      message.value.msg = t('fillField')
      message.value.status = 'aborted'
    }
    afficherMessage(message.value?.msg, 5000)
  }

  function afficherMessage(message, duree) {
    const button = document.getElementById('contact_btn')
    const small = button.querySelector('small')

    small.innerHTML = message

    setTimeout(function () {
      small.innerHTML = ''
    }, duree)
  }

</script>

<template>
  <footer class="footer pos__rel over__hi">
    <div class="container">
      <div class="footer__newsletter">
        <div class="row d-flex align-items-center">
          <div class="col-lg-6">
            <div class="footer__newsletter__content column__space">
              <h3>{{ tr(uniqueWidget?.title_news_letter) }}</h3>
              <p>{{ tr(uniqueWidget?.text_news_letter) }}</p>
            </div>
          </div>
          <div class="col-lg-6 col-xxl-5 offset-xxl-1">
            <div class="footer__newsletter__form">
              <form action="#" method="post">
                <div class="footer__newsletter__input__group">
                  <div class="input">
                    <input
                      v-model="email"
                      type="email"
                      name="news__letter"
                      id="newsLetterMail"
                      :placeholder="t('Entrer Votre Email')"
                      required="required" />
                  </div>
                  <button
                    type="submit"
                    class="button button--effect"
                    @click.prevent="submit">
                    {{ tr(uniqueWidget?.btn_title) }}
                  </button>
                </div>
                <div id="contact_btn" style="margin-top: 5px">
                  <small style="color: #fff"></small>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="footer__area section__space">
        <div class="row">
          <div class="col-md-12 col-lg-4 col-xl-4">
            <div class="footer__intro">
              <a href="/">
                <!--b-img /assets/images/logo-light.png  :src="res(websitePicsInfo?.footerLogo)" alt="Revest" class="logo" /-->
                <img
                  :src="res(websitePicsInfo?.footerLogo)"
                  style="width: 131px; height: 40px; object-fit: cover"
                  alt="Revest"
                  class="logo" />
              </a>
              <p v-html="rHtml(uniqueWidget?.text_logo)"   />
              <div class="social">
                <a :href="websiteMoreInfo?.facebook">
                  <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a :href="websiteMoreInfo?.twitter">
                  <i class="fa-brands fa-twitter"></i>
                </a>
                <a :href="websiteMoreInfo?.instagram">
                  <i class="fa-brands fa-instagram"></i>
                </a>
                <a :href="websiteMoreInfo?.linkedin">
                  <i class="fa-brands fa-linkedin-in"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-2 col-xl-2">
            <div class="footer__links footer__links--alt">
              <!--h5>Company</h5>
                            <ul>
                                <li>
                                    <a href="about-us.html">About Us</a>
                                </li>
                                <li>
                                    <a href="career.html">Careers</a>
                                </li>
                                <li>
                                    <a href="blog.html">Blog</a>
                                </li>
                                <li>
                                    <a href="contact-us.html">Contact Us</a>
                                </li>
                                <li class="neutral-bottom">
                                    <a href="affiliate-program.html">Affiliate</a>
                                </li>
                            </ul-->
            </div>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-2 col-xl-2">
            <div class="footer__links footer__links--alt">
              <!--h5>Invest</h5>
                            <ul>
                                <li>
                                    <a href="properties.html">Browse Properties</a>
                                </li>
                                <li>
                                    <a href="how-it-works.html">How it works</a>
                                </li>
                                <li>
                                    <a href="loan-application.html">Loan Application </a>
                                </li>
                                <li>
                                    <a href="property-alert.html">Property Alerts</a>
                                </li>
                                <li class="neutral-bottom">
                                    <a href="support.html">FAQs</a>
                                </li>
                            </ul-->
            </div>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-2 col-xl-2">
            <div class="footer__links footer__links--alt--two">
              <!--h5>Insights</h5>
                            <ul>
                                <li>
                                    <a href="support.html">Help Center</a>
                                </li>
                                <li>
                                    <a href="list-your-property.html">List Your Property</a>
                                </li>
                                <li class="neutral-bottom">
                                    <a href="loyality-program.html">Loyality program </a>
                                </li>
                            </ul-->
            </div>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-2 col-xl-2">
            <div class="footer__links">
              <h5>{{ t('Legal') }}</h5>
              <ul>
                <template
                  v-for="(parentMenuItem, i) in currentParentMenuItems(
                    MenuLocations.FOOTER
                  )"
                  :key="i">
                  <li @click.prevent="open(parentMenuItem)">
                    <a href=""> {{ tr(parentMenuItem.name) }}</a>
                  </li>
                </template>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="footer__credit">
        <div class="row d-flex align-items-center">
          <div class="col-sm-9 order-1 order-sm-0">
            <div class="footer__copyright">
              <p v-html="rHtml(uniqueWidget?.copyright)"   />
            </div>
          </div>
          <div class="col-sm-3">
            <div class="footer__language">
              <select class="language-select">
                <option value="english">En</option>
                <option value="australia">Aus</option>
                <option value="brazil">Bra</option>
                <option value="argentina">Arg</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer__animation">
      <img
        src="/assets/images/footer/footer__left__circle.png"
        alt="Circle"
        class="left__circle" />
      <img
        src="/assets/images/footer/footer__right__circle.png"
        alt="Circle"
        class="right__circle" />
      <img
        src="/assets/images/footer/footer__home___illustration.png"
        alt="Home"
        class="home__illustration" />
    </div>
  </footer>

  <a href="javascript:void(0)" class="scrollToTop">
    <i class="fa-solid fa-angles-up"></i>
  </a>
</template>
