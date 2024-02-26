<script setup>
  // section: RegistrationPageSection
  import { useForm } from '@vorms/core'
  import { isEmail } from 'validator'
  import useLoginRegister from '../../composables/login-register'
  const { t } = useI18n()
  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res } = useGlobal()
  const {
    openLoginPage,
    getLoginLink,
    openRegisterPage,
    getRegisterLink,
    getkeyRiskLink,
    openkeyRiskPage,
  } = useNews()

  const { registerAccount, storeAccountData } = useLoginRegister()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('wid_1')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')

  const { register, errors, handleSubmit, isSubmitting } = useForm({
    initialValues: {
      name: '',
      firstname: '',
      // phone: '',
      email: '',
      password: '',
      confirmPassword: '',
    },
    onSubmit(values) {
      console.log({values})
      registerAccount(values)
    },
  })

  const { value: name, attrs: nameAttrs } = register('name', {
    validate(value) {
      if (!value) return t('fieldsIsRequired')
    },
  })

  const { value: firstname, attrs: firstnameAttrs } = register('firstname', {
    validate(value) {
      console.log({value})
      if (!value) return t('fieldsIsRequired')
    },
  })

  // const { value: phone, attrs: phoneAttrs } = register('phone', {
  //   validate(value) {
  //     console.log({value})
  //     if (!value) return t('fieldsIsRequired')
  //   },
  // })

  const { value: email, attrs: emailAttrs } = register('email', {
    validate(value) {
      console.log({value})
      if (!value) return t('fieldsIsRequired')

      if (!isEmail(value)) return t('isNotEmail')
    },
  })

  const { value: password, attrs: passwordAttrs } = register('password', {
    validate(value) {
      console.log({value})
      if (!value) return t('fieldsIsRequired')
    },
  })

  const { value: confirmPassword, attrs: confirmPasswordAttrs } = register(
    'confirmPassword',
    {
      validate(value) {
        console.log({value})
        if (!value) return t('fieldsIsRequired')
        if (value != password.value) return t('passwordDontMatch')
      },
    }
  )
</script>

<template>
  <div
    class="wrapper bg__img"
    :style="`background:url('/assets/images/registration-bg.png')`">
    <LoginHeaderSection />
    <section class="registration clear__top">
      <div class="container">
        <div class="registration__area">
          <h4 class="neutral-top">{{ t('Registration') }}</h4>
          <p>
            {{ t('Already Registered') }}?
            <a :href="getLoginLink()" @click.prevent="openLoginPage()">{{
              t('Login')
            }}</a>
          </p>
          <form name="registration__form">
            <!-- div class="regi__type">
              <label for="typeSelect">{{ t('You are') }}?</label>
              <select class="type__select" id="typeSelect">
                <option value="particular">Particular</option>
                <option value="individual">Individual</option>
              </select>
            </div> -->
            <div class="row">
              <div class="col-sm-6">
                <div class="input input--secondary">
                  <label for="firstName">{{ t('First Name') }}*</label>
                  <small v-show="'firstname' in errors" class="field__error">
                    {{ errors.name }}
                  </small>
                  <input
                    v-model="firstname"
                    v-bind="firstnameAttrs"
                    type="text"
                    name="first__name"
                    id="firstName"
                    :placeholder="t('First Name')"
                    />
                </div>
              </div>
              <div class="col-sm-6">
                <div class="input input--secondary">
                  <label for="lastName">{{ t('Last Name') }}*</label>
                  <small v-show="'name' in errors" class="field__error">
                    {{ errors.name }}
                  </small>
                  <input
                    v-model="name"
                    v-bind="nameAttrs"
                    type="text"
                    name="last__name"
                    id="lastName"
                    :placeholder="t('Last Name')"
                    />
                </div>
              </div>
            </div>
            <div class="input input--secondary">
              <label for="registrationMail">Email*</label>
              <small v-show="'email' in errors" class="field__error">
                {{ errors.email }}
              </small>
              <input
                v-model="email"
                v-bind="emailAttrs"
                type="email"
                name="registration__email"
                id="registrationMail"
                :placeholder="t('Enter your email')"
                />
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="input input--secondary">
                  <label for="regiPass">{{ t('Password') }}*</label>
                  <small v-show="'password' in errors" class="field__error">
                    {{ errors.password }}
                  </small>
                  <input
                    v-model="password"
                    v-bind="passwordAttrs"
                    type="password"
                    name="regi__pass"
                    id="regiPass"
                    :placeholder="t('Password')"
                    />
                </div>
              </div>
              <div class="col-sm-6">
                <div class="input input--secondary">
                  <label for="passCon">{{ t('Password Confirmation') }}*</label>
                  <small
                    v-show="'confirmPassword' in errors"
                    class="field__error">
                    {{ errors.confirmPassword }}
                  </small>
                  <input
                    v-model="confirmPassword"
                    v-bind="confirmPasswordAttrs"
                    type="password"
                    name="pass__con"
                    id="passCon"
                    :placeholder="t('Password Confirm')"
                    />
                </div>
              </div>
            </div>
            <div class="checkbox">
              <label>
                <input
                  type="checkbox"
                  id="condtion"
                  name="accept__condition"
                  value="agree" />
                <span class="checkmark"></span>
                {{ t('I have read and I agree to the') }}
                <a :href="getkeyRiskLink()" @click.prevent="openkeyRiskPage()">
                  {{ t('Privacy Policy') }}</a
                >
              </label>
            </div>
            <div class="input__button">
              <button type="button" class="button button--effect" @click.prevent="handleSubmit">
                {{ t('Create My Account') }}
              </button>
            </div>
            <div class="result"></div>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>
<style scoped>
  select {
    width: 100%;
    border-radius: 10px;
    border: 1px solid #c3c7e4;
    margin-bottom: 20px;
  }
  .type__select {
    align-content: center;
    padding: 20px;
  }
  .field__error {
    color: red;
    margin-top: 1px;
  }
</style>
