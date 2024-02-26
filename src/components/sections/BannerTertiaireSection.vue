<script setup>
// section: BannerTertiaireSection

const { t } = useI18n()

const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
const { websiteInfo } = useInfo()
const { tr, res } = useGlobal()

// Get unique widget
const uniqueWidget = getUniqueWidgetData('banner_application')

// Get duplicable widgets
const duplicableWidgets = getDuplicableWidgetsData('wid_2')
</script>

<template>
    <section>
        <!-- Put your section template code here -->
        <section 
            class="banner banner--tertiary clear__top bg__img" 
            :style="`background: url('${res(uniqueWidget?.properties_alert_image)}')`">
                <div class="container">
                    <div class="banner__area">
                        <h1 class="neutral-top">Property Alerts</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">{{t('Home')}}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Pages
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Property Alerts
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
        </section>
    </section>
</template>