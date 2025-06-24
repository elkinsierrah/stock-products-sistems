<template>
  <div class="min-h-screen bg-[#dff3ff] flex flex-col">
    <!-- Contenido centrado -->
    <div class="flex-1 flex items-center justify-center">
      <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Iniciar sesión</h2>
        <form @submit.prevent="login">
          <label class="block mb-2 font-medium">Correo electrónico</label>
          <input type="email" v-model="email" required
            class="w-full p-2 border rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-[#3ec4ff]" />

          <label class="block mb-2 font-medium">Contraseña</label>
          <input type="password" v-model="password" required
            class="w-full p-2 border rounded-md mb-6 focus:outline-none focus:ring-2 focus:ring-[#3ec4ff]" />

          <button type="submit"
            class="bg-[#3ec4ff] hover:bg-[#30b7f0] text-white font-semibold py-2 px-4 rounded w-full">
            Iniciar sesión
          </button>
        </form>
      </div>
    </div>
  </div>
</template>


<script setup>
import loginService from "@/services/loginService";
import { useRouter } from "vue-router";
import Swal from "sweetalert2";
import { ref, onMounted } from "vue";

const router = useRouter();
const email = ref("");
const password = ref("");

onMounted(() => {
  if (localStorage.getItem("token")) {
    router.push("/products");
  }
});

async function login() {
  Swal.fire({
    title: "Iniciando sesión",
    didOpen: () => {
      Swal.showLoading();
    },
    allowOutsideClick: false,
  });

  const response = await loginService.login(email.value, password.value);

  Swal.close();

  if (response.status === 200) {
    localStorage.setItem("token", response.data.token);
    router.push("/products");
  } else {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: response.data.message,
    });
  }
}
</script>

<style scoped>
body {
  background-color: #f4f6f8;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.container-form {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 80vh;
}

.form {
  background: #ffffff;
  padding: 2.5rem;
  border-radius: 1rem;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
}

.label-form {
  display: block;
  font-weight: 600;
  color: #333;
  margin-bottom: 0.5rem;
}

.input-form {
  width: 100%;
  padding: 0.75rem 1rem;
  border: 1px solid #ccc;
  border-radius: 0.5rem;
  font-size: 1rem;
  transition: border 0.3s ease;
}

.input-form:focus {
  border-color: #00b894;
  box-shadow: 0 0 0 3px rgba(0, 184, 148, 0.2);
}

.submit-button {
  background-color: #0984e3;
  color: white;
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 0.5rem;
  font-weight: 600;
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.submit-button:hover {
  background-color: #74b9ff;
}

@media (max-width: 480px) {
  .form {
    padding: 1.5rem;
  }
}
</style>
