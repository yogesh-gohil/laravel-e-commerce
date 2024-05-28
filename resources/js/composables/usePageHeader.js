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

  return {
    productIndexHeader,
    productCreateHeader,
    productEditHeader,
    categoryIndexHeader,
    categoryCreateHeader,
    categoryEditHeader,
  }
}
