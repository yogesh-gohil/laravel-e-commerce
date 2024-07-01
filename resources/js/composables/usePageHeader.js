export function usePageHeader() {
// Category Headers
  const categoryIndexHeader = {
    title: 'Categories',
    breadcrumb: [
      { label: 'Categories', route: '/categories' },
    ],
  }

  const categoryCreateHeader = {
    title: 'New Category',
    breadcrumb: [
      { label: 'Categories', route: '/categories' },
      { label: 'Create', route: '/categories/create' },
    ],
  }

  const categoryEditHeader = (category) => {
    return {
      title: 'Edit Category',
      breadcrumb: [
        { label: 'Categories', route: '/categories' },
        { label: 'Edit', route: `/categories/${category.id}/edit` },
        { label: category.name, route: '#' },
      ],
    }
  }
  // Product Header
  const productIndexHeader = {
    title: 'Products',
    breadcrumb: [
      { label: 'Products', route: '/products' },
    ],
  }

  const productCreateHeader = {
    title: 'New Product',
    breadcrumb: [
      { label: 'Products', route: '/products' },
      { label: 'Create', route: '/products/create' },
    ],
  }

  const productEditHeader = (product) => {
    return {

      title: 'Edit Product',
      breadcrumb: [
        { label: 'Products', route: '/products' },
        { label: 'Edit', route: `/products/${product.id}/edit` },
        { label: product.name, route: '#' },
      ],
    }
  }
  // Banner Headers
  const bannerIndexHeader = {
    title: 'Banners',
    breadcrumb: [
      { label: 'Banners', route: '/banners' },
    ],
  }
  const bannerCreateHeader = {
    title: 'New Banner',
    breadcrumb: [
      { label: 'Banners', route: '/banners' },
      { label: 'Create', route: '/banners/create' },
    ],
  }

  const bannerEditHeader = (banner) => {
    return {

      title: 'Edit Banner',
      breadcrumb: [
        { label: 'Banners', route: '/banners' },
        { label: 'Edit', route: `/banners/${banner.id}/edit` },
        { label: banner.name, route: '#' },
      ],
    }
  }

  return {
    productIndexHeader,
    productCreateHeader,
    productEditHeader,
    categoryIndexHeader,
    categoryCreateHeader,
    categoryEditHeader,
    bannerIndexHeader,
    bannerCreateHeader,
    bannerEditHeader,
  }
}
