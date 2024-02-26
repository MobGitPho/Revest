<script setup>
// section: LoanGalerieSection
import { useRoute, useRouter } from 'vue-router';
import { NImageGroup, NSpace, NImage, NPagination, NProgress } from 'naive-ui';
const { t } = useI18n()

const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
const { websiteInfo } = useInfo()
const { tr, res } = useGlobal()
const router = useRouter()
const route = useRoute()
const article = ref(null)
var projectInfo = ref(null)
const images = ref([])
const galId = ref()
var galImg = ref()
const page = ref(1)
const galToShow = ref(route.hash.split('?'))
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
        <section class="p__gallery wow fadeInUp" id="gallery">
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
                                    <a href="/contact" class="button button--secondary button--effect">Request
                                        info</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="article?.image_gallerie" class="row p__gallery__single">
                        <!--div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href="/assets/images/gallery/one.png">
                            <img src="/assets/images/gallery/one.png" alt="Property Image" />
                        </a>
                    </div-->
                        <n-image-group>
                            <n-space justify="center">
                                <n-image v-for="(image, imageKey) in paginateArray(gallerie(article?.image_gallerie), 6, page)"
                                    :key="imageKey" width="300" border-radius="5%" lazy :src="res(image)" />
                            </n-space>
                            <n-space justify="center" style="margin-top: 2rem">
                                <n-pagination v-model:page="page"
                                    :page-count="Math.ceil(gallerie(article?.image_gallerie).length / 6)" />
                            </n-space>
                        </n-image-group>

                        <!--div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href="/assets/images/gallery/two.png">
                            <img src="/assets/images/gallery/two.png" alt="Property Image" />
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href="/assets/images/gallery/three.png">
                            <img src="/assets/images/gallery/three.png" alt="Property Image" />
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href=":assets/images/gallery/four.png">
                            <img src="/assets/images/gallery/four.png" alt="Property Image" />
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href="/assets/images/gallery/five.png">
                            <img src="/assets/images/gallery/five.png" alt="Property Image" />
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href="/assets/images/gallery/six.png">
                            <img src="/assets/images/gallery/six.png" alt="Property Image" />
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href="/assets/images/gallery/seven.png">
                            <img src="/assets/images/gallery/seven.png" alt="Property Image" />
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href="/assets/images/gallery/eight.png">
                            <img src="/assets/images/gallery/eight.png" alt="Property Image" />
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 gallery__single__two">
                        <a href="/assets/images/gallery/nine.png">
                            <img src="/assets/images/gallery/nine.png" alt="Property Image" />
                        </a>
                    </div-->
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