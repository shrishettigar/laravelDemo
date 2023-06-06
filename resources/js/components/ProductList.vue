<template>
    <div>
      <h2>Product Listing</h2>
      <div class="filters">
        <label>Filter by Category:</label>
        <select v-model="selectedCategory">
          <option value="">All</option>
          <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
        </select>
      </div>
      <div class="filters">
        <label>Sort by:</label>
        <select v-model="selectedSort">
          <option value="name">Product Name</option>
          <option value="price">Price</option>
        </select>
      </div>
      <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Availability</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in filteredProducts" :key="product.id">
            <td>{{ product.name }}</td>
            <td>{{ product.category.name }}</td>
            <td>{{ product.price }}</td>
            <td>{{ product.is_available ? 'In Stock' : 'Out of Stock' }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        products: [],
        selectedCategory: '',
        selectedSort: 'name',
        categories: []
      };
    },
    mounted() {
        // Fetch products and categories from the API
        this.fetchProducts();
        this.fetchCategories();
    },
    methods: {
        //API call to Fetch Products
        fetchProducts() {
            axios.get('api/products')
            .then(response => {
            this.products = response.data;
            })
            .catch(error => {
            console.error(error);
            });
        },
         //API call to Fetch Categories
        fetchCategories() {
            axios.get('api/categories')
            .then(response => {
            this.categories = response.data;
            })
            .catch(error => {
            console.error(error);
            });
        },
    },
    computed: {
     //Filter function to get products for selected category and sort products on name and price
      filteredProducts() {
        let filtered = this.products;
        
        if (this.selectedCategory) {
          filtered = filtered.filter(product => product.category_id === this.selectedCategory);
        }
        
        if (this.selectedSort === 'name') {
          filtered.sort((a, b) => a.name.localeCompare(b.name));
        } else if (this.selectedSort === 'price') {
          filtered.sort((a, b) => a.price - b.price);
        }
        
        return filtered;
      }
    }
  };
  </script>
  
  <style>
  table {
    width: 100%;
    border-collapse: collapse;
  }
  
  th,
  td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  
  th {
    background-color: #f2f2f2;
  }
  
  .filters {
    margin-bottom: 10px;
  }
  </style>
  