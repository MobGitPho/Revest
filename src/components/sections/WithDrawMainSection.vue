<script setup>
  // section: WithDrawMainSection

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
                    <a href="investment.html">
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
                    <a href="withdraw.html" class="sidenav__active">
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
                  <h5>Withdraw</h5>
                  <div>
                    <a href="/">Home</a>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <a href="javascript:void(0)">Withdraw</a>
                  </div>
                </div>
                <div class="withdraw-funds">
                  <div class="withdraw-funds__inner">
                    <h5>Withdraw Funds</h5>
                    <p>Use the form below to withdraw from wallet instantly</p>
                    <form action="#" method="post">
                      <div class="input input--secondary">
                        <label for="withdrawAmount">Amount</label>
                        <input
                          type="number"
                          name="withdraw_amount"
                          id="withdrawAmount"
                          placeholder="100"
                          required="required" />
                      </div>
                      <div class="regi__type">
                        <label for="methodSelect">Payment Method</label>
                        <select class="type__select" id="methodSelect">
                          <option value="method">Payment Method</option>
                          <option value="paypal">Paypal</option>
                          <option value="maestro">Maestro</option>
                          <option value="visa">Visa</option>
                          <option value="express">American Express</option>
                        </select>
                      </div>
                      <button type="submit" class="button button--effect">
                        Withdraw
                      </button>
                    </form>
                  </div>
                </div>
              </div>
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

  .type__select {
    width: 100%;
    align-items: center;
    display: flex;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 20px;
    padding-bottom: 20px;
    position: relative;
  }
  option {
    cursor: pointer;
    color: #ffffff;
    background-color: #5927e3;
  }
  option:hover {
    background-color: #f6f6f6;
  }
</style>
