<script setup>
  // section: PropertiesPageDetailSection
  import { useRoute, useRouter } from 'vue-router'
  import { NImageGroup, NSpace, NImage, NPagination, NProgress } from 'naive-ui'
  const { t } = useI18n()
  const router = useRouter()
  const route = useRoute()
  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo, websiteMoreInfo, websiteOwnerInfo } = useInfo()
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
  var days = ref('00')
  var hours = ref('00')
  var minutes = ref('00')
  var seconds = ref('00')
  var millisecond = ref('00')
  const faqId = ref() //'headingFundOne-0'
  const dbNewsArticleStore = useDbNewsArticleStore()
  const {
    fetchArticleBySlug,
    openPropertiesDetailsPage,
    getPropertiesDetailsLink,
    getPropertiesLink,
    openPropertiesPage,
    getContactLink,
    openContactPage,
  } = useNews()
  // Get unique widget

  const uniqueWidget = getUniqueWidgetData('banner_application')
  const projDetailInfo = getUniqueWidgetData('project_detail_info')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('properties_section_item')
  const faqQest = getDuplicableWidgetsData('faq_question_item')
  const projInfo = getDuplicableWidgetsData('project_detail')
  const locat = getDuplicableWidgetsData('property_filter_location_section')
  const typLo = getDuplicableWidgetsData('property_filter_type_section')
  const filepdf = getDuplicableWidgetsData('file')

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
  function sameProp(ville, id) {
    var sam = duplicableWidgets.filter((a) => a?.ville == ville)
    var prop = sam.filter((b) => b._id != id)
    return prop
  }

  function apLocation(id) {
    const loca = locat.find((loc) => loc._id === id)
    return loca?.location
  }
  function typLocation(id) {
    const loca = typLo.find((loc) => loc._id === id)
    return loca?.typ
  }
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
  function gallerie(gale) {
    galImg = JSON.parse(gale)
    return galImg
  }
  function proj(nb) {
    if (nb != '') {
      projectInfo.value = projInfo.find((a) => a?._id == nb)
     /* reasons = ref(JSON.parse(projectInfo.value.reasons))
      when_invest = ref(JSON.parse(projectInfo.value.when_invest))*/
      return projectInfo
    }
  }
  const coords = computed(() => {
    try {
      return JSON.parse(websiteOwnerInfo.value.location)
    } catch (e) {
      return { lat: '0.0', lng: '0.0' }
    }
  })
  const openfaq = (id) => {
    faqId.value = id
    return faqId
  }
  const diffComp = computed({
    get() {
      return minutes.value
    },
    set(dte) {
      var da = new Date()
      var dp = new Date(dte)
      if (da > dp) {
        days = '00'
        hours = '00'
        minutes = '00'
        seconds = '00'
        millisecond = '00'
      } else {
        var diffInSeconds = Math.abs(dp - da) / 1000
        days = Math.floor(diffInSeconds / 60 / 60 / 24)
        hours = Math.floor((diffInSeconds / 60 / 60) % 24)
        minutes = Math.floor((diffInSeconds / 60) % 60)
        seconds = Math.floor(diffInSeconds % 60)
        millisecond = Math.round(
          (diffInSeconds - Math.floor(diffInSeconds)) * 1000
        )
      }
      return minutes.value
    },
  })

  const propFile = (id) => {
    var fileArticle = filepdf.filter((a) => a?.properties == id)
    return fileArticle
  }

  console.log('por',{projInfo});

  init()
</script>

<template>
  <div
    class="property__details__banner bg__img clear__top"
    :style="`background: url('${res(
      uniqueWidget?.properties_detail_image
    )}') no-repeat fixed left top;`"></div>
  <section class="p__details faq section__space__bottom">
    <div class="container">
      <div class="p__details__area">
        <div class="row">
          <div class="col-lg-7">
            <div class="p__details__content">
              <a href="#gallery" class="button button--effect button--secondary"
                ><i class="fa-solid fa-images"></i> {{ t('Browse Gallery') }}</a
              >
              <div class="intro">
                <h3>{{ apLocation(article?.ville) }}</h3>
                <p>
                  <i class="fa-solid fa-location-dot"></i>
                  {{ article?.localisation }}
                </p>
              </div>
              <div v-if="proj(article?.project)" class="group__one">
                
                <p v-html="rHtml(projectInfo?.description)" />
              </div>
              <div class="terms">
                <h5 v-if="rHtml(projDetailInfo?.title_terms)"  v-html="rHtml(projDetailInfo?.title_terms)"/>
                <div class="terms__wrapper">
                  <div class="terms__single">
                    <img
                      src="/assets/images/icons/investor.png"
                      alt="Maximum Loan" />
                    <p>{{ t('Investors') }}</p>
                    <h5 class="neutral-bottom">
                      {{ projectInfo?.pro_investor }}
                    </h5>
                  </div>
                  <div class="terms__single">
                    <img src="/assets/images/icons/project.png" alt="Charge" />
                    <p>{{ t('Project') }}</p>
                    <h5 class="neutral-bottom">
                      {{ projectInfo?.pro_percent }}%
                    </h5>
                  </div>
                  <div class="terms__single">
                    <img src="/assets/images/icons/revest.png" alt="Annual" />
                    <p>Revest</p>
                    <h5 class="neutral-bottom">{{ article?.percent }}%</h5>
                  </div>
                </div>
              </div>
              <div class="owner">
                <img :src="res(projectInfo?.image_execute)" alt="Owner" />
                <div>
                  <h5>{{ projectInfo?.pro_execute }}</h5>
                  <p v-html="rHtml(projectInfo?.pro_execute_description)" />
                </div>
              </div>
              <div class="faq__group">
                <h5 class="atr"  v-if="(projDetailInfo?.faq_title)">{{ tr(projDetailInfo?.faq_title) }}</h5>
                <div class="accordion" id="accordionExampleFund">
                  <template
                    v-for="(fq, index) in faqQest?.slice(0, 3)"
                    :key="index">
                    <div class="accordion-item content__space">
                      <h5
                        :id="`headingFundOne-${index}`"
                        class="accordion-header">
                        <span class="icon_box">
                          <img
                            src="/assets/images/icons/message.png"
                            alt="Fund" />
                        </span>
                        <button
                          :class="
                            faqId == `headingFundOne-${index}`
                              ? 'accordion-button'
                              : 'accordion-button collapsed'
                          "
                          type="button"
                          data-bs-toggle="collapse"
                          :data-bs-target="`#collapseFundOne-${index}`"
                          :aria-expanded="
                            faqId == `headingFundOne-${index}`
                              ? 'true'
                              : 'false'
                          "
                          :aria-controls="`collapseFundOne-${index}`"
                          @click.prevent="openfaq(`headingFundOne-${index}`)">
                          {{ tr(fq?.title) }}
                        </button>
                      </h5>
                      <div
                        :id="`collapseFundOne-${index}`"
                        :class="
                          faqId == `headingFundOne-${index}`
                            ? ' accordion-collapse collapse show'
                            : ' accordion-collapse collapse '
                        "
                        :aria-labelledby="`headingFundOne-${index}`"
                        data-bs-parent="#accordionExampleFund">
                        <div class="accordion-body">
                          <p v-html="rHtml(fq?.text)" />
                        </div>
                      </div>
                    </div>
                  </template>
                </div>
              </div>
              <div class="group__one">
                <!--h4>{{ t('Key investment risks:') }}</h4>
                <p>
                  Risk of falling prices: The price of the property might fall
                  due to the increase in supply or decrease in demand in the
                  area or other economic factors.Liquidity risk: The borrower
                  might be unable to find a buyer in order to sell the
                  property.Tenant risk: There is a risk that the asset can lose
                  a tenant and it can take time to find replacements, which can
                  have impact on the property's cash-flow.
                </p-->
                <div class="map__wrapper">
                  <iframe
                    :src="
                      article?.map
                        ? article?.map
                        : `https://maps.google.com/maps?q=${coords.lat},${coords.lng}&hl=${locale}&z=14&amp;output=embed`
                    "
                    width="746"
                    height="312"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="p__details__sidebar">
              <div class="intro">
                <div class="countdown__wrapper">
                  <p class="secondary">
                    <i class="fa-solid fa-clock"></i>
                    {{ t('Left to invest') }}
                  </p>
                  <div class="countdown" v-if="(diffComp = article?.time)">
                    <h5>
                      <span class="days">{{ days != 0 ? days : '00' }}</span
                      ><span class="ref">d</span>
                      <span class="seperator">:</span>
                    </h5>
                    <h5>
                      <span class="hours"> {{ hours != 0 ? hours : '00' }}</span
                      ><span class="ref">h</span>
                      <span class="seperator">:</span>
                    </h5>
                    <h5>
                      <span class="minutes"
                        >{{ minutes != 0 ? minutes : '00' }} </span
                      ><span class="ref">m</span>
                      <span class="seperator"></span>
                    </h5>
                  </div>
                </div>
                <h5 >{{ tr(projDetailInfo?.title_time) }} <span>€134 514</span></h5>
                <div class="progress__type progress__type--two">
                  <div class="progress">
                    <n-progress
                      type="line"
                      :percentage="article?.percent"
                      :indicator-placement="'inside'"
                      indicator-text-color="green"
                      color="green"
                      processing />
                  </div>
                  <div class="project__info">
                    <p class="project__has">
                      <span class="project__has__investors"
                        >{{ article?.nbinvest }} Investors</span
                      >
                      |
                      <span class="project__has__investors__amount"
                        ><i class="fa-solid fa-dollar-sign"></i>
                        {{ article?.price }}</span
                      >
                    </p>
                    <p class="project__goal">
                      <i class="fa-solid fa-dollar-sign"></i>
                      {{ article?.total }} {{ t('Goal') }}
                    </p>
                  </div>
                </div>
              </div>
              <!--div class="group brin">
                <h5 class="neutral-top">{{ t('Occupancy') }}</h5>
                <div class="acus__btns">
                  <a
                    href="javascript:void(0)"
                    class="acus__btn acus__btn__active"
                    >0%</a
                  >
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
                      <input
                        type="number"
                        name="an__num"
                        id="anNum"
                        placeholder="7.00%"
                        required="required" />
                    </div>
                    <div class="input input--secondary">
                      <label for="anNumIn">Invest</label>
                      <input
                        type="number"
                        name="an__num_in"
                        id="anNumIn"
                        placeholder="€ 500"
                        required="required" />
                    </div>
                    <div class="input input--secondary">
                      <label for="anNumInTwo">Earn</label>
                      <input
                        type="number"
                        name="an__num_in_two"
                        id="anNumInTwo"
                        placeholder="€ 35.00"
                        required="required" />
                    </div>
                    <div class="capital">
                      <p>Capital Growth Split:</p>
                      <h5>
                        40%
                        <a href="/blog"
                          ><i class="fa-solid fa-circle-info"></i
                        ></a>
                      </h5>
                    </div>
                    <div class="item__security">
                      <div class="icon__box">
                        <img src="/assets/images/home.png" alt="Security" />
                      </div>
                      <div class="item__security__content">
                        <p class="secondary">Security</p>
                        <h6>{{ article?.security }}</h6>
                      </div>
                    </div>
                    <div class="suby">
                      <h5>500</h5>
                      <button type="submit" class="button button--effect">
                        Invest Now
                      </button>
                    </div>
                  </form>
                </div>
                <p class="text-center neutral-bottom">
                  <a
                    :href="getContactLink()"
                    @click.prevent="openContactPage()"
                    >{{ t('Request a free callback') }}</a
                  >
                </p>
              </div-->
              <!--div class="group brini">
                  <h5 class="neutral-top">Investment Overview</h5>
                  <hr />
                  <p>
                    Purpose of the loan To increase the company's working
                    capital, magna a laoreet convallis, massa sapien tempor
                    arcu, nec euismod elit justo in lacus. Maecenas mattis massa
                    lectus, vel tincidunt augue porta non.
                  </p>
                  <p>
                    Duis quis orci vehicula, fermentum tortor vitae, imperdiet
                    sem. Quisque iaculis eu odio in lobortis. Sed vel ex non
                    erat pellentesque lobortis vel vitae diam. Donec gravida
                    eleifend pellentesque. Curabitur dictum blandit accumsan.
                  </p>
                  <a href="/blog">Read More</a>
                </div-->
              <div class="group birinit">
                <h6>{{ t('Share via Social') }}</h6>
                <div class="social text-start">
                  <a :href="websiteMoreInfo?.facebook">
                    <i class="fab fa-facebook-f"></i>
                  </a>
                  <a :href="websiteMoreInfo?.twitter">
                    <i class="fab fa-twitter"></i>
                  </a>
                  <a :href="websiteMoreInfo?.instagram">
                    <i class="fab fa-instagram"></i>
                  </a>
                  <a :href="websiteMoreInfo?.linkedin">
                    <i class="fab fa-linkedin-in"></i>
                  </a>
                </div>
              </div>
              <!--div class="group alt__brin">
                <h5>Key Updates <i class="fa-solid fa-bell"></i></h5>
                <hr />
                <div class="singl__wrapper">
                  <div class="singl">
                    <img src="/assets/images/check.png" alt="Check" />
                    <div>
                      <p>30-Aug-2022</p>
                      <a href="/termsconditions">Term Sheet Signed</a>
                    </div>
                  </div>
                  <div class="singl">
                    <img src="/assets/images/check.png" alt="Check" />
                    <div>
                      <p>30-Aug-2022</p>
                      <a href="/privacypolicy">Listing Live</a>
                    </div>
                  </div>
                </div>
              </div-->
              <div
                v-if="propFile(article?._id).length"
                class="group alt__brin__last">
                <h5>{{ t('Reports') }}</h5>
                <hr />
                <template v-for="(f, i) in propFile(article?._id)" :key="i">
                  <h6>{{ tr(f?.title) }}</h6>
                  <p v-html="rHtml(f?.subtitle)" />
                  <a :href="f?.file" target="_blank" class="button"
                    >{{ t('DOWNLOAD') }} <i class="fa-solid fa-download"></i
                  ></a>
                </template>
                <!--h6>{{ t('Legal Title Report') }}</h6>
                <p>
                  Detailed Report on the Title diligence of the property by
                  Amarchand Mangaldas
                </p>
                <a href="javascript:void(0)" class="button"
                  >{{ t('DOWNLOAD TITLE REPORT')
                  }}<i class="fa-solid fa-download"></i
                ></a-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section
    v-if="gallerie(article?.gallerie).length"
    id="gallery"
    class="p__gallery wow fadeInUp">
    <div class="container">
      <hr class="divider" />
      <div class="p__gallery__area section__space">
        <div class="title__with__cta">
          <div class="row d-flex align-items-center">
            <div class="col-lg-8">
              <h2>{{ t('Property Gallery') }}</h2>
            </div>
            <div class="col-lg-4">
              <div v-if="projDetailInfo?.btn_gallerie" class="text-start text-lg-end">
                <a
                  :href="getContactLink()"
                  @click.prevent="openContactPage()"
                  class="button button--secondary button--effect"
                  >{{ tr(projDetailInfo?.btn_gallerie) }}</a
                >
              </div>
            </div>
          </div>
        </div>
        <div class="row p__gallery__single">
          <n-image-group>
            <n-space justify="center">
              <n-image
                v-for="(image, imageKey) in paginateArrayG(
                  gallerie(article?.gallerie),
                  6,
                  page
                )"
                :key="imageKey"
                width="300"
                border-radius="5%"
                lazy
                :src="res(image)" />
            </n-space>
            <n-space
              v-if="gallerie(article?.gallerie) > 6"
              justify="center"
              style="margin-top: 2rem">
              <n-pagination
                v-model:page="page"
                :page-count="
                  Math.ceil(gallerie(article?.gallerie).length / 6)
                " />
            </n-space>
          </n-image-group>
        </div>
      </div>
    </div>
  </section>
  <section
    v-if="sameProp(article?.ville, article?._id).length"
    class="properties__grid section__space">
    <div class="container">
      <div class="properties__grid__area wow fadeInUp">
        <div class="title__with__cta">
          <div class="row d-flex align-items-center">
            <div class="col-lg-8">
              <h2>{{ t('Browse Similar Properties') }}</h2>
            </div>
            <div class="col-lg-4">
              <div class="text-start text-lg-end">
                <a
                  :href="getPropertiesLink()"
                  @click.prevent="openPropertiesPage()"
                  class="button button--secondary button--effect"
                  >{{ t('Browse All Properties') }}</a
                >
              </div>
            </div>
          </div>
        </div>
        <div class="property__grid__wrapper">
          <div class="row">
            <template
              v-for="(al, index) in paginateArrayP(
                sameProp(article?.ville, article?._id),
                3,
                page
              ).reverse()"
              :key="index">
              <div class="col-lg-4 col-xl-4">
                <div class="property__grid__single">
                  <div class="img__effect">
                    <a href="#" @click.prevent="openPropertiesDetailsPage(al)">
                      <img :src="res(al?.image)" alt="Property" />
                    </a>
                  </div>
                  <div class="property__grid__single__inner">
                    <h4>{{ apLocation(al?.ville) }}</h4>
                    <p class="sub__info">
                      <i class="fa-solid fa-location-dot"></i>
                      {{ al?.localisation }}s
                    </p>
                    <div class="progress__type">
                      <div class="progress">
                        <n-progress
                          type="line"
                          :percentage="al?.percent"
                          :indicator-placement="'inside'"
                          indicator-text-color="green"
                          color="green"
                          processing />
                      </div>

                      <p class="project__has">
                        <span class="project__has__investors"
                          >{{ al?.nbinvest }} Investors</span
                        >
                        |
                        <span class="project__has__investors__amount"
                          ><i class="fa-solid fa-dollar-sign"></i>
                          {{ al?.price }}</span
                        >
                        <span class="project__has__investors__percent"
                          >({{ al?.percent }}%)</span
                        >
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
                        <p class="secondary">
                          <i class="fa-solid fa-clock"></i> Left to invest
                        </p>
                        <div class="countdown" v-if="(diffComp = al?.time)">
                          <h5>
                            <span class="days">
                              {{ days != 0 ? days : '00' }}</span
                            ><span class="ref">d</span>
                            <span class="seperator">:</span>
                          </h5>
                          <h5>
                            <span class="hours">
                              {{ hours != 0 ? hours : '00' }}</span
                            ><span class="ref">h</span>
                            <span class="seperator">:</span>
                          </h5>
                          <h5>
                            <span class="minutes">{{
                              minutes != 0 ? minutes : '00'
                            }}</span
                            ><span class="ref">m</span>
                            <span class="seperator"></span>
                          </h5>
                        </div>
                      </div>
                      <div class="invest__cta">
                        <a
                          :href="getPropertiesDetailsLink(al)"
                          class="button button--effect"
                          @click.prevent="openPropertiesDetailsPage(al)">
                          {{ t('Invest Now') }}
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </template>
          </div>
          <section v-if="sameProp(article?.ville, article?._id) > 3">
            <n-space justify="center" style="margin-top: 2rem">
              <n-pagination
                v-model:page="page"
                :page-count="
                  Math.ceil(sameProp(article?.ville, article?._id).length / 3)
                " />
            </n-space>
          </section>
        </div>
      </div>
    </div>
  </section>
</template>
<style scoped>
  .n-image {
    border-radius: 5%;
  }

  .n-pagination
    .n-pagination-item:not(
      .n-pagination-item--disabled
    ).n-pagination-item--active {
    color: #143b50;
    border-color: #e7bd67;
  }

  .n-pagination .n-pagination-item:not(.n-pagination-item--disabled):hover {
    color: #e7bd67;
  }
</style>
