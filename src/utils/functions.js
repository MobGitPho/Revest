import moment from 'moment'

import 'moment/dist/locale/fr'

export function removeTrailingSlash(path) {
  return path.replace(/\/$/, '')
}

export function removeLeadingSlash(path) {
  return path.replace(/^\/+/, '')
}

export function isExternal(path) {
  return /^(https?:|mailto:|tel:)/.test(path)
}

export function getBaseUrl() {
  return window.location.protocol + '//' + window.location.hostname
}

export function getPageUrl() {
  return getBaseUrl() + window.location.pathname
}

export function openWindowWithJS(
  url,
  data,
  { target = '_self', method = 'POST' } = {}
) {
  var form = document.createElement('form')
  form.target = target
  form.method = method
  form.action = url
  form.style.display = 'none'

  for (var key in data) {
    var input = document.createElement('input')
    input.type = 'hidden'
    input.name = key
    input.value = data[key]
    form.appendChild(input)
  }

  document.body.appendChild(form)
  form.submit()
  document.body.removeChild(form)
}

export function getCurrentTimestamp() {
  return Math.round(new Date() / 1000)
}

export function formatDate(
  date,
  { outPattern = 'DD MMM YYYY', locale = 'fr' } = {}
) {
  return moment(date).locale(locale).format(outPattern)
}
