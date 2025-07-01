// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-05-15',
  devtools: { enabled: true },
  runtimeConfig: {
    public: {
      apiBase: 'http://localhost:3000/api' // URL base dari API NestJS Anda
    }
  },
  devServer: {
    port: 3001 
  },
  modules: ['@nuxt/ui', '@nuxt/content', '@nuxtjs/tailwindcss']
})