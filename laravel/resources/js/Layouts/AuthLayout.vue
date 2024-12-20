<template>
    <div class="auth-layout">
        <!-- Header -->
        <Header />

        <!-- Main Content -->
        <main class="auth-content">
            <slot />
        </main>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup lang="ts">
import { computed } from "vue";
import Header from "../Components/Layouts/Header.vue";
import Footer from "../Components/Layouts/Footer.vue";

</script>

<style scoped>
.auth-layout {
    display: flex;
    flex-direction: column;
    height: 100vh;
}

.auth-content {
    flex: 1;
    display: flex;
    justify-content: center;
    padding: 2rem;
    background-color: #f5f5f5; /* Màu nền nhẹ */
}
</style>
