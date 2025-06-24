<template>
  <div v-if="show" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white p-6 rounded-md w-full max-w-md">
      <h2 class="text-xl font-bold mb-4 text-center">¿Eliminar Producto?</h2>
      <p class="text-center text-gray-700 mb-4">¿Seguro que deseas eliminar este producto?</p>
      <div class="flex justify-center">
        <!-- Botón Cancelar con diseño azul -->
        <button
          @click="$emit('close')"
          class="bg-[#448AFF] text-white px-4 py-2 rounded-md mr-2 hover:bg-blue-600 transition duration-300"
        >
          Cancelar
        </button>
        <!-- Botón Eliminar con rosado claro -->
        <button
          @click="confirmDelete"
          class="bg-[#FF9E9E] text-white px-4 py-2 rounded-md hover:bg-red-500 transition duration-300"
        >
          Eliminar
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
      productId: Number,
      token: String
    },
    methods: {
      async confirmDelete() {
        try {
          Swal.fire({ title: 'Eliminando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
  
          await axios.delete(`http://localhost:8000/api/products/${this.productId}`, {
            headers: { Authorization: `Bearer ${this.token}` }
          });
  
          Swal.fire('Eliminado', 'El producto ha sido eliminado.', 'success');
          this.$emit('refresh');
          this.$emit('close');
        } catch (error) {
          Swal.fire('Error', 'No se pudo eliminar el producto. Redirigiendo a login...', 'error');
          localStorage.removeItem('token');
          this.$router.push('/login');
        }
      }
    }
  };
  </script>
  