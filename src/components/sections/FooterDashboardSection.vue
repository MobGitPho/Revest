<script setup>
  // section: FooterDashboardSection
  import { MenuLocations } from '@/utils/enums'
  const { t } = useI18n()
  const { currentMenuItem, open, currentParentMenuItems } = useMenu()
  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo, websitePicsInfo, websiteOwnerInfo, websiteMoreInfo } =
    useInfo()
  const {
    openContactPage,
    getContactLink,
    openAboutPage,
    getAboutLink,
    openPropertiesPage,
    getPropertiesLink,
  } = useNews()
  const { tr, res } = useGlobal()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('wid_1')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')
</script>

<template>
  <section>
    <footer class="footer dashboard-footer pos__rel over__hi">
      <div class="container">
        <div class="footer__area section__space">
          <div class="row">
            <div class="col-md-12 col-lg-4 col-xl-4">
              <div class="footer__intro">
                <a href="index.html">
                  <img
                    :src="res(websitePicsInfo?.mainLogo)"
                    style="width: 131px; height: 40px; object-fit: cover"
                    alt="Revest"
                    class="logo" />
                </a>
                <p>
                  <i class="fa-solid fa-location-dot"></i>
                  {{ websiteOwnerInfo?.address }}
                </p>
                <p>
                  <i class="fa-solid fa-phone"></i>{{ websiteOwnerInfo?.phone }}
                </p>
                <p>
                  <i class="fa-solid fa-envelope"></i
                  ><a
                    href="https://pixner.net/cdn-cgi/l/email-protection"
                    class="__cf_email__"
                    data-cfemail="98ebede8e8f7eaecd8eafdeefdebecb6fbf7f5"
                    >{{ websiteOwnerInfo?.email }}</a
                  >
                </p>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-2 col-xl-2">
              <div class="footer__links footer__links--alt">
                <h5>Company</h5>
                <ul>
                  <li>
                    <a :href="getAboutLink()" @click.prevent="openAboutPage()"
                      >About Us</a
                    >
                  </li>
                  <li>
                    <a
                      :href="getContactLink()"
                      @click.prevent="openContactPage()"
                      >Contact Us</a
                    >
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
                  <template
                    v-for="(parentMenuItem, i) in currentParentMenuItems(
                      MenuLocations.FOOTER
                    )"
                    :key="i">
                    <li @click.prevent="open(parentMenuItem)">
                      <a href="" class="neutral-bottom">
                        {{ tr(parentMenuItem.name) }}</a
                      >
                    </li>
                  </template>

                  <!--li>
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
                  </li-->
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="footer__credit">
          <div class="row d-flex align-items-center">
            <div class="col-md-8">
              <div class="footer__copyright">
                <p>
                  Copyright &copy; Revest | Designed by
                  <a href="https://themeforest.net/user/pixelaxis">Pixelaxis</a>
                </p>
              </div>
            </div>
            <div class="col-md-4">
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
        </div>
      </div>
    </footer>
  </section>
</template>
