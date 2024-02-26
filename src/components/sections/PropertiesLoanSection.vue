<script setup>
// section: PropertiesLoanSection
import { useRoute } from 'vue-router';
import { useRouter } from 'vue-router'
import { NCarousel, NSpace, NPagination, NProgress } from 'naive-ui';
const { t } = useI18n()

const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
const { websiteInfo } = useInfo()
const { tr, res, rHtml } = useGlobal()
const route = useRoute()
const router = useRouter()
const page = ref(1)
const dbNewsArticleStore = useDbNewsArticleStore()
// Get unique widget
const uniqueWidget = getUniqueWidgetData('wid_1')

// Get duplicable widgets
const duplicableWidgets = getDuplicableWidgetsData('loan_section')
function paginateArray(array, pageSize, pageNumber) {
  const startIndex = (pageNumber - 1) * pageSize
  const endIndex = startIndex + pageSize
  return array.slice(startIndex, endIndex)
}
const openArticlePage = (article) => {
  if (article) {
    dbNewsArticleStore.article = article
    router.push(`/businessloandetails/${article.slug}`)

  }
}

</script>


<template>
    <section>
        <!-- Put your section template code here -->
        <section class="alt__loan section__space__bottom">
            <div class="container">
                <div class="alt__loan__area wow fadeInUp">
                    <div class="properties__filter__wrapper">
                        <h6>Showing <span>505</span> Business Loans</h6>
                        <div class="grid__wrapper">
                            <select class="grid__select">
                                <option data-display="Sort By">Sort By</option>
                                <option value="grid">Date</option>
                                <option value="list">Price</option>
                            </select>
                            <a href="javascript:void(0)" class="grid__btnn grid__vieww grid__btnn__active">
                                <i class="fa-solid fa-grip"></i>
                            </a>
                            <a href="javascript:void(0)" class="grid__btnn grid__listt">
                                <i class="fa-solid fa-bars"></i>
                            </a>
                        </div>
                    </div>
                    <div class="row alt__loan__row">
                        <template v-for="(lo, index) in paginateArray(duplicableWidgets, 3, page).reverse()" :key="index">
                            <div class="col-md-6 col-xl-4 alt__loan__grid">
                                <div class="alt__loan__grid__single">
                                    <div class="imi__alt">
                                        <div class="img__effect">
                                            <a href="/propertiesdetails">
                                                <img :src="res(lo?.image)" alt="loan image" />
                                            </a>
                                            <div class="ribbon">
                                                <p>{{ t('Waiting For Invest') }}</p>
                                            </div>
                                        </div>
                                        <div class="alt__loan__content">
                                            <div class="item__head">
                                                <div class="item__head__left">
                                                    <p>{{ lo?.industries }}</p>
                                                    <h5>
                                                        <a href=""  @click.prevent="openArticlePage(lo)">{{ lo?.name_loan }}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="progress__type progress__type--three">
                                                <p class="collected">Collected Amount</p>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="project__has"><span
                                                        class="project__has__investors">{{ lo?.investor }}
                                                        Investors</span> | <span class="project__has__investors__amount"><i
                                                            class="fa-solid fa-dollar-sign"></i>
                                                        6,94,196</span> <span
                                                        class="project__has__investors__percent">(35.73%)</span></p>
                                            </div>
                                            <div class="item__info">
                                                <div class="item__info__single">
                                                    <p>Annual Return</p>
                                                    <h6>{{ lo?.return_annual }}</h6>
                                                </div>
                                                <div class="item__info__single">
                                                    <p>Maximum Term</p>
                                                    <h6>{{ lo?.maxterm }} Months</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="alt__loan__foot">
                                        <div class="invest__cta__wrapper">
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
                                            <div class="invest__cta">
                                                <a href="" class="button button--effect"  @click.prevent="openArticlePage(lo)">
                                                    Invest Now
                                                </a>
                                                <p class="secondary">Business loan #00134</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                <section>
                    <n-space justify="center" style="margin-top: 2rem">
                        <n-pagination v-model:page="page" :page-count="Math.ceil(duplicableWidgets.length / 3)" />
                    </n-space>
                </section>
                <!--div class="cta__btn">
                    <a href="/propertiesdetails" class="button button--effect">Load More</a>
                </div-->
            </div>
        </section>
    </section>
</template>
<style scoped>
select {
    border: 1px solid gainsboro;
    border-radius: 10px;
}

.grid__select {
    width: auto;
    align-items: center;
    display: flex;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 20px;
    padding-bottom: 20px;
    position: relative;
}
</style>