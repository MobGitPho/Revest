<script setup>
  // section: FooterSection

  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo, websiteOwnerInfo, websitePicsInfo } = useInfo()
  const { tr, res, rHtml } = useGlobal()
  const { sendEmail } = useMailing()
  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('footer_section')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')
    console.log("WEB", {websitePicsInfo});
  const formData = ref({
  email: '',
})
let load = ref(false)
const submit = async () => {
  load.value = true
  if (formData.value.email) {
    if (formData.value.email && !_v.isEmail(formData.value.email)) {
      console.log('Adresse mail invalid')
      load.value = false
      return false
    }

    console.log('Soyez patient')
    if (load.value) {
      afficherMessage("Message en cours d'envoie", 9000000)
    }
    const content = `
        <div>
          <b>Email</b> : ${formData.value.email} <br>
        </div>`

    const result = await sendEmail(
      formData.value.email,
      'News Letter',
      'Nouveau email',
      content,
      websiteInfo?.email
    )
        
    if (result) {
      console.log('Nous avons reçue votre message')
      formData.value = {
        email: '',
      }
      afficherMessage('Message envoyé', 5000)
    } else {
      console.log("Rencontre d'une erreur")
      load.value = false
      afficherMessage("Rencontre d'une erreur", 5000)
    }
  } else {
    console.log('Entrez votre email pour s\'abonner à la News Letter')
    load.value = false
    afficherMessage('Entrez Votre email', 5000)
  }
  load.value = false
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
  <section>
    <!-- Put your section template code here -->
    <footer class="footer pos__rel over__hi">
        <div class="container">
            <div class="footer__newsletter">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-6">
                        <div class="footer__newsletter__content column__space">
                            <h3>{{tr(uniqueWidget?.title_news_letter)}}</h3>
                            <p> {{tr(uniqueWidget?.text_news_letter)}} </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xxl-5 offset-xxl-1">
                        <div class="footer__newsletter__form">
                            <form action="#" method="post">
                                <div class="footer__newsletter__input__group">
                                    <div class="input">
                                        <input v-model="formData.email" type="email" name="news__letter" id="newsLetterMail"
                                            placeholder="Entrer Votre Email" required="required" />
                                    </div>
                                    <button  id="contact_btn" type="submit" class="button button--effect" @click.prevent="submit" >
                                        {{t('Subscribe')}} 
                                        <small></small>
                                    </button>
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
                            <a href="index.html">
                                <!--b-img :src="res(websitePicsInfo?.footerLogo)" alt="Revest" class="logo" /-->
                                <img src="/assets/images/logo-light.png" alt="Revest" class="logo" />
                            </a>
                            <p>{{tr(uniqueWidget?.text_logo)}}</p>
                            <div class="social">
                                <a href="javascript:void(0)">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-2 col-xl-2">
                        <div class="footer__links footer__links--alt">
                            <h5>Company</h5>
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
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-2 col-xl-2">
                        <div class="footer__links footer__links--alt">
                            <h5>Invest</h5>
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
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-2 col-xl-2">
                        <div class="footer__links footer__links--alt--two">
                            <h5>Insights</h5>
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
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-2 col-xl-2">
                        <div class="footer__links">
                            <h5>Legal</h5>
                            <ul>
                                <li>
                                    <a href="privacy-policy.html">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="terms-conditions.html">Term & Conditions</a>
                                </li>
                                <li>
                                    <a href="cookie-policy.html">Cookie Policy</a>
                                </li>
                                <li class="neutral-bottom">
                                    <a href="key-risks.html">Key Risks</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__credit">
                <div class="row d-flex align-items-center">
                    <div class="col-sm-9 order-1 order-sm-0">
                        <div class="footer__copyright">
                            <p>Copyright &copy; Revest | Designed by <a
                                    href="https://themeforest.net/user/pixelaxis">Pixelaxis</a></p>
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
            <img src="/assets/images/footer/footer__left__circle.png" alt="Circle" class="left__circle" />
            <img src="/assets/images/footer/footer__right__circle.png" alt="Circle" class="right__circle" />
            <img src="/assets/images/footer/footer__home___illustration.png" alt="Home" class="home__illustration" />
        </div>
    </footer>

    <a href="javascript:void(0)" class="scrollToTop">
        <i class="fa-solid fa-angles-up"></i>
    </a>

  </section>
</template>