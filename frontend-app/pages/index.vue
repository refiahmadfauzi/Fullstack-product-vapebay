<script setup lang="ts">
import { ref, computed } from 'vue';

// Definisikan tipe data produk
interface Product {
  id: string;
  name: string;
  description: string;
  price: number;
}

const config = useRuntimeConfig();
const apiUrl = `${config.public.apiBase}/products`;

// State untuk data dan fungsionalitas
const searchQuery = ref('');
const currentPage = ref(1);
const itemsPerPage = ref(8);

// Ambil data produk dari API 
const { data: products, pending, error, refresh } = await useFetch<Product[]>(apiUrl, {
    default: () => []
});

// Fungsi Pencarian (client-side) 
const filteredProducts = computed(() => {
  if (!products.value) return [];
  return products.value.filter(product =>
    product.name.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

// Logika Paginasi 
const totalPages = computed(() => {
  return Math.ceil(filteredProducts.value.length / itemsPerPage.value);
});

const paginatedProducts = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value;
  const end = start + itemsPerPage.value;
  return filteredProducts.value.slice(start, end);
});

function nextPage() {
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
  }
}

function prevPage() {
  if (currentPage.value > 1) {
    currentPage.value--;
  }
}

function formatRupiah(price: number): string {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0 // Tidak menampilkan desimal untuk Rupiah
  }).format(price);
}
</script>

<template>
  <div class="container mx-auto p-6">
    <ProductForm @productAdded="refresh" />
    <div class="mb-6">
      <input 
        type="text" 
        v-model="searchQuery" 
        placeholder="Cari produk..." 
        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
      />
    </div>

    <div v-if="pending" class="text-center">Loading...</div>
    <div v-else-if="error" class="text-center text-red-500">Gagal memuat data.</div>

    <div v-else class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <div v-for="product in paginatedProducts" :key="product.id" class="bg-white rounded-lg shadow-md p-6 flex flex-col">
            <h2 class="text-xl font-semibold mb-2">{{ product.name }}</h2>
            
            <p class="text-gray-600 mb-4 flex-grow">
            {{ product.description.length > 100 ? product.description.substring(0, 100) + '...' : product.description }}
            </p>
            
            <div class="text-lg font-bold text-blue-600 mt-auto">
            {{ formatRupiah(product.price) }}
            </div>
        </div>
    </div>

    <div class="mt-8 flex justify-center items-center space-x-4">
      <button @click="prevPage" :disabled="currentPage === 1" class="px-4 py-2 bg-blue-500 text-white rounded disabled:bg-gray-300">
        Sebelumnya
      </button>
      <span>Halaman {{ currentPage }} dari {{ totalPages }}</span>
      <button @click="nextPage" :disabled="currentPage === totalPages" class="px-4 py-2 bg-blue-500 text-white rounded disabled:bg-gray-300">
        Berikutnya
      </button>
    </div>
  </div>
</template>