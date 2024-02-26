<script setup>
  // section: LoginRegistrationSection
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
  const { logAccount, storeAccountData } = useLoginRegister()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('wid_1')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')

  const { register, errors, handleSubmit, isSubmitting } = useForm({
    initialValues: {
      // name: '',
      //phone: '',
      email: '',
      password: '',
      //confirmPassword: '',
    },
    onSubmit(values) {
      //isLoading.value = true
      logAccount(values)
        .then((res) => {
          console.log({ res })
          if (res) {
            storeAccountData(res)
          }
        })
        .finally(() => {
          // isLoading.value = false
        })
    },
  })

  const { value: email, attrs: emailAttrs } = register('email', {
    validate(value) {
      if (!value) return t('fieldsIsRequired')

      if (!isEmail(value)) return t('isNotEmail')
    },
  })
  const { value: password, attrs: passwordAttrs } = register('password', {
    validate(value) {
      if (!value) return t('fieldsIsRequired')
    },
  })
</script>

<template>
  <section class="registration clear__top">
    <div class="container">
      <div class="registration__area">
        <h4 class="neutral-top">{{ t('Log in') }}</h4>
        <p>
          {{ t('Do not have an account') }}?
          <a :href="getRegisterLink()" @click.prevent="openRegisterPage()"
            >{{ t('Register here') }}.</a
          >
        </p>
        <form @submit="handleSubmit" name="login__form" class="form__login">
          <div class="input input--secondary">
            <label for="loginMail">Email*</label>
            <small v-show="'email' in errors" class="field__error">
              {{ errors.email }}
            </small>
            <input
              v-model="email"
              v-bind="emailAttrs"
              type="email"
              name="login__email"
              id="loginMail"
              :placeholder="t('Enter your email')"
              required="required" />
          </div>
          <div class="input input--secondary">
            <label for="loginPass">{{ t('Password') }}*</label>
            <small v-show="'password' in errors" class="field__error">
              {{ errors.password }}
            </small>
            <input
              v-model="password"
              v-bind="passwordAttrs"
              type="password"
              name="login__pass"
              id="loginPass"
              :placeholder="t('Password')"
              required="required" />
          </div>
          <div class="checkbox login__checkbox">
            <label>
              <input
                type="checkbox"
                id="remeberPass"
                name="remeber__pass"
                value="remember" />

              <span class="checkmark"></span>
              {{ t('Remember Me') }}
            </label>
            <a href="javascript:void(0)">{{ t('Forget Password') }}</a>
          </div>
          <div class="input__button">
            <button type="submit" class="button button--effect">
              {{ t('Login') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>
<style scoped>
  .field__error {
    color: red;
    margin-bottom: 5px;
  }
</style>
