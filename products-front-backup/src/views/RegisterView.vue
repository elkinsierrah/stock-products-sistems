<template>
  <div class="container-form">
    <form class="form" @submit.prevent="submitForm">
      <div class="mb-4">
        <label class="label-form" for="name"> Nombre completo </label>
        <input
          class="input-form focus:shadow-outline focus:outline-none"
          type="text"
          placeholder=""
          v-model="state.name"
          id="name"
          autocomplete="off"
        />
        <span class="error-message" v-if="v$.name.$error">
          {{ v$.name.$errors[0].$message }}
        </span>
      </div>
      <div class="mb-4">
        <label class="label-form" for="email"> Correo electrónico </label>
        <input
          class="input-form focus:shadow-outline focus:outline-none"
          type="text"
          placeholder=""
          v-model="state.email"
          id="email"
          autocomplete="off"
        />
        <span class="error-message" v-if="v$.email.$error">
          {{ v$.email.$errors[0].$message }}
        </span>
      </div>
      <div class="mb-4">
        <label class="label-form" for="password"> Contraseña </label>
        <input
          class="input-form focus:shadow-outline focus:outline-none"
          type="password"
          placeholder=""
          v-model="state.password.password"
          id="password"
          autocomplete="off"
        />
        <span class="error-message" v-if="v$.password.password.$error">
          {{ v$.password.password.$errors[0].$message }}
        </span>
      </div>
      <div class="mb-6">
        <label class="label-form" for="password-confirm">
          Confirmar contraseña
        </label>
        <input
          class="input-form focus:shadow-outline focus:outline-none"
          type="password"
          placeholder=""
          v-model="state.password.confirm"
          id="password-confirm"
          autocomplete="off"
        />
        <span class="error-message" v-if="v$.password.confirm.$error">
          {{ v$.password.confirm.$errors[0].$message }}
        </span>
      </div>
      <div class="flex items-center justify-end">
        <button
          class="submit-button focus:outline-none focus:shadow-outline"
          type="submit"
        >
          Registrarse
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import useValidate from "@vuelidate/core";
import {
  required,
  email,
  minLength,
  sameAs,
  helpers,
} from "@vuelidate/validators";
import { reactive, computed } from "vue";
import Swal from "sweetalert2";
import registerService from "@/services/registerService";
import loginService from "@/services/loginService";
import { useRouter } from "vue-router";

export default {
  setup() {
    const state = reactive({
      name: "",
      email: "",
      password: {
        password: "",
        confirm: "",
      },
    });

    const rules = computed(() => {
      return {
        name: {
          required: helpers.withMessage("El nombre es requerido", required),
        },
        email: {
          required: helpers.withMessage("El correo es requerido", required),
          email: helpers.withMessage("El correo no es válido", email),
        },
        password: {
          password: {
            required: helpers.withMessage(
              "La contraseña es requerida",
              required
            ),
            minLength: helpers.withMessage(
              "La contraseña debe tener al menos 8 caracteres",
              minLength(8)
            ),
          },
          confirm: {
            required: helpers.withMessage(
              "La confirmación de la contraseña es requerida",
              required
            ),
            sameAs: helpers.withMessage(
              "Las contraseñas no coinciden",
              sameAs(state.password.password)
            ),
          },
        },
      };
    });

    const v$ = useValidate(rules, state);
    const router = useRouter();

    return {
      state,
      v$,
      router,
    };
  },
  methods: {
    submitForm() {
      this.v$.$validate();
      if (this.v$.$error) {
        return;
      }

      Swal.fire({
        title: "Registrando...",
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        },
      });

      registerService
        .register(
          this.state.email,
          this.state.password.password,
          this.state.name
        )
        .then(() => {
          Swal.fire({
            icon: "success",
            title: "¡Registro exitoso!",
            text: "",
          }).then(() => {
            loginService
              .login(this.state.email, this.state.password.password)
              .then((response) => {
                localStorage.setItem("token", response.data.token);
                this.router.push("/products");
              })
              .catch((error) => {
                Swal.fire({
                  icon: "error",
                  title: "¡Error!",
                  text: error.response.data.message,
                });
              });
          });
        })
        .catch((error) => {
          Swal.fire({
            icon: "error",
            title: "¡Error!",
            text: error.response.data.message,
          });
        });
    },
  },
};
</script>
