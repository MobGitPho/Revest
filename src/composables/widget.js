export function useWidget() {
  const globalStore = useGlobalStore()
  const dbWidgetStore = useDbWidgetStore()

  const widgetsJSONArray = computed(() => {
    let w = []

    _.forIn(globalStore.widgetsJSONData, function (value, key) {
      w.push(value)
    })

    return w
  })

  const uniqueWidgets = computed(() => {
    return widgetsJSONArray.value.filter((w) => !w.duplicable)
  })

  const duplicableWidgets = computed(() => {
    return widgetsJSONArray.value.filter((w) => w.duplicable)
  })

  const unpublishedWidgets = computed(() => {
    return dbWidgetStore.widgets.filter((w) => !parseInt(w.display))
  })

  const publishedWidgets = computed(() => {
    return dbWidgetStore.widgets.filter((w) => parseInt(w.display))
  })

  const getUniqueWidgetData = (wid) => {
    let widget = publishedWidgets.value.find((d) => d.wid == wid)

    if (widget) return JSON.parse(widget.data)

    return null
  }

  const getDuplicableWidgetsData = (wid) => {
    let widgets = publishedWidgets.value.filter((w) => w.wid == wid),
      widgetsData = []

    if (widgets && widgets.length) {
      widgets.forEach((widget) => {
        let w = JSON.parse(widget.data)

        w._id = widget.id

        widgetsData.push(w)
      })

      return widgetsData
    }

    return []
  }

  return {
    widgetsJSONArray,
    uniqueWidgets,
    duplicableWidgets,
    unpublishedWidgets,
    publishedWidgets,
    getUniqueWidgetData,
    getDuplicableWidgetsData,
  }
}
