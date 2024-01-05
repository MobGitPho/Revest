export function useHeadWrapper() {
  const { tr, res } = useGlobal()
  const { websiteInfo, websitePicsInfo } = useInfo()

  useHead({
    title: tr(websiteInfo.value.title),
    meta: [
      {
        name: 'description',
        content: tr(websiteInfo.value.description),
      },
      {
        name: 'keywords',
        content: websiteInfo.value.metaKeys,
      },
    ],
    link: [
      {
        rel: 'icon',
        href: res(websitePicsInfo.value.favicon),
      },
    ],
  })
}
