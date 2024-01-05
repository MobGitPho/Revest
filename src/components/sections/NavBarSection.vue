<script setup>
// section: NavBarSection
import { MenuLocations } from '@/utils/enums'

const { t } = useI18n()

const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
const { websiteInfo } = useInfo()
const { tr, res } = useGlobal()
const { currentParentMenuItems, open } = useMenu()
// Get unique widget
const uniqueWidget = getUniqueWidgetData('wid_1')

// Get duplicable widgets
const duplicableWidgets = getDuplicableWidgetsData('wid_2')
</script>

<template>
    <section>
        <!-- Put your section template code here -->
        <header class="header">
            <nav class="navbar navbar-expand-xl">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="/assets/images/logo.png" alt="Logo" class="logo" />
                    </a>
                    <div class="navbar__out order-2 order-xl-3">
                        <div class="nav__group__btn">
                            <a href="/login" class="log d-none d-sm-block"> Log In </a>
                            <a href="/registration" class="button button--effect d-none d-sm-block"> Join Now <i
                                    class="fa-solid fa-arrow-right-long"></i> </a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primaryNav"
                            aria-controls="primaryNav" aria-expanded="false" aria-label="Toggle Primary Nav">
                            <span class="icon-bar top-bar"></span>
                            <span class="icon-bar middle-bar"></span>
                            <span class="icon-bar bottom-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse order-3 order-xl-2" id="primaryNav">
                        <ul class="navbar-nav">
                            <li  
                            v-for="parentMenuItem in currentParentMenuItems( MenuLocations.HEADER )" :key="'menu-' + parentMenuItem.id" 
                            class="nav-item "
                            @click.prevent="open(parentMenuItem)">
                                <a 
                                id="navbarHomeDropdown"
                                class="nav-link " href="javascript:void(0)" 
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ tr(parentMenuItem.name) }}
                                </a>
                                <!--ul class="dropdown-menu" aria-labelledby="navbarHomeDropdown">
                                    <li><a class="dropdown-item" href="#">Home</a></li>
                                    <li><a class="dropdown-item" href="index-two.html">Home Two</a></li>
                                    <li><a class="dropdown-item" href="index-three.html">Home Three</a></li>
                                </ul-->
                            </li>
                            <!--li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarPropertyDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Properties
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarPropertyDropdown">
                                    <li><a class="dropdown-item" href="properties.html">Properties</a></li>
                                    <li><a class="dropdown-item" href="property-details.html">Property Details</a></li>
                                    <li><a class="dropdown-item" href="property-alert.html">Property Alert</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarLoanDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Loan
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarLoanDropdown">
                                    <li><a class="dropdown-item" href="business-loan.html">Business Loan</a></li>
                                    <li><a class="dropdown-item" href="business-loan-details.html">Business Loan Details</a>
                                    </li>
                                    <li><a class="dropdown-item" href="loan-application.html">Loan Application</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="list-your-property.html">List your property</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pages
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="dashboard.html">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="about-us.html">About Us</a></li>
                                    <li><a class="dropdown-item" href="affiliate-program.html">Affiliate Program</a></li>
                                    <li><a class="dropdown-item" href="blog.html">Blog</a></li>
                                    <li><a class="dropdown-item" href="blog-two.html">Blog Two</a></li>
                                    <li><a class="dropdown-item" href="blog-single.html">Blog Single</a></li>
                                    <li><a class="dropdown-item" href="career.html">Career</a></li>
                                    <li><a class="dropdown-item" href="career-details.html">Career Details</a></li>
                                    <li><a class="dropdown-item" href="how-it-works.html">How It Works</a></li>
                                    <li><a class="dropdown-item" href="key-risks.html">Key Risks</a></li>
                                    <li><a class="dropdown-item" href="loyality-program.html">Loyality Program</a></li>
                                    <li><a class="dropdown-item" href="terms-conditions.html">Terms Conditions</a></li>
                                    <li><a class="dropdown-item" href="privacy-policy.html">Privacy Policy</a></li>
                                    <li><a class="dropdown-item" href="cookie-policy.html">Cookie Policy</a></li>
                                    <li><a class="dropdown-item" href="support.html">Support</a></li>
                                    <li><a class="dropdown-item" href="404.html">Error</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact-us.html">Contact</a>
                            </li>
                            <li class="nav-item d-block d-sm-none">
                                <a href="login.html" class="nav-link">Log In</a>
                            </li>
                            <li class="nav-item d-block d-sm-none">
                                <a href="registration.html" class="button button--effect button--last">Join Now <i
                                        class="fa-solid fa-arrow-right-long"></i></a>
                            </li-->
                            <!--li 
                            v-for="parentMenuItem in currentParentMenuItems(
                                MenuLocations.HEADER
                            )" :key="'menu-' + parentMenuItem.id" style="cursor: pointer"
                                @click.prevent="open(parentMenuItem)">
                                <a>{{ tr(parentMenuItem.name) }}</a>
                            </li-->

                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    </section>
</template>