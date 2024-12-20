<template>
    <nav class="bg-black shadow-sm z-200">
        <div class="flex justify-between items-center px-4 py-2">
            <div>
                <a :href="routes.dashboard">
                    <img :src="assets.logo" class="h-10" alt="Logo" />
                </a>
                <div class="text-white text-xs">PDM (Product Data Management)</div>
            </div>
            <button class="text-white focus:outline-none md:hidden" type="button" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation" @click="toggleNavbar">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <div :class="[
            'md:flex md:items-center md:justify-between',
            isNavbarOpen ? 'block' : 'hidden',
        ]" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="flex flex-col md:flex-row md:space-x-4"></ul>

            <!-- Right Side Of Navbar -->
            <ul class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:ml-auto">
                <!-- Authentication Links -->
                <li v-if="!isAuthenticated" class="nav-item"></li>
                <li v-else class="mr-3">
                    <a class="flex items-center p-1 bg-white rounded-md" target="_blank" :href="portalUrl">
                        <img class="m-auto" :src="portalIcon" alt="WBC logo" width="32" height="32" />
                        <div class="ml-1">
                            ポータルサイトは
                            <span class="ml-1 bg-primary text-white rounded px-2">こちら</span>
                        </div>
                    </a>
                </li>
                <li v-if="isAuthenticated" class="relative">
                    <a id="navbarDropdown"
                        class="flex items-center justify-between bg-gray-100 px-3 py-2 rounded-md text-sm font-semibold cursor-pointer w-36"
                        @click="toggleDropdown">
                        <i class="fas fa-user mr-2"></i> {{ displayName }} 様
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-auto" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <div v-if="isDropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
                        <a class="block px-4 py-2 text-sm font-semibold hover:bg-gray-100" :href="routes.dashboard">
                            <i class="fas fa-chart-bar"></i> ダッシュボード
                        </a>
                        <a class="block px-4 py-2 text-sm font-semibold hover:bg-gray-100"
                            :href="routes.registrationList">
                            <i class="fas fa-file-signature"></i> 新規商品登録
                        </a>
                        <a class="block px-4 py-2 text-sm font-semibold hover:bg-gray-100" :href="routes.editionList">
                            <i class="fas fa-screwdriver-wrench"></i> 商品データ修正・更新
                        </a>
                        <a class="block px-4 py-2 text-sm font-semibold hover:bg-gray-100" :href="routes.home">
                            <i class="fas fa-up-down"></i> 廃番・復活
                        </a>
                        <!-- ...existing menu items... -->
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>


<script setup>
import { ref, computed } from 'vue';

// State
const isAuthenticated = ref(false);
const displayName = ref('ユーザー名');

// Routes
const routes = {
    dashboard: '/dashboard',
    registrationList: '/registration/list',
    editionList: '/edition/list',
    home: '/home',
};

const assets = {
    logo: '/wbc/images/webike_logo_white.png',
};

// Portal Configuration
const portalBaseUrl = 'https://wbc.webike.net/portal';
const portalIcon = `${portalBaseUrl}/wp-content/uploads/2022/03/cropped-wbc_site_icon.png`;

// Computed Properties
const portalUrl = computed(() => {
    const params = new URLSearchParams({
        'password-protected': 'login',
        'redirect_to': `${portalBaseUrl}/?pdm=1`,
    });
    return `${portalBaseUrl}/?${params.toString()}`;
});

const isNavbarOpen = ref(false);
const isDropdownOpen = ref(false);

// Methods
const toggleNavbar = () => {
    isNavbarOpen.value = !isNavbarOpen.value;
};

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};
</script>


<style scoped>
/* Add your styles here */
</style>