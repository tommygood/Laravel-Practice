<script setup>
import { ref, onMounted } from 'vue'

const products = ref([])
const api = import.meta.env.VITE_API; // Get API URL from environment variables
const products_api = `${api}/products`;

const fetchProducts = async () => {
  try {
    const response = await fetch(products_api);
    if (!response.ok) throw new Error('Failed to fetch products');
    const data = await response.json();
    console.log(data);
    products.value = data; // ✅ Update reactive state
  } catch (error) {
    console.error('Error fetching products:', error);
  }
};

async function createProduct() {
  const name = document.getElementById('name').value;
  const price = document.getElementById('price').value;
  const res1 = await fetch(products_api, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json", // Important to prevent Laravel from redirecting
    },
    body: JSON.stringify({name, price}),
    credentials: 'include', // Required if supports_credentials is true
  });
  const msg1 = await res1.text(); // Get API error response

  console.log(name, price, res1, msg1, products_api);
}

// Fetch products when the component is mounted
onMounted(fetchProducts);
</script>

<template>
  <div class="products">
    <h2>Product List</h2>
    <ul>
      <li v-for="product in products" :key="product.id">
        <strong>{{ product.name }}</strong> - ${{ product.price }}
      </li>
    </ul>
    <h2>Create a Product</h2>
    name : <input id="name"/><br/>
    price : <input id="price"/>
    <button @click="createProduct">send</button>
  </div>
</template>

<style scoped>
.products {
  padding: 20px;
}
ul {
  list-style: none;
  padding: 0;
}
li {
  padding: 10px;
  border-bottom: 1px solid #ddd;
}
</style>

