<template>
    <div class="max-w-4xl mx-auto p-4 bg-sky-100 min-h-screen">
      <h1 class="text-2xl font-semibold text-sky-700 text-center mb-6">Gestión de Stock de Productos Boutique "El BUEN VESTIR"</h1>
  
      <!-- Botón para agregar producto -->
      <button @click="showCreateModal = true"
        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 mb-4">
        + Agregar Producto
      </button>
  
      <!-- Tabla de Productos -->
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
          <thead class="bg-sky-400 text-white rounded-t-lg">
            <tr>
              <th class="py-2 px-4 text-left">ID</th>
              <th class="py-2 px-4 text-left">Nombre</th>
              <th class="py-2 px-4 text-left">Precio</th>
              <th class="py-2 px-4 text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in products" :key="product.id" class="border-t">
              <td class="py-2 px-4">{{ product.id }}</td>
              <td class="py-2 px-4">{{ product.name }}</td>
              <td class="py-2 px-4">{{ product.price }}</td>
              <td class="py-2 px-4 text-center">
                <button @click="editProduct(product)"
                  class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 mx-1">
                  Editar
                </button>
                <button @click="confirmDelete(product.id)"
                  class="bg-red-300 text-white px-3 py-1 rounded-md hover:bg-red-500">
                  Eliminar
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Paginación -->
      <div class="flex justify-center mt-4 space-x-2">
        <button v-if="pagination.prev_page_url" @click="fetchProducts(pagination.current_page - 1)"
          class="bg-gray-500 text-white px-3 py-1 rounded-md hover:bg-gray-600">
          Anterior
        </button>
        <span class="px-3 py-1 text-gray-700">Página {{ pagination.current_page }} de {{ pagination.last_page }}</span>
        <button v-if="pagination.next_page_url" @click="fetchProducts(pagination.current_page + 1)"
          class="bg-gray-500 text-white px-3 py-1 rounded-md hover:bg-gray-600">
          Siguiente
        </button>
      </div>
  
      <!-- Modales -->
      <CreateProductModal :show="showCreateModal" :token="token" @refresh="fetchProducts" @close="showCreateModal = false" />
      <EditProductModal :show="showEditModal" :token="token" :productData="selectedProduct" @refresh="fetchProducts" @close="showEditModal = false" />
      <ConfirmDeleteModal :show="showDeleteModal" :token="token" :productId="selectedProductId" @refresh="fetchProducts" @close="showDeleteModal = false" />
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import Swal from 'sweetalert2';
  import CreateProductModal from '../components/CreateProductModal.vue';
  import EditProductModal from '../components/EditProductModal.vue';
  import ConfirmDeleteModal from '../components/ConfirmDeleteModal.vue';
  
  export default {
    components: { CreateProductModal, EditProductModal, ConfirmDeleteModal },
    data() {
      return {
        products: [],
        pagination: {
          current_page: 1,
          last_page: 1,
          prev_page_url: null,
          next_page_url: null
        },
        token: localStorage.getItem('token') || '',
        showCreateModal: false,
        showEditModal: false,
        showDeleteModal: false,
        selectedProduct: null,
        selectedProductId: null
      };
    },
    methods: {
      async fetchProducts(page = 1) {
        try {
          Swal.fire({ title: 'Cargando productos...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
  
          const response = await axios.get(`http://localhost:8000/api/products?page=${page}`, {
            headers: { Authorization: `Bearer ${this.token}` }
          });
  
          this.products = response.data.data;
          this.pagination = {
            current_page: response.data.current_page,
            last_page: response.data.last_page,
            prev_page_url: response.data.prev_page_url,
            next_page_url: response.data.next_page_url
          };
  
          Swal.close();
        } catch (error) {
          Swal.fire('Error', 'No se pudo obtener los productos. Redirigiendo a login...', 'error');
          localStorage.removeItem('token');
          this.$router.push('/login');
        }
      },
      editProduct(product) {
        this.selectedProduct = product;
        this.showEditModal = true;
      },
      confirmDelete(productId) {
        this.selectedProductId = productId;
        this.showDeleteModal = true;
      }
    },
    mounted() {
      this.fetchProducts();
    }
  };
  </script>
  