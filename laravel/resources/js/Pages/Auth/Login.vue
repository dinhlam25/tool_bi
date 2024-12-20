<template>
    <AuthLayout>
        <div class="container mx-auto mt-10">
            <div class="flex justify-center mt-10">
                <div class="w-full max-w-lg mt-20">
                    <div class="bg-white shadow-lg rounded-lg">
                        <div class="p-6 bg-black">
                            <div class="text-center text-3xl font-bold text-white my-6">
                                BI Login
                            </div>
                            <div v-if="errors.siireuser_id" class="text-red-500 text-center font-bold">
                                ※ {{ errors.siireuser_id }}
                            </div>
                            <div v-if="errors.siireuser_passwd" class="text-red-500 text-center font-bold">
                                ※ {{ errors.siireuser_passwd }}
                            </div>
                            <div class="my-6">
                                <div class="flex items-center bg-gray-100 rounded-lg overflow-hidden">
                                    <span class="px-3 bg-gray-200 text-gray-700">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input v-model="siireuser_id_besend" id="siireuser_id_besend"
                                        name="siireuser_id_besend" type="text"
                                        class="w-full px-4 py-2 text-gray-700 focus:outline-none focus:ring-0 focus:border-transparent"
                                        placeholder="ログインID" @keypress.enter="submitForm" />
                                </div>
                            </div>
                            <div class="my-6">
                                <div class="flex items-center bg-gray-100 rounded-lg overflow-hidden">
                                    <span class="px-3 bg-gray-200 text-gray-700">
                                        <i class="fas fa-key"></i>
                                    </span>
                                    <input v-model="siireuser_passwd_bemd5" id="siireuser_passwd_bemd5"
                                        name="siireuser_passwd_bemd5" type="password"
                                        class="w-full px-4 py-2 text-gray-700 focus:outline-none focus:ring-0 focus:border-transparent"
                                        placeholder="パスワード" @keypress.enter="submitForm" />
                                </div>
                            </div>
                            <form method="POST" action="/login" class="mt-10" @submit.prevent="submitForm">
                                <input type="hidden" id="siireuser_id" name="siireuser_id" :value="siireuser_id" />
                                <input type="hidden" id="siireuser_passwd" name="siireuser_passwd"
                                    :value="siireuser_passwd" />
                                <div class="flex justify-center">
                                    <button id="login-btn" type="submit"
                                        class="px-6 py-2 bg-gray-200 text-gray-900 font-bold rounded-lg shadow hover:bg-gray-300 focus:outline-none">
                                        ログイン
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-8">
                <div class="bg-white p-4 rounded-lg text-center shadow-md w-72">
                    <a :href="portalUrl" target="_blank" class="text-gray-800 text-sm hover:underline">
                        <img :src="portalLogoSrc" alt="WBC logo" class="mx-auto mb-2" width="200" height="17" />
                        <div>
                            ポータルサイトは
                            <span class="ml-1 bg-blue-600 text-white rounded px-2">
                                こちら
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>

<script setup lang="ts">
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { computed, ref, watch } from 'vue';
import { Md5 } from 'ts-md5'

const errors = ref({
    siireuser_id: '',
    siireuser_passwd: '',
});

const siireuser_id_besend = ref('');
const siireuser_passwd_bemd5 = ref('');
const siireuser_id = ref('');
const siireuser_passwd = ref('');

watch(siireuser_id_besend, (newValue) => {
    siireuser_id.value = newValue;
});

watch(siireuser_passwd_bemd5, (newValue) => {
    siireuser_passwd.value = Md5.hashStr(newValue);
});

const submitForm = () => {
    const form = document.querySelector('form');
    if (form) {
        form.submit();
    }
};

const portalBaseUrl = 'https://wbc.webike.net/portal';
const portalLogoSrc = `${portalBaseUrl}/wp-content/uploads/2022/03/WBC_logo.png`;
const portalUrl = computed(() => {
    const params = new URLSearchParams({
        'password_protected_pwd': 'we819wbc',
        'redirect_to': `${portalBaseUrl}/?pdm=1`,
    });
    return `${portalBaseUrl}/?${params.toString()}`;
});
</script>