<script setup>
  // section: InvestmentMainSection
  import DashboardSideNavSection from './DashboardSideNavSection.vue'
  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res } = useGlobal()

  const isOpen = ref(false)

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('wid_1')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')
</script>

<template>
  <section>
    <!-- Put your section template code here -->
    <div class="dashboard section__space__bottom">
      <div class="container">
        <div class="dashboard__area">
          <div class="row">
            <!--div class="col-xxl-3">
              <div class="sidebar">
                <a href="javascript:void(0)" class="close__sidebar">
                  <i class="fa-solid fa-xmark"></i>
                </a>
                <div class="sidenav__wrapper">
                  <ul>
                    <li>
                      <a href="dashboard.html">
                        <img src="assets/images/icons/dashboard.png" alt="Dashboard" /> Dashboard
                      </a>
                    </li>
                    <li>
                      <a href="investment.html" class="sidenav__active">
                        <img src="assets/images/icons/investments.png" alt="Investments" />
                        Investments
                      </a>
                    </li>
                    <li>
                      <a href="transaction.html">
                        <img src="assets/images/icons/transactions.png" alt="Transactions" />
                        Transactions
                      </a>
                    </li>
                    <li>
                      <a href="withdraw.html">
                        <img src="assets/images/icons/withdraw.png" alt="Withdraw" /> Withdraw
                      </a>
                    </li>
                    <li>
                      <a href="account.html">
                        <img src="assets/images/icons/account.png" alt="Account" /> Account
                      </a>
                    </li>
                  </ul>
                  <hr />
                  <ul class="logout">
                    <li>
                      <a href="login.html">
                        <img src="assets/images/icons/logout.png" alt="Logout" /> Logout
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="sidenav__wrapper sidenav__footer">
                  <h6>Last Login</h6>
                  <hr />
                  <div class="sidenav__time">
                    <p class="secondary"><img src="assets/images/icons/calendar.png" alt="Calendar" />
                      02.01.2022</p>
                    <p class="secondary">15:48:13</p>
                  </div>
                </div>
              </div>
            </div-->

            <DashboardSideNavSection v-model:sideState="isOpen" />
            <div class="col-xxl-9">
              <div class="main__content">
                <div class="collapse__sidebar">
                  <h4>Dashboard</h4>
                  <a
                    href="javascript:void(0)"
                    class="collapse__sidebar__btn"
                    @click="isOpen = !isOpen">
                    <i class="fa-solid fa-bars-staggered"></i>
                  </a>
                </div>
                <div class="main__content-dashboard">
                  <div class="breadcrumb-dashboard">
                    <h5>Investments</h5>
                    <div>
                      <a href="/">Home</a>
                      <i class="fa-solid fa-arrow-right-long"></i>
                      <a href="javascript:void(0)">Investments</a>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-8">
                      <div class="investment-table">
                        <div class="intro">
                          <h5>Transactions</h5>
                        </div>
                        <div class="table-wrapper">
                          <table>
                            <tr>
                              <th>Project</th>
                              <th>Amount Invested</th>
                              <th>Date Invested</th>
                            </tr>
                            <tr>
                              <td>
                                <img
                                  src="/assets/images/table-img.png"
                                  alt="Investment" />
                                A19, Vilnius
                              </td>
                              <td>$500.00</td>
                              <td>18.03.2022</td>
                            </tr>
                            <tr>
                              <td>
                                <img
                                  src="/assets/images/table-img.png"
                                  alt="Investment" />
                                A19, Vilnius
                              </td>
                              <td>$500.00</td>
                              <td>18.03.2022</td>
                            </tr>
                            <tr>
                              <td>
                                <img
                                  src="/assets/images/table-img.png"
                                  alt="Investment" />
                                A19, Vilnius
                              </td>
                              <td>$500.00</td>
                              <td>18.03.2022</td>
                            </tr>
                            <tr>
                              <td>
                                <img
                                  src="/assets/images/table-img.png"
                                  alt="Investment" />
                                A19, Vilnius
                              </td>
                              <td>$500.00</td>
                              <td>18.03.2022</td>
                            </tr>
                            <tr>
                              <td>
                                <img
                                  src="/assets/images/table-img.png"
                                  alt="Investment" />
                                A19, Vilnius
                              </td>
                              <td>$500.00</td>
                              <td>18.03.2022</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="investment-sidebar">
                        <div class="statistics">
                          <h5>Statistics</h5>
                          <hr />
                          <div class="group">
                            <img
                              src="/assets/images/icons/wallet.png"
                              alt="Wallet" />
                            <div>
                              <h4>€537,00</h4>
                              <p>Monthly Income</p>
                            </div>
                          </div>
                        </div>
                        <div class="explore">
                          <img
                            src="/assets/images/icons/explore.png"
                            alt="Explore" />
                          <div class="group">
                            <h6>Explore More</h6>
                            <p class="secondary">Investment opportunities</p>
                            <a
                              href="/registration"
                              class="button button--effect"
                              >Explore</a
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="dashboard-single__box investment-single-box">
                    <div class="intro">
                      <h5 class="investo">Investment Chart</h5>
                      <a href="#">Generate Report</a>
                    </div>
                    <div id="investmentChartTwo"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
