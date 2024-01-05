<script setup>
  // section: BannerLoanSection

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
    <section class="banner__alt bg__img" 
    :style="`background: url('${res(uniqueWidget?.loan_image)}') `">
        <div class="container">
            <div class="banner__alt__area neut">
                <h5 class="neutral-top" >{{tr(uniqueWidget?.loan_subtitle)}}</h5>
                <h1 class="neutral-top neutral-bottom">{{tr(uniqueWidget?.loan_title)}}</h1>
            </div>
        </div>
    </section>
    <div class="property__filter property__filter__two">
        <div class="container">
            <div class="property__filter__area">
                <div class="row d-flex align-items-end">
                    <div class="col-lg-12 col-xl-6 col-xxl-4">
                        <div class="property__search__wrapper">
                            <p class="neutral-top">The name of the loan:</p>
                            <form action="#" method="post">
                                <div class="input">
                                    <input type="search" name="property__search" id="propertySearch"
                                        placeholder="Search for properties" />
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 col-xxl-3">
                        <div class="property__select__wrapper">
                            <p class="neutral-top">Loan Status</p>
                            <select class="location__select">
                                <option data-display="Waiting for Investments">Waiting for Investments</option>
                                <option value="com">Completed</option>
                                <option value="pro">In Progress</option>
                                <option value="sub">Submitted</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 col-xxl-3">
                        <div class="property__select__wrapper">
                            <p class="neutral-top">Rish Class:</p>
                            <select class="property__select">
                                <option data-display="All">All</option>
                                <option value="commercial">Commercial</option>
                                <option value="residential">Residential</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-6 col-xxl-2">
                        <button type="submit" class="button button--effect">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
</template>