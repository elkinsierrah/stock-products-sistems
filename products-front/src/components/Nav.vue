<template>
  <nav class="navbar bg-sky-400">
    <div class="mx-6 flex justify-evenly sm:justify-end">
      <RouterLink
        v-if="getCurrentPath() == '/register' || getCurrentPath() == '/'"
        to="/login"
        class="button-nav"
      >
        Iniciar sesión
      </RouterLink>
      <RouterLink
        v-if="getCurrentPath() == '/login' || getCurrentPath() == '/'"
        to="/register"
        class="button-nav"
      >
        Registrarse
      </RouterLink>
      <button
        v-if="getCurrentPath() == '/products'"
        @click="logout"
        class="button-nav"
      >
        Cerrar sesión
      </button>
    </div>
  </nav>
</template>

<script setup>
import { useRoute } from "vue-router";
import { useRouter } from "vue-router";
import logoutService from "@/services/logoutService";

const route = useRoute();
const router = useRouter();

const getCurrentPath = () => {
  return route.path;
};

async function logout() {
  await logoutService.logout();
  localStorage.removeItem("token");
  router.push("/login");
}
</script>

<style scoped>
.button-nav {
  @apply inline-block 
        mx-4 
        text-sm 
        px-4 
        py-2 
        leading-none 
        border 
        rounded 
        text-white 
        border-white 
        hover:border-transparent 
        hover:text-sky-500 
        hover:bg-white my-2;
}
</style>
