<script setup>
  // section: LoginHeaderSection

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
    <header class="header header--secondary">
            <nav class="navbar navbar-expand-xl">
                <div class="container">
                    <a class="navbar-brand" href="index.html">
                        <img src="/assets/images/logo.png" alt="Logo" class="logo" />
                    </a>
                    <div class="navbar__out order-2 order-xl-3">
                        <div class="nav__group__btn">
                            <a href="/login" class="log d-none d-sm-block"> Log In </a>
                            <a href="/registration" class="button button--effect d-none d-sm-block"> Join Now <i
                                    class="fa-solid fa-arrow-right-long"></i> </a>
                        </div>
                        <button class="navbar-toggler d-block d-sm-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#primaryNav" aria-controls="primaryNav" aria-expanded="false"
                            aria-label="Toggle Primary Nav">
                            <span class="icon-bar top-bar"></span>
                            <span class="icon-bar middle-bar"></span>
                            <span class="icon-bar bottom-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse order-3 order-xl-2" id="primaryNav">
                        <ul class="navbar-nav">
                            <li class="nav-item d-block d-sm-none">
                                <a href="/login" class="nav-link">Log In</a>
                            </li>
                            <li class="nav-item d-block d-sm-none">
                                <a href="/registration" class="button button--effect button--last">Join Now <i
                                        class="fa-solid fa-arrow-right-long"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
  </section>
</template>