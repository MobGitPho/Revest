<script setup>
  // section: PropertyFilterSection
  import { NSpace, NSelect } from 'naive-ui'
  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res } = useGlobal()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('property_filter_section')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData(
    'property_filter_location_section'
  )
  const duplicableWidgets_2 = getDuplicableWidgetsData(
    'property_filter_type_section'
  )
</script>

<template>
  <div class="property__filter">
    <div class="container">
      <div class="property__filter__area">
        <div class="row d-flex align-items-center">
          <div class="col-lg-12 col-xl-6">
            <div class="property__search__wrapper">
              <form action="#" method="post">
                <div class="input">
                  <input
                    type="search"
                    name="property__search"
                    id="propertySearch"
                    :placeholder="t('Search for properties')" />
                  <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <button type="submit" class="button button--effect">
                  {{t('Search')}}
                </button>
              </form>
            </div>
          </div>

          <div class="col-lg-6 col-xl-3">
            <div class="property__select__wrapper">
              <select class="location__select">
                <!--option data-display="Location">{{t('Select Location')}}</option-->
                <option :data-display="Location">{{t('Select Location')}}</option>
                <template
                  v-for="(loc, index) in duplicableWidgets"
                  :key="index">
                  <option :value="loc?.location">{{ loc?.location }}</option>
                </template>

                <!--option value="francis">San Francisco, CA</option>
                                    <option value="weldon">The Weldon</option>
                                    <option value="diego">San Diego</option-->
              </select>
            </div>
          </div>
          <div class="col-lg-6 col-xl-3">
            <div class="property__select__wrapper">
              <select class="property__select">
                <!--option data-display="Property">{{t('Property Type')}}</option-->
                <option>{{t('Property Type')}}</option>
                <template
                  v-for="(tp, index) in duplicableWidgets_2"
                  :key="index">
                  <option :value="tr(tp?.typ)">{{ tr(tp?.typ) }}</option>
                </template>

                <!--option value="residential">Residential</option-->
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  select {
    border: 1px solid gainsboro;
    border-radius: 10px;
  }
  .location__select {
    width: 100%;
    align-items: center;
    display: flex;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 20px;
    padding-bottom: 20px;
    position: relative;
  }
  .property__select {
    width: 100%;
    align-items: center;
    display: flex;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 20px;
    padding-bottom: 20px;
    position: relative;
  }
</style>
