import { APP_BASE_URL } from '@/utils/constants'

import { ArticleStatus } from '@/utils/enums'

import { formatDate } from '@/utils/functions'

export function useNews() {
  const router = useRouter()

  const { tr, res, request } = useGlobal()

  const dbNewsCategoryStore = useDbNewsCategoryStore()
  const dbNewsArticleStore = useDbNewsArticleStore()
  const dbNewsCommentStore = useDbNewsCommentStore()
  const dbNewsTagStore = useDbNewsTagStore()

  const fetchArticleComments = async (id) => {
    let task = await request({
      action: 'select',
      table: 'news_comment',
      conditions: [
        {
          where: ['article', id],
        },
        {
          where: ['status', 1],
        },
        {
          descOrderBy: 'date',
        },
      ],
    })

    return task.success && task.data ? task.data : null
  }

  const fetchArticleBySlug = async (slug) => {
    let task = await request({
      action: 'select',
      table: 'news_article',
      conditions: [
        {
          where: ['slug', slug],
        },
        {
          where: ['status', ArticleStatus.PUBLISHED],
        },
        {
          where: [
            'post_datetime',
            '<=',
            formatDate(new Date(), { outPattern: 'YYYY-MM-DD HH:mm:ss' }),
          ],
        },
      ],
    })

    return task.success && task.data ? task.data[0] : null
  }

  const fetchArticleById = async (id) => {
    let task = await request({
      action: 'select',
      table: 'news_article',
      conditions: [
        {
          where: ['id', id],
        },
        {
          where: ['status', ArticleStatus.PUBLISHED],
        },
        {
          where: [
            'post_datetime',
            '<=',
            formatDate(new Date(), { outPattern: 'YYYY-MM-DD HH:mm:ss' }),
          ],
        },
      ],
    })

    return task.success && task.data ? task.data[0] : null
  }

  const fetchArticlesByQuery = async (query) => {
    let task = await request({
      action: 'select',
      table: 'news_article',
      conditions: [
        {
          where: ['status', ArticleStatus.PUBLISHED],
        },
        {
          where: [
            'post_datetime',
            '<=',
            formatDate(new Date(), { outPattern: 'YYYY-MM-DD HH:mm:ss' }),
          ],
        },
        {
          where: [
            {
              where: ['title', 'like', '%' + query + '%'],
            },
            {
              orWhere: ['summary', 'like', '%' + query + '%'],
            },
          ],
        },
      ],
    })

    return task.success && task.data ? task.data : []
  }

  const fetchLatestArticles = async (nb = 5) => {
    let task = await request({
      action: 'select',
      table: 'news_article',
      conditions: [
        {
          where: ['status', ArticleStatus.PUBLISHED],
        },
        {
          where: [
            'post_datetime',
            '<=',
            formatDate(new Date(), { outPattern: 'YYYY-MM-DD HH:mm:ss' }),
          ],
        },
        {
          limit: nb,
        },
        {
          descOrderBy: 'insert_datetime',
        },
      ],
    })

    return task.success && task.data ? task.data : []
  }

  const fetchLatestHeadlines = async (nb = 10) => {
    let task = await request({
      action: 'select',
      table: 'news_article',
      conditions: [
        {
          where: ['headline', 1],
        },
        {
          where: ['status', ArticleStatus.PUBLISHED],
        },
        {
          where: [
            'post_datetime',
            '<=',
            formatDate(new Date(), { outPattern: 'YYYY-MM-DD HH:mm:ss' }),
          ],
        },
        {
          limit: nb,
        },
        {
          descOrderBy: 'insert_datetime',
        },
      ],
    })

    return task.success && task.data ? task.data : []
  }

  const fetchArticlesByTags = async (tags, desc = true, nb = null) => {
    let list

    try {
      list = typeof tags === 'string' ? JSON.parse(tags) : tags
    } catch (e) {
      list = []
    }

    let query = {
      action: 'select',
      table: 'news_article',
      conditions: [
        {
          where: ['status', ArticleStatus.PUBLISHED],
        },
        {
          where: [
            'post_datetime',
            '<=',
            formatDate(new Date(), { outPattern: 'YYYY-MM-DD HH:mm:ss' }),
          ],
        },
        {
          where: [],
        },
      ],
    }

    list.forEach((l, i) => {
      if (i == 0)
        query.conditions[2].where.push({
          where: ['tags', 'like', '%"' + l + '"%'],
        })
      else
        query.conditions[2].where.push({
          orWhere: ['tags', 'like', '%"' + l + '"%'],
        })
    })

    if (nb && typeof nb === 'number' && nb > 0)
      query.conditions.push({ limit: nb })

    if (desc) query.conditions.push({ descOrderBy: 'insert_datetime' })
    else query.conditions.push({ orderBy: 'insert_datetime' })

    let task = await request(query)

    return task.success && task.data ? task.data : []
  }

  const fetchArticlesByCategories = async (
    categories,
    desc = true,
    nb = null
  ) => {
    let list

    try {
      list =
        typeof categories === 'string' ? JSON.parse(categories) : categories
    } catch (e) {
      list = []
    }

    let query = {
      action: 'select',
      table: 'news_article',
      conditions: [
        {
          where: ['status', ArticleStatus.PUBLISHED],
        },
        {
          where: [
            'post_datetime',
            '<=',
            formatDate(new Date(), { outPattern: 'YYYY-MM-DD HH:mm:ss' }),
          ],
        },
        {
          where: [],
        },
      ],
    }

    list.forEach((l, i) => {
      if (i == 0)
        query.conditions[2].where.push({
          where: ['categories', 'like', '%"' + l + '"%'],
        })
      else
        query.conditions[2].where.push({
          orWhere: ['categories', 'like', '%"' + l + '"%'],
        })
    })

    if (nb && typeof nb === 'number' && nb > 0)
      query.conditions.push({ limit: nb })

    if (desc) query.conditions.push({ descOrderBy: 'insert_datetime' })
    else query.conditions.push({ orderBy: 'insert_datetime' })

    let task = await request(query)

    return task.success && task.data ? task.data : []
  }

  const fetchArticlesByCategoriesAndSubCategories = async (
    categories,
    desc = true,
    nb = null
  ) => {
    let list,
      finalList = []

    try {
      list =
        typeof categories === 'string' ? JSON.parse(categories) : categories
    } catch (e) {
      list = []
    }

    list.forEach((item) => {
      if (!finalList.includes(item)) finalList.push(item)

      let children = getStructuredCategories()
        .find((category) => category.id == item)
        ?.children?.map((c) => c.id)

      if (children && children.length) {
        children.forEach((subItem) => {
          if (!finalList.includes(subItem)) finalList.push(subItem)
        })
      }
    })

    let articles = await fetchArticlesByCategories(finalList, desc, nb)

    return articles
  }

  const fetchCategoryById = async (id, desc = true) => {
    let query = {
      action: 'select',
      table: 'news_category',
      conditions: [
        {
          where: ['id', id],
        },
        {
          where: ['display', 1],
        },
      ],
    }

    if (desc) query.conditions.push({ descOrderBy: 'date' })
    else query.conditions.push({ orderBy: 'date' })

    let task = await request(query)

    return task.success && task.data ? task.data : null
  }

  const fetchArticlesById = async (ids, desc = true) => {
    let list

    try {
      list = typeof ids === 'string' ? JSON.parse(ids) : ids
    } catch (e) {
      list = []
    }

    let query = {
      action: 'select',
      table: 'news_article',
      conditions: [
        {
          whereIn: ['id', list],
        },
        {
          andWhere: ['status', ArticleStatus.PUBLISHED],
        },
        {
          andWhere: [
            'post_datetime',
            '<=',
            formatDate(new Date(), { outPattern: 'YYYY-MM-DD HH:mm:ss' }),
          ],
        },
      ],
    }

    if (desc) query.conditions.push({ descOrderBy: 'insert_datetime' })
    else query.conditions.push({ orderBy: 'insert_datetime' })

    let task = await request(query)

    return task.success && task.data ? task.data : null
  }

  const fetchCategoriesById = async (ids, desc = true) => {
    let list

    try {
      list = typeof ids === 'string' ? JSON.parse(ids) : ids
    } catch (e) {
      list = []
    }

    let query = {
      action: 'select',
      table: 'news_category',
      conditions: [
        {
          whereIn: ['id', list],
        },
        {
          andWhere: ['display', 1],
        },
      ],
    }

    if (desc) query.conditions.push({ descOrderBy: 'date' })
    else query.conditions.push({ orderBy: 'date' })

    let task = await request(query)

    return task.success && task.data ? task.data : null
  }

  const getStructuredCategories = () => {
    let parentCategories = dbNewsCategoryStore.categories
        ?.filter(
          (category) => category.parent == 0 && parseInt(category.display)
        )
        ?.sort((a, b) => a.position - b.position),
      list = []

    parentCategories.forEach((category) => {
      let clonedCategory = _.cloneDeep(category)

      clonedCategory.isParent = true

      clonedCategory.children = dbNewsCategoryStore.categories
        ?.filter(
          (subCategory) =>
            subCategory.parent == category.id && parseInt(subCategory.display)
        )
        ?.sort((a, b) => a.position - b.position)

      list.push(clonedCategory)
    })

    return list
  }

  const getCategories = (c) => {
    let parsedCategories

    try {
      parsedCategories = JSON.parse(c)
    } catch (e) {
      parsedCategories = []
    }

    return parsedCategories.map((categoryId) => {
      let category = dbNewsCategoryStore.categories?.find(
        (ct) => ct.id == categoryId
      )

      if (category) return category
      else return null
    })
  }

  const getCategoriesNames = (c) => {
    return getCategories(c).map((category) =>
      category ? tr(category.name) : ''
    )
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

  const addComment = async (name, email, content, article) => {
    let task = await request({
      action: 'insert',
      table: 'news_comment',
      data: {
        content: content,
        name: name,
        email: email,
        subscriber: 0,
        article: article,
        status: 0,
      },
    })

    return task.success
  }

  const openCategoryPage = (category) => {
    if (category) router.push(`/categorie/${category.slug}`)
  }

  const openArticlePage = (article) => {
    if (article) {
      dbNewsArticleStore.article = article

      router.push(`/article/${article.slug}`)
    }
  }

  const openTagPage = (tag) => {
    if (tag) router.push(`/etiquette/${tag.slug}`)
  }

  const getCategoryLink = (category) => {
    if (category) return `${APP_BASE_URL}/categorie/${category.slug}`
  }

  const getArticleLink = (article) => {
    if (article) return `${APP_BASE_URL}/article/${article.slug}`
  }

  const getTagLink = (tag) => {
    if (tag) return `${APP_BASE_URL}/etiquette/${tag.slug}`
  }

  return {
    parsePreviews,
    getCategories,
    getCategoriesNames,
    getStructuredCategories,
    fetchArticlesByCategories,
    fetchArticlesByCategoriesAndSubCategories,
    fetchArticleComments,
    fetchArticlesByQuery,
    fetchArticlesByTags,
    fetchArticleBySlug,
    fetchLatestHeadlines,
    fetchCategoriesById,
    fetchLatestArticles,
    fetchArticlesById,
    fetchArticleById,
    fetchCategoryById,
    openCategoryPage,
    openArticlePage,
    openTagPage,
    getCategoryLink,
    getArticleLink,
    getTagLink,
    addComment,
  }
}
