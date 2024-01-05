<script setup>
// section: AllPropSection
import { useRoute } from 'vue-router';
import { useRouter } from 'vue-router'
import { NCarousel, NSpace, NPagination } from 'naive-ui';
const { t } = useI18n()
const route = useRoute()
const router = useRouter()
const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
const { websiteInfo } = useInfo()
const { tr, res } = useGlobal()
const page = ref(1)

const dbNewsArticleStore = useDbNewsArticleStore()
// Get unique widget
const uniqueWidget = getUniqueWidgetData('wid_1')

// Get duplicable widgets
const duplicableWidgets = getDuplicableWidgetsData('properties_section_item')
const locat = getDuplicableWidgetsData('property_filter_location_section')
const typLo = getDuplicableWidgetsData('property_filter_type_section')

function apLocation(id) {
    const loca = locat.find((loc) => loc._id === id)
    return loca.location;
}
function typLocation(id) {
    const loca = typLo.find((loc) => loc._id === id)
    return loca.typ;
}
function paginateArray(array, pageSize, pageNumber) {
    const startIndex = (pageNumber - 1) * pageSize
    const endIndex = startIndex + pageSize
    return array.slice(startIndex, endIndex)
}
const openArticlePage = (article) => {
    if (article) {
        dbNewsArticleStore.article = article
        router.push(`/propertiesdetails/${article.slug}`)
    }
}
</script>

<template>
    <section>
        <!-- Put your section template code here -->
        <section class="properties__grid section__space">
            <div class="container">
                <div class="properties__grid__area wow fadeInUp">
                    <div class="title__with__cta">
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-8">
                                <h2>{{ t('All Properties') }}</h2>
                            </div>
                            <div class="col-lg-4">
                                <div class="text-start text-lg-end">
                                    <a href="properties.html" class="button button--secondary button--effect">
                                        {{ t('Browse All Properties') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="property__grid__wrapper">

                        <div class="row">
                            <template v-for="(al, index) in paginateArray(duplicableWidgets, 3, page).reverse() "
                                :key="index">

                                <div class=" col-lg-4 col-xl-4 ">
                                    <div class="property__grid__single">
                                        <div class="img__effect">
                                            <a href="#" @click.prevent="openArticlePage(al)">
                                                <img :src="res(al?.image)" alt="Property" />
                                            </a>
                                        </div>
                                        <div class="property__grid__single__inner">
                                            <h4>{{ apLocation(al?.ville) }}</h4>
                                            <p class="sub__info"><i class="fa-solid fa-location-dot"></i>
                                                {{ al?.localisation }}s</p>
                                            <div class="progress__type">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>

                                                <p class="project__has"><span class="project__has__investors">{{
                                                    al?.nbinvest }}
                                                        Investors</span> |
                                                    <span class="project__has__investors__amount"><i
                                                            class="fa-solid fa-dollar-sign"></i> {{ al?.price
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
                                                    <a href="#" class="button button--effect"
                                                        @click.prevent="openArticlePage(al)">
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
                                <n-pagination v-model:page="page" :page-count="Math.ceil(duplicableWidgets.length / 3)" />
                            </n-space>
                        </section>


                    </div>



                    <!--div class="property__grid__wrapper">
                    <div class="row">
                        <div class="col-lg-4 col-xl-4">
                            <div class="property__grid__single">
                                <div class="img__effect">
                                    <a href="property-details.html">
                                        <img src="assets/images/property/grid-four.jpg" alt="Property" />
                                    </a>
                                </div>
                                <div class="property__grid__single__inner">
                                    <h4>San Diego</h4>
                                    <p class="sub__info"><i class="fa-solid fa-location-dot"></i> 90071, Grand
                                        Avenue, San Diego</p>
                                    <div class="progress__type">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="project__has"><span class="project__has__investors">59
                                                Investors</span> |
                                            <span class="project__has__investors__amount"><i
                                                    class="fa-solid fa-dollar-sign"></i> 8,94,196</span> <span
                                                class="project__has__investors__percent">(54.73%)</span>
                                        </p>
                                    </div>
                                    <div class="item__info">
                                        <div class="item__info__single">
                                            <p>Annual Return</p>
                                            <h6>7.5% + 9%</h6>
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
                        <div class="col-lg-4 col-xl-4">
                            <div class="property__grid__single">
                                <div class="img__effect">
                                    <a href="property-details.html">
                                        <img src="assets/images/property/grid-five.jpg" alt="Property" />
                                    </a>
                                </div>
                                <div class="property__grid__single__inner">
                                    <h4>The Lily</h4>
                                    <p class="sub__info"><i class="fa-solid fa-location-dot"></i> Colorado Springs, CO
                                    </p>
                                    <div class="progress__type">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="project__has"><span class="project__has__investors">559
                                                Investors</span> |
                                            <span class="project__has__investors__amount"><i
                                                    class="fa-solid fa-dollar-sign"></i> 9,94,196</span> <span
                                                class="project__has__investors__percent">(84.73%)</span>
                                        </p>
                                    </div>
                                    <div class="item__info">
                                        <div class="item__info__single">
                                            <p>Annual Return</p>
                                            <h6>7.5% + 5%</h6>
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
                        <div class="col-lg-4 col-xl-4">
                            <div class="property__grid__single">
                                <div class="img__effect">
                                    <a href="property-details.html">
                                        <img src="assets/images/property/grid-six.jpg" alt="Property" />
                                    </a>
                                </div>
                                <div class="property__grid__single__inner">
                                    <h4>The Weldon</h4>
                                    <p class="sub__info"><i class="fa-solid fa-location-dot"></i> Gastonia, NC</p>
                                    <div class="progress__type">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="project__has"><span class="project__has__investors">139
                                                Investors</span> |
                                            <span class="project__has__investors__amount"><i
                                                    class="fa-solid fa-dollar-sign"></i> 1,14,196</span> <span
                                                class="project__has__investors__percent">(44.73%)</span>
                                        </p>
                                    </div>
                                    <div class="item__info">
                                        <div class="item__info__single">
                                            <p>Annual Return</p>
                                            <h6>5.5% + 2%</h6>
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
                    </div>
                </div-->
                </div>
            </div>
        </section>
    </section>
</template>
<style scoped>
.n-pagination .n-pagination-item:not(.n-pagination-item--disabled).n-pagination-item--active {
    color: #143b50;
    border-color: #e7bd67;
}

.n-pagination .n-pagination-item:not(.n-pagination-item--disabled):hover {
    color: #e7bd67;
}
</style>
