
<template>
  <div class="welcome-container">
    <h1>Bienvenido a StockProducts Boutique "EL Buen Vestir"</h1>
    <p>Gestiona tus productos de forma rápida y segura.</p>
    <p>Inicia tu Sesion o registra un nuevo usuario.</p>
  </div>
</template>

<style scoped>
.welcome-container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 80vh; /* Centrado vertical con algo de margen superior e inferior */
  text-align: center;
  padding: 1rem;
  background-color: #e0f7ff; /* Azul cielo claro */
  border-radius: 8px;
  margin: 2rem;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.welcome-container h1 {
  font-size: 2rem;
  color: #007acc; /* Azul más fuerte para contraste */
  margin-bottom: 1rem;
}

.welcome-container p {
  font-size: 1.2rem;
  color: #333;
  max-width: 600px;
}
</style>