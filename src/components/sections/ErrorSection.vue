<script setup>
  // section: ErrorSection

  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res } = useGlobal()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('wid_1')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')
</script>

<template>
  <section>
    <!-- Put your section template code here -->
    <section class="error bg__img pos__rel over__hi" 
    :style="`background:url('/assets/images/error-bg.png')`">
        <div class="container">
            <div class="error__area">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-4">
                        <div class="error__content">
                            <h1>Oops!</h1>
                            <h3>Page Not Found</h3>
                            <p class="primary">We can’t seem to find the page
                                you’re looking for</p>
                            <a href="index.html" class="button button--effect"> Back To Home <i
                                    class="fa-solid fa-arrow-right-long"></i> </a>
                        </div>
                    </div>
                    <div class="col-lg-8 d-none d-lg-block">
                        <div class="error__thumb thumb__ltr">
                            <img src="/assets/images/error.png" alt="Error" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>