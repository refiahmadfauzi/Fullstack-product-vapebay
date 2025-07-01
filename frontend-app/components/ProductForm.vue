<script setup lang="ts">
import { ref,computed  } from 'vue';

const config = useRuntimeConfig();
const apiUrl = `${config.public.apiBase}/products`;

// Definisikan emit untuk memberi tahu parent component
const emit = defineEmits(['productAdded']);

const newProduct = ref({
  name: '',
  description: '',
  price: 0
});
const message = ref('');

const formattedPrice = computed({
  get() {
    if (!newProduct.value.price) return '';
    return newProduct.value.price.toLocaleString('id-ID');
  },
  set(value) {
    const numericValue = parseInt(String(value).replace(/\D/g, ''), 10);
    newProduct.value.price = isNaN(numericValue) ? 0 : numericValue;
  }
});

async function addProduct() {
  try {
    await $fetch(apiUrl, {
      method: 'POST',
      body: newProduct.value
    });

    // Reset form
    newProduct.value = { name: '', description: '', price: 0 };
    message.value = 'Produk berhasil ditambahkan!';

    // Beri tahu parent untuk refresh data
    emit('productAdded');

    setTimeout(() => message.value = '', 3000);
  } catch (error) {
    message.value = 'Gagal menambahkan produk. Cek kembali data Anda.';
    console.error(error);
  }
}
</script>

<template>
  <div class="bg-white p-6 rounded-lg shadow-md mb-8">
    <h3 class="text-2xl font-bold mb-4">Tambah Produk Baru</h3>
    <form @submit.prevent="addProduct">
      <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
        <input type="text" id="name" v-model="newProduct.name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
      </div>
      <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea id="description" v-model="newProduct.description" required rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
      </div>
      <div class="mb-4">
        <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
        <input type="text" id="price"  v-model="formattedPrice"  required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
      </div>
      <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">
        Tambah
      </button>
    </form>
    <p v-if="message" class="mt-4 text-center">{{ message }}</p>
  </div>
</template>