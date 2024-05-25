export function usePageHeader() {
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

  return {
    productIndexHeader,
    productCreateHeader,
  }
}
