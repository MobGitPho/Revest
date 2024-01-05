<script setup>
  useHeadWrapper()

  const { rHtml } = useGlobal()
  const { currentPage, sectionsArray } = usePage()

  const files = import.meta.glob('@/components/sections/**/*.vue', {
    eager: true,
  })

  let components = {}

  for (const [key, value] of Object.entries(files)) {
    var componentName = key.replace(/^\.\/(.*)\.\w+$/, '$1')

    const parts = componentName.split('/')

    const name = parts[parts.length - 1]?.split('.')[0]
    components[name] = value.default
  }
</script>

<template>
  <div v-if="currentPage" class="body">
    <template
      v-for="(section, i) in sectionsArray(currentPage.top_sections)"
      :key="'section-a-' + i">
      <component
        :is="components[section.component]"
        :id="section.id"
        :metadata="section.data"></component>
    </template>
    <template v-if="currentPage.content">
      <section v-html="rHtml(currentPage.content)" />
    </template>
    <template
      v-for="(section, i) in sectionsArray(currentPage.bottom_sections)"
      :key="'section-b-' + i">
      <component
        :is="components[section.component]"
        :id="section.id"
        :metadata="section.data"></component>
    </template>
  </div>
</template>
