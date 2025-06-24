<template>
  <div v-if="show" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white p-6 rounded-md w-full max-w-md">
      <h2 class="text-xl font-bold mb-4">Agregar Producto</h2>
      <input v-model="product.name" type="text" placeholder="Nombre"
        class="w-full px-3 py-2 border rounded-md mb-2" required />
      <input v-model="product.price" type="number" placeholder="Precio"
        class="w-full px-3 py-2 border rounded-md mb-4" required />
      <div class="flex justify-end">
        <button @click="$emit('close')" class="bg-[#4285F4] text-white px-4 py-2 rounded-md mr-2 hover:bg-[#357ae8] transition">
          Cancelar
        </button>
        <button @click="createProduct"
          class="bg-[#F28B82] text-white px-4 py-2 rounded-md hover:bg-[#e57373] transition">
          Guardar
        </button>
      </div>
    </div>
  </div>
</template>

  
  <script>
  import axios from 'axios';
  import Swal from 'sweetalert2';
  
  export default {
    props: {
      show: Boolean,
      token: String
    },
    data() {
      return {
        product: { name: '', price: '' }
      };
    },
    methods: {
      async createProduct() {
        try {
          Swal.fire({ title: 'Guardando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
  
          await axios.post('http://localhost:8000/api/products', this.product, {
            headers: { Authorization: `Bearer ${this.token}` }
          });
  
          Swal.fire('Éxito', 'Producto agregado correctamente', 'success');
          this.$emit('refresh');
          this.$emit('close');
        } catch (error) {
          Swal.fire('Error', 'No se pudo agregar el producto', 'error');
        }
      }
    }
  };
  </script>
  