<script setup>
// section: PropertiesPageDetailSection
import { useRoute, useRouter } from 'vue-router';
import { NImageGroup, NSpace, NImage, NPagination } from 'naive-ui';
const { t } = useI18n()
const router = useRouter()
const route = useRoute()
const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
const { websiteInfo } = useInfo()
const { tr, res, rHtml } = useGlobal()
const article = ref(null)
var projectInfo = ref(null)
const images = ref([])
const galId = ref()
const page = ref(1)
const galToShow = ref(route.hash.split('?'))
var when_invest = ref()
var reasons = ref()
var galImg = ref()
const dbNewsArticleStore = useDbNewsArticleStore()
const { fetchArticleBySlug } = useNews()
// Get unique widget

const uniqueWidget = getUniqueWidgetData('banner_application')

// Get duplicable widgets
const duplicableWidgets = getDuplicableWidgetsData('properties_section_item')
const faqQest = getDuplicableWidgetsData('faq_question_item')
const projInfo = getDuplicableWidgetsData('project_detail')
const locat = getDuplicableWidgetsData('property_filter_location_section')
const typLo = getDuplicableWidgetsData('property_filter_type_section')

console.log("ART",{article})
function sameProp(ville){
  var sam = duplicableWidgets.filter((a)=> a?.ville == ville )
  return sam
}

function apLocation(id) {
  const loca = locat.find((loc) => loc._id === id)
  return loca?.location;
}
function typLocation(id) {
  const loca = typLo.find((loc) => loc._id === id)
  return loca?.typ;
}
function faqExp(nb) {
  var resu = 'false';
  if (nb === 0) {
    resu = 'true'
  } else {
    resu = 'false'
  }
  return resu
}
const init = async () => {
  if (!route.params.slug) router.push('/')
  else {
    if (
      dbNewsArticleStore.article &&
      dbNewsArticleStore.article.slug == route.params.slug
    ) {
      article.value = dbNewsArticleStore.article
      
    } else article.value = await fetchArticleBySlug(route.params.slug)

    if (!article.value) router.push('/')
  }
}
const openArticlePageDetail = (article) => {
    if (article) {
        dbNewsArticleStore.article = article
        router.push(`/propertiesdetails/${article.slug}`)
    }
}
const openArticlePage = (article) => {
  if (article) {
    dbNewsArticleStore.article = article

    router.push(`/media/${article.slug}`)
  }
}

const img = computed({
  get: images.value,

  set: (galleryTitle) => {
    // Vérifier si "duplicableWidgets" est défini et n'est pas vide
    if (Array.isArray(duplicableWidgets) && duplicableWidgets.length > 0) {
      if (galleryTitle === '*') {
        // Filtrer les duplicableWidgets qui ont une propriété "images" valide et concaténer les images
        images.value = duplicableWidgets
          .filter((galerie) => galerie?.gallerie)
          .reduce((acc, galerie) => {
            try {
              return acc.concat(JSON.parse(galerie.gallerie))
            } catch (error) {
              console.log(error) // Afficher toute erreur de parsing JSON
              return acc // Ignorer les images invalides
            }
          }, [])
      } else {
        // Chercher la galerie correspondant au titre fourni dans "duplicableWidgets"
        const galerie = duplicableWidgets.find(
          (g) => g?.slug == galleryTitle
        )
        // Si une galerie est trouvée et qu'elle a des images valides
        if (galerie && galerie?.gallerie) {
          try {
            // Essayer de convertir les images au format JSON et les définir dans "images.value"
            images.value = JSON.parse(galerie.gallerie)
          } catch (error) {
            console.log(error) // Afficher toute erreur de parsing JSON
          }
        }
      }
    }

    // Définir "page.value" à 1
    page.value = 1
    // Définir "galId.value" (peut-être l'identifiant de la galerie) avec le titre de galerie fourni
    galId.value = galleryTitle
  },
})

// Fonction pour charger l'image
function loadImage() {
  let imageToLoad = '*'
  if (galToShow.value.length > 1 && galToShow.value[0] === '#gallery') {
    imageToLoad = galToShow.value[1]
  }
  img.value = imageToLoad
}

watch(
  () => route.hash,
  async (newHash) => {
    galToShow.value = newHash.split('?')
    if (galToShow.value[0] === '#gallery') {
      loadImage()
    }
  }
)

onMounted(() => {
  loadImage()
})

function paginateArrayG(array, pageSize, pageNumber) {
  const startIndexG = (pageNumber - 1) * pageSize
  const endIndexG = startIndexG + pageSize
  return array.slice(startIndexG, endIndexG)
}
function paginateArrayP(array, pageSize, pageNumber) {
  const startIndexP = (pageNumber - 1) * pageSize
  const endIndexP = startIndexP + pageSize
  return array.slice(startIndexP, endIndexP)
}
function gallerie(gale){
  galImg = JSON.parse(gale)
  return galImg
}
function proj(nb) {
  if (nb != "") {
    projectInfo.value = projInfo.find((a) => a?._id == nb)
     reasons = ref(JSON.parse(projectInfo.value.reasons))
     when_invest = ref(JSON.parse(projectInfo.value.when_invest))
    
    console.log({reasons: reasons.value, invest: when_invest.value})
    return projectInfo
  } else {
    router.push('/propertiespage')
  }
}



init()


</script>

<template>
  <section>
    <!-- Put your section template code here  data-background="/assets/images/banner/property-details-banner.png"-->
    <div 
      class="property__details__banner bg__img clear__top"
        :style="`background: url('${res(uniqueWidget?.properties_detail_image)}') no-repeat fixed left top;`">
    </div>
    <section class="p__details faq section__space__bottom">
      <div class="container">
        <div class="p__details__area">
          <div class="row">
            <div class="col-lg-7">
              <div class="p__details__content">
                <a href="#gallery" class="button button--effect button--secondary"><i class="fa-solid fa-images"></i>
                  {{ t('Browse Gallery') }}</a>
                <div class="intro">
                  <h3>{{ apLocation(article?.ville) }}</h3>
                  <p><i class="fa-solid fa-location-dot"></i> {{ article?.localisation }}
                  </p>
                </div>
                <div v-if="proj(article?.project)" class="group__one">
                  <h4>Project Description</h4>
                  <p v-html="rHtml(projectInfo?.pro_description)" />
                </div>
                <div v-if="reasons != undefined" class="group__two">
                  <h5>Reasons to invest in the project {{ tr(projectInfo?.name) }}:</h5>
                  <ul>

                    <li v-for="(rs,index) in reasons" :key="index"><img src="/assets/images/check.png" alt="Check" />
                     {{tr(rs)}}
                    </li>

                  </ul>
                </div>
                <div class="terms">
                  <h5>Financial terms of the investment:</h5>
                  <div class="terms__wrapper">
                    <div class="terms__single">
                      <img src="/assets/images/icons/loan.png" alt="Maximum Loan" />
                      <p>Maximum loan term</p>
                      <h5 class="neutral-bottom">{{ article?.maxterm }} Months</h5>
                    </div>
                    <div class="terms__single">
                      <img src="/assets/images/icons/charge.png" alt="Charge" />
                      <p>Security</p>
                      <h5 class="neutral-bottom">{{ article?.security }}</h5>
                    </div>
                    <div class="terms__single">
                      <img src="/assets/images/icons/project.png" alt="Annual" />
                      <p>Annual Return</p>
                      <h5 class="neutral-bottom">{{ article?.return }}</h5>
                    </div>
                  </div>
                </div>
                <div v-if="when_invest != undefined" class="group__two">
                  <h5>When investing:</h5>
                  <ul>
                    <li v-for="(wh, index) in when_invest" :key="index"><img src="/assets/images/check.png" alt="Check" /> 
                      {{ tr(wh) }}
                    </li>

                  </ul>
                </div>
                <div class="terms">
                  <h5>The capital growth distribution:</h5>
                  <div class="terms__wrapper">
                    <div class="terms__single">
                      <img src="/assets/images/icons/investor.png" alt="Maximum Loan" />
                      <p>Investors</p>
                      <h5 class="neutral-bottom">{{ projectInfo?.pro_investor }}</h5>
                    </div>
                    <div class="terms__single">
                      <img src="/assets/images/icons/project.png" alt="Charge" />
                      <p>Project</p>
                      <h5 class="neutral-bottom">{{ projectInfo?.pro_percent }}%</h5>
                    </div>
                    <div class="terms__single">
                      <img src="/assets/images/icons/revest.png" alt="Annual" />
                      <p>Revest</p>
                      <h5 class="neutral-bottom">{{ article?.percent }}%</h5>
                    </div>
                  </div>
                </div>
                <div class="owner">
                  <img src="/assets/images/owner.png" alt="Owner" />
                  <div>
                    <h5>{{ projectInfo?.pro_execute }}</h5>
                    <p v-html="rHtml(projectInfo?.pro_execute_description)" />
                  </div>
                </div>
                <div class="faq__group">
                  <h5 class="atr">Frequently asked questions</h5>
                  <div class="accordion" id="accordionExampleFund">
                    <template v-for="(fq, index) in faqQest?.slice(0, 3)" :key="index">
                      <div class="accordion-item content__space">
                        <h5 :id="`headingFundOne-${index}`" class="accordion-header">
                          <span class="icon_box">
                            <img src="/assets/images/icons/message.png" alt="Fund" />
                          </span>
                          <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            :data-bs-target="`#collapseFundOne-${index}`" :aria-expanded="faqExp(index)"
                            :aria-controls="`collapseFundOne-${index}`">
                            {{ tr(fq?.title) }}
                          </button>
                        </h5>
                        <div :id="`collapseFundOne-${index}`" class="accordion-collapse collapse show"
                          :aria-labelledby="`headingFundOne-${index}`" data-bs-parent="#accordionExampleFund">
                          <div class="accordion-body">
                            <p v-html="rHtml(fq?.text)" />
                          </div>
                        </div>
                      </div>
                    </template>
                  </div>
                </div>
                <div class="group__one">
                  <h4>Key investment risks:</h4>
                  <p>Risk of falling prices: The price of the property might fall due to the increase in
                    supply or decrease in demand in the area or other economic factors.Liquidity risk:
                    The borrower might be unable to find a buyer in order to sell the property.Tenant
                    risk: There is a risk that the asset can lose a tenant and it can take time to find
                    replacements, which can have impact on the property's cash-flow.</p>
                  <div class="map__wrapper">
                    <iframe
                      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20342.411046372905!2d-74.16638039276373!3d40.719832743885284!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1649562691355!5m2!1sen!2sbd"
                      width="746" height="312" style="border:0;" allowfullscreen="" loading="lazy"
                      referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="p__details__sidebar">
                <div class="intro">
                  <div class="countdown__wrapper">
                    <p class="secondary"><i class="fa-solid fa-clock"></i> Left to invest
                    </p>
                    <div class="countdown">
                      <h5>
                        <span class="days">00</span><span class="ref">d</span>
                        <span class="seperator">:</span>
                      </h5>
                      <h5>
                        <span class="hours"> 00</span><span class="ref">h</span>
                        <span class="seperator">:</span>
                      </h5>
                      <h5>
                        <span class="minutes">00</span><span class="ref">m</span>
                        <span class="seperator"></span>
                      </h5>
                    </div>
                  </div>
                  <h5>Available for funding: <span>€134 514</span></h5>
                  <div class="progress__type progress__type--two">
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                    <div class="project__info">
                      <p class="project__has"><span class="project__has__investors">159
                          Investors</span> | <span class="project__has__investors__amount"><i
                            class="fa-solid fa-dollar-sign"></i> 1,94,196</span></p>
                      <p class="project__goal">
                        <i class="fa-solid fa-dollar-sign"></i> 3,00,000 Goal
                      </p>
                    </div>
                  </div>
                </div>
                <div class="group brin">
                  <h5 class="neutral-top">Occupancy</h5>
                  <div class="acus__btns">
                    <a href="javascript:void(0)" class="acus__btn acus__btn__active">0%</a>
                    <a href="javascript:void(0)" class="acus__btn">20%</a>
                    <a href="javascript:void(0)" class="acus__btn">40%</a>
                    <a href="javascript:void(0)" class="acus__btn">60%</a>
                    <a href="javascript:void(0)" class="acus__btn">80%</a>
                    <a href="javascript:void(0)" class="acus__btn">100%</a>
                  </div>
                  <div class="acus__content">
                    <form action="#" method="post">
                      <div class="input input--secondary">
                        <label for="anNum">Annual return rate:</label>
                        <input type="number" name="an__num" id="anNum" placeholder="7.00%" required="required" />
                      </div>
                      <div class="input input--secondary">
                        <label for="anNumIn">Invest</label>
                        <input type="number" name="an__num_in" id="anNumIn" placeholder="€ 500" required="required" />
                      </div>
                      <div class="input input--secondary">
                        <label for="anNumInTwo">Earn</label>
                        <input type="number" name="an__num_in_two" id="anNumInTwo" placeholder="€ 35.00"
                          required="required" />
                      </div>
                      <div class="capital">
                        <p>Capital Growth Split:</p>
                        <h5>40% <a href="blog.html"><i class="fa-solid fa-circle-info"></i></a>
                        </h5>
                      </div>
                      <div class="item__security">
                        <div class="icon__box">
                          <img src="/assets/images/home.png" alt="Security" />
                        </div>
                        <div class="item__security__content">
                          <p class="secondary">Security</p>
                          <h6>{{article?.security}}</h6>
                        </div>
                      </div>
                      <div class="suby">
                        <h5>500</h5>
                        <button type="submit" class="button button--effect">Invest Now</button>
                      </div>
                    </form>
                  </div>
                  <p class="text-center neutral-bottom">
                    <a href="contact-us.html">Request a free callback</a>
                  </p>
                </div>
                <div class="group brini">
                  <h5 class="neutral-top">Investment Overview</h5>
                  <hr />
                  <p>Purpose of the loan To increase the company's working capital, magna a laoreet
                    convallis, massa sapien tempor arcu, nec euismod elit justo in lacus. Maecenas
                    mattis massa lectus, vel tincidunt augue porta non.</p>
                  <p>Duis quis orci vehicula, fermentum tortor vitae, imperdiet sem. Quisque iaculis eu
                    odio in lobortis. Sed vel ex non erat pellentesque lobortis vel vitae diam. Donec
                    gravida eleifend pellentesque. Curabitur dictum blandit accumsan.</p>
                  <a href="blog.html">Read More</a>
                </div>
                <div class="group birinit">
                  <h6>Share via Social </h6>
                  <div class="social text-start">
                    <a href="javascript:void(0)">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="javascript:void(0)">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="javascript:void(0)">
                      <i class="fab fa-instagram"></i>
                    </a>
                    <a href="javascript:void(0)">
                      <i class="fab fa-linkedin-in"></i>
                    </a>
                  </div>
                </div>
                <div class="group alt__brin">
                  <h5>Key Updates <i class="fa-solid fa-bell"></i></h5>
                  <hr />
                  <div class="singl__wrapper">
                    <div class="singl">
                      <img src="/assets/images/check.png" alt="Check" />
                      <div>
                        <p>30-Aug-2022</p>
                        <a href="terms-conditions.html">Term Sheet Signed</a>
                      </div>
                    </div>
                    <div class="singl">
                      <img src="/assets/images/check.png" alt="Check" />
                      <div>
                        <p>30-Aug-2022</p>
                        <a href="privacy-policy.html">Listing Live</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="group alt__brin__last">
                  <h5>Reports</h5>
                  <hr />
                  <h6>Investment Note</h6>
                  <p>Property Share's Detailed Investment Note</p>
                  <a href="javascript:void(0)" class="button">DOWNLOAD INVESTMENT NOTE <i
                      class="fa-solid fa-download"></i></a>
                  <h6>Legal Title Report</h6>
                  <p>Detailed Report on the Title diligence of the
                    property by Amarchand Mangaldas</p>
                  <a href="javascript:void(0)" class="button">DOWNLOAD TITLE REPORT <i
                      class="fa-solid fa-download"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="gallery" class="p__gallery wow fadeInUp" >
      <div class="container">
        <hr class="divider" />
        <div class="p__gallery__area section__space">
          <div class="title__with__cta">
            <div class="row d-flex align-items-center">
              <div class="col-lg-8">
                <h2>Property Gallery</h2>
              </div>
              <div class="col-lg-4">
                <div class="text-start text-lg-end">
                  <a href="contact-us.html" class="button button--secondary button--effect">Request
                    info</a>
                </div>
              </div>
            </div>
          </div>
          <div v-if="article?.gallerie" class="row p__gallery__single">
            <!--template v-for="(ga, index) in  paginateArray(article?.gallerie, 6, page) " :key="index">
              <div class="col-md-6 col-lg-4 gallery__single__two">
                <a href="#">
                  <img :src="res(ga)" alt="Property Image" />
                </a>
              </div>
            </template-->
            <n-image-group>
              <n-space justify="center">
                <n-image v-for="(image, imageKey) in paginateArrayG(gallerie(article?.gallerie), 6, page)" :key="imageKey" width="300"
                  border-radius="5%" lazy :src="res(image)" />
              </n-space>
              <n-space justify="center" style="margin-top: 2rem">
                <n-pagination v-model:page="page" :page-count="Math.ceil(gallerie(article?.gallerie).length / 6)" />
              </n-space>
            </n-image-group>
            <!--div class="col-md-6 col-lg-4 gallery__single__two">
              <a href="assets/images/gallery/two.png">
                <img src="assets/images/gallery/two.png" alt="Property Image" />
              </a>
            </div>
            <div class="col-md-6 col-lg-4 gallery__single__two">
              <a href="assets/images/gallery/three.png">
                <img src="assets/images/gallery/three.png" alt="Property Image" />
              </a>
            </div>
            <div class="col-md-6 col-lg-4 gallery__single__two">
              <a href="assets/images/gallery/four.png">
                <img src="assets/images/gallery/four.png" alt="Property Image" />
              </a>
            </div>
            <div class="col-md-6 col-lg-4 gallery__single__two">
              <a href="assets/images/gallery/five.png">
                <img src="assets/images/gallery/five.png" alt="Property Image" />
              </a>
            </div>
            <div class="col-md-6 col-lg-4 gallery__single__two">
              <a href="assets/images/gallery/six.png">
                <img src="assets/images/gallery/six.png" alt="Property Image" />
              </a>
            </div>
            <div class="col-md-6 col-lg-4 gallery__single__two">
              <a href="assets/images/gallery/seven.png">
                <img src="assets/images/gallery/seven.png" alt="Property Image" />
              </a>
            </div>
            <div class="col-md-6 col-lg-4 gallery__single__two">
              <a href="assets/images/gallery/eight.png">
                <img src="assets/images/gallery/eight.png" alt="Property Image" />
              </a>
            </div>
            <div class="col-md-6 col-lg-4 gallery__single__two">
              <a href="assets/images/gallery/nine.png">
                <img src="assets/images/gallery/nine.png" alt="Property Image" />
              </a>
            </div-->
          </div>

        </div>
      </div>
    </section>
    <section class="properties__grid section__space">
      <div class="container">
        <div class="properties__grid__area wow fadeInUp">
          <div class="title__with__cta">
            <div class="row d-flex align-items-center">
              <div class="col-lg-8">
                <h2>Browse Similar Properties</h2>
              </div>
              <div class="col-lg-4">
                <div class="text-start text-lg-end">
                  <a href="properties.html" class="button button--secondary button--effect">Browse All
                    Properties</a>
                </div>
              </div>
            </div>
          </div>
          <div class="property__grid__wrapper">
            <!--div class="row">
              <div class="col-md-6 col-xl-4">
                <div class="property__grid__single column__space--secondary">
                  <div class="img__effect">
                    <a href="property-details.html">
                      <img src="assets/images/property/grid-one.jpg" alt="Property" />
                    </a>
                  </div>
                  <div class="property__grid__single__inner">
                    <h4>Los Angeles</h4>
                    <p class="sub__info"><i class="fa-solid fa-location-dot"></i> 8706 Herrick Ave, Los
                      Angeles</p>
                    <div class="progress__type">
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                          aria-valuemax="100"></div>
                      </div>
                      <p class="project__has"><span class="project__has__investors">159
                          Investors</span> |
                        <span class="project__has__investors__amount"><i class="fa-solid fa-dollar-sign"></i>
                          1,94,196</span> <span class="project__has__investors__percent">(64.73%)</span>
                      </p>
                    </div>
                    <div class="item__info">
                      <div class="item__info__single">
                        <p>Annual Return</p>
                        <h6>7.5% + 2%</h6>
                      </div>
                      <div class="item__info__single">
                        <p>Property Type</p>
                        <h6>Commercial</h6>
                      </div>
                    </div>
                    <div class="invest__cta__wrapper">
                      <div class="countdown__wrapper">
                        <p class="secondary"><i class="fa-solid fa-clock"></i> Left to invest</p>
                        <div class="countdown">
                          <h5>
                            <span class="days">00</span><span class="ref">d</span>
                            <span class="seperator">:</span>
                          </h5>
                          <h5>
                            <span class="hours"> 00</span><span class="ref">h</span>
                            <span class="seperator">:</span>
                          </h5>
                          <h5>
                            <span class="minutes">00</span><span class="ref">m</span>
                            <span class="seperator"></span>
                          </h5>
                        </div>
                      </div>
                      <div class="invest__cta">
                        <a href="property-details.html" class="button button--effect">
                          Invest Now
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="property__grid__single column__space--secondary">
                  <div class="img__effect">
                    <a href="property-details.html">
                      <img src="assets/images/property/grid-two.jpg" alt="Property" />
                    </a>
                  </div>
                  <div class="property__grid__single__inner">
                    <h4>San Francisco, CA</h4>
                    <p class="sub__info"><i class="fa-solid fa-location-dot"></i> 3335 21 St, San
                      Francisco</p>
                    <div class="progress__type">
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                          aria-valuemax="100"></div>
                      </div>
                      <p class="project__has"><span class="project__has__investors">159
                          Investors</span> |
                        <span class="project__has__investors__amount"><i class="fa-solid fa-dollar-sign"></i>
                          1,94,196</span> <span class="project__has__investors__percent">(64.73%)</span>
                      </p>
                    </div>
                    <div class="item__info">
                      <div class="item__info__single">
                        <p>Annual Return</p>
                        <h6>7.5% + 2%</h6>
                      </div>
                      <div class="item__info__single">
                        <p>Property Type</p>
                        <h6>Commercial</h6>
                      </div>
                    </div>
                    <div class="invest__cta__wrapper">
                      <div class="countdown__wrapper">
                        <p class="secondary"><i class="fa-solid fa-clock"></i> Left to invest</p>
                        <div class="countdown">
                          <h5>
                            <span class="days">00</span><span class="ref">d</span>
                            <span class="seperator">:</span>
                          </h5>
                          <h5>
                            <span class="hours"> 00</span><span class="ref">h</span>
                            <span class="seperator">:</span>
                          </h5>
                          <h5>
                            <span class="minutes">00</span><span class="ref">m</span>
                            <span class="seperator"></span>
                          </h5>
                        </div>
                      </div>
                      <div class="invest__cta">
                        <a href="property-details.html" class="button button--effect">
                          Invest Now
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="property__grid__single">
                  <div class="img__effect">
                    <a href="property-details.html">
                      <img src="assets/images/property/grid-three.jpg" alt="Property" />
                    </a>
                  </div>
                  <div class="property__grid__single__inner">
                    <h4>San Diego</h4>
                    <p class="sub__info"><i class="fa-solid fa-location-dot"></i> 356 La Jolla, San
                      Diego</p>
                    <div class="progress__type">
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                          aria-valuemax="100"></div>
                      </div>
                      <p class="project__has"><span class="project__has__investors">159
                          Investors</span> |
                        <span class="project__has__investors__amount"><i class="fa-solid fa-dollar-sign"></i>
                          1,94,196</span> <span class="project__has__investors__percent">(64.73%)</span>
                      </p>
                    </div>
                    <div class="item__info">
                      <div class="item__info__single">
                        <p>Annual Return</p>
                        <h6>7.5% + 2%</h6>
                      </div>
                      <div class="item__info__single">
                        <p>Property Type</p>
                        <h6>Commercial</h6>
                      </div>
                    </div>
                    <div class="invest__cta__wrapper">
                      <div class="countdown__wrapper">
                        <p class="secondary"><i class="fa-solid fa-clock"></i> Left to invest</p>
                        <div class="countdown">
                          <h5>
                            <span class="days">00</span><span class="ref">d</span>
                            <span class="seperator">:</span>
                          </h5>
                          <h5>
                            <span class="hours"> 00</span><span class="ref">h</span>
                            <span class="seperator">:</span>
                          </h5>
                          <h5>
                            <span class="minutes">00</span><span class="ref">m</span>
                            <span class="seperator"></span>
                          </h5>
                        </div>
                      </div>
                      <div class="invest__cta">
                        <a href="property-details.html" class="button button--effect">
                          Invest Now
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div-->
            <div class="row">
              <template v-for="(al, index) in paginateArrayP(sameProp(article?.ville), 3, page).reverse() " :key="index">

                <div class=" col-lg-4 col-xl-4 ">
                  <div class="property__grid__single">
                    <div class="img__effect">
                      <a href="#" @click.prevent="openArticlePageDetail(al)">
                        <img :src="res(al?.image)" alt="Property" />
                      </a>
                    </div>
                    <div class="property__grid__single__inner">
                      <h4>{{ apLocation(al?.ville) }}</h4>
                      <p class="sub__info"><i class="fa-solid fa-location-dot"></i>
                        {{ al?.localisation }}s</p>
                      <div class="progress__type">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                            aria-valuemax="100"></div>
                        </div>

                        <p class="project__has"><span class="project__has__investors">{{
                          al?.nbinvest }}
                            Investors</span> |
                          <span class="project__has__investors__amount"><i class="fa-solid fa-dollar-sign"></i> {{
                            al?.price
                          }}</span>
                          <span class="project__has__investors__percent">({{ al?.percent
                          }}%)</span>
                        </p>
                      </div>
                      <div class="item__info">
                        <div class="item__info__single">
                          <p>Annual Return</p>
                          <h6>{{ al?.return }}</h6>
                        </div>
                        <div class="item__info__single">
                          <p>Property Type</p>
                          <h6>{{ tr(typLocation(al?.typ_prop)) }}</h6>
                        </div>
                      </div>
                      <div class="invest__cta__wrapper">
                        <div class="countdown__wrapper">
                          <p class="secondary"><i class="fa-solid fa-clock"></i> Left to
                            invest
                          </p>
                          <div class="countdown">
                            <h5>
                              <span class="days">00</span><span class="ref">d</span>
                              <span class="seperator">:</span>
                            </h5>
                            <h5>
                              <span class="hours"> 00</span><span class="ref">h</span>
                              <span class="seperator">:</span>
                            </h5>
                            <h5>
                              <span class="minutes">00</span><span class="ref">m</span>
                              <span class="seperator"></span>
                            </h5>
                          </div>
                        </div>
                        <div class="invest__cta">
                          <a href="#" class="button button--effect" @click.prevent="openArticlePageDetail(al)">
                            {{ t(' Invest Now') }}
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </template>
            </div>
            <section>
              <n-space justify="center" style="margin-top: 2rem">
                <n-pagination v-model:page="page" :page-count="Math.ceil(sameProp(article?.ville).length / 3)" />
              </n-space>
            </section>

          </div>
        </div>
      </div>
    </section>
  </section>
</template>
<style scoped>
.n-image {
  border-radius: 5%;
}

.n-pagination .n-pagination-item:not(.n-pagination-item--disabled).n-pagination-item--active {
  color: #143b50;
  border-color: #e7bd67;
}

.n-pagination .n-pagination-item:not(.n-pagination-item--disabled):hover {
  color: #e7bd67;
}
</style>