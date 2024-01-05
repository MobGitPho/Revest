export function useECommerce() {
  const { tr, res, request } = useGlobal()

  const dbECommerceCategoryStore = useDbECommerceCategoryStore()
  const dbECommerceProductStore = useDbECommerceProductStore()
  const dbECommercePromoStore = useDbECommercePromoStore()
  const dbECommerceOrderStore = useDbECommerceOrderStore()

  const fetchProductsByQuery = async (query) => {
    let task = await request({
      action: 'select',
      table: 'e_commerce_product',
      conditions: [
        {
          where: ['display', 1],
        },
        {
          where: [
            {
              where: ['name', 'like', '%' + query + '%'],
            },
            {
              orWhere: ['short_description', 'like', '%' + query + '%'],
            },
            {
              orWhere: ['long_description', 'like', '%' + query + '%'],
            },
          ],
        },
      ],
    })

    return task.success && task.data ? task.data : []
  }

  const getStructuredCategories = () => {
    let parentCategories = dbECommerceCategoryStore.categories
        ?.filter(
          (category) => category.parent == 0 && parseInt(category.display)
        )
        ?.sort((a, b) => a.position - b.position),
      list = []

    parentCategories.forEach((category) => {
      let clonedCategory = _.cloneDeep(category)

      clonedCategory.isParent = true

      clonedCategory.children = dbECommerceCategoryStore.categories
        ?.filter(
          (subCategory) =>
            subCategory.parent == category.id && parseInt(subCategory.display)
        )
        ?.sort((a, b) => a.position - b.position)

      list.push(clonedCategory)
    })

    return list
  }

  const getCategoriesNames = (c) => {
    let parsedCategories

    try {
      parsedCategories = JSON.parse(c)
    } catch (e) {
      parsedCategories = []
    }

    return parsedCategories.map((categoryId) => {
      let category = dbECommerceCategoryStore.categories.value.find(
        (ct) => ct.id == categoryId
      )

      if (category) return tr(category.name)
      else return ''
    })
  }

  const parsePreviews = (p) => {
    let previews

    try {
      previews = JSON.parse(p)
    } catch (e) {
      previews = [null]
    }

    return previews.map((preview) => res(preview))
  }

  return {
    parsePreviews,
    getCategoriesNames,
    getStructuredCategories,
    fetchProductsByQuery,
  }
}
