<script setup>
// section: LoanPropetieDetailSection
import { useRoute, useRouter } from 'vue-router';
import { NImageGroup, NSpace, NImage, NPagination, NProgress } from 'naive-ui';
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
const uniqueWidget = getUniqueWidgetData('wid_1')

// Get duplicable widgets
const duplicableWidgets = getDuplicableWidgetsData('loan_section')

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
        router.push(`/businessloandetails/${article.slug}`)
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


function paginateArray(array, pageSize, pageNumber) {
    const startIndexP = (pageNumber - 1) * pageSize
    const endIndexP = startIndexP + pageSize
    return array.slice(startIndexP, endIndexP)
}
function gallerie(gale) {
    galImg = JSON.parse(gale)
    return galImg
}
/*function proj(nb) {
  if (nb != "") {
    projectInfo.value = projInfo.find((a) => a?._id == nb)
    reasons = ref(JSON.parse(projectInfo.value.reasons))
    when_invest = ref(JSON.parse(projectInfo.value.when_invest))

    console.log({ reasons: reasons.value, invest: when_invest.value })
    return projectInfo
  } else {
    router.push('/businessloan')
  }
}*/



init()
</script>

<template>
    <section>
        <!-- Put your section template code here -->
        <section class="properties__grid section__space wow fadeInUp">
            <div class="container">
                <div class="properties__grid__area">
                    <div class="title__with__cta">
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-8">
                                <h2>Browse Similar Business</h2>
                            </div>
                            <div class="col-lg-4">
                                <div class="text-start text-lg-end">
                                    <a href="/propertiespage" class="button button--secondary button--effect">Browse All
                                        Properties</a>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="property__grid__wrapper">
                        <div class="row alt__loan__row">
                            <template v-for="(lo, index) in paginateArray(duplicableWidgets, 3, page).reverse()"
                                :key="index">
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
                                                            <a href="/loandetails">{{ lo?.name_loan }}</a>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="progress__type progress__type--three">
                                                    <p class="collected">Collected Amount</p>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <p class="project__has"><span class="project__has__investors">{{
                                                        lo?.investor }}
                                                            Investors</span> | <span
                                                            class="project__has__investors__amount"><i
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
                                                    <a href="/loandetails" class="button button--effect"
                                                        @click.prevent="openArticlePage(lo)">
                                                        Invest Now
                                                    </a>
                                                    <p class="secondary">Business loan #00134</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <!--div class="col-md-6 col-xl-4 alt__loan__grid">
                                <div class="alt__loan__grid__single">
                                    <div class="imi__alt">
                                        <div class="img__effect">
                                            <a href="/propertiesdetails">
                                                <img src="/assets/images/property/two.png" alt="Los Angeles" />
                                            </a>
                                            <div class="ribbon">
                                                <p>Waiting For Invest</p>
                                            </div>
                                        </div>
                                        <div class="alt__loan__content">
                                            <div class="item__head">
                                                <div class="item__head__left">
                                                    <p>Infinite Electric</p>
                                                    <h5>
                                                        <a href="business-loan-details.html">LTD Orandis</a>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="progress__type progress__type--three">
                                                <p class="collected">Collected Amount</p>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="project__has"><span class="project__has__investors">159
                                                        Investors</span> | <span class="project__has__investors__amount"><i
                                                            class="fa-solid fa-dollar-sign"></i>
                                                        1,94,196</span> <span
                                                        class="project__has__investors__percent">(64.73%)</span></p>
                                            </div>
                                            <div class="item__info">
                                                <div class="item__info__single">
                                                    <p>Annual Return</p>
                                                    <h6>7.5% + 2%</h6>
                                                </div>
                                                <div class="item__info__single">
                                                    <p>Maximum Term</p>
                                                    <h6>36 Months</h6>
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
                                                <a href="business-loan-details.html" class="button button--effect">
                                                    Invest Now
                                                </a>
                                                <p class="secondary">Business loan #00294</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4 alt__loan__grid">
                                <div class="alt__loan__grid__single">
                                    <div class="imi__alt">
                                        <div class="img__effect">
                                            <a href="property-details.html">
                                                <img src="/assets/images/property/three.png" alt="Los Angeles" />
                                            </a>
                                            <div class="ribbon">
                                                <p>Waiting For Invest</p>
                                            </div>
                                        </div>
                                        <div class="alt__loan__content">
                                            <div class="item__head">
                                                <div class="item__head__left">
                                                    <p>Circle Tree</p>
                                                    <h5>
                                                        <a href="business-loan-details.html">LTD Pri,ita</a>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="progress__type progress__type--three">
                                                <p class="collected">Collected Amount</p>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="project__has"><span class="project__has__investors">159
                                                        Investors</span> | <span class="project__has__investors__amount"><i
                                                            class="fa-solid fa-dollar-sign"></i>
                                                        1,94,196</span> <span
                                                        class="project__has__investors__percent">(64.73%)</span></p>
                                            </div>
                                            <div class="item__info">
                                                <div class="item__info__single">
                                                    <p>Annual Return</p>
                                                    <h6>7.5% + 2%</h6>
                                                </div>
                                                <div class="item__info__single">
                                                    <p>Maximum Term</p>
                                                    <h6>36 Months</h6>
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
                                                <a href="business-loan-details.html" class="button button--effect">
                                                    Invest Now
                                                </a>
                                                <p class="secondary">Business loan #00994</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div-->

                        </div>
                        <section>
                            <n-space justify="center" style="margin-top: 2rem">
                                <n-pagination v-model:page="page" :page-count="Math.ceil(duplicableWidgets.length / 3)" />
                            </n-space>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>