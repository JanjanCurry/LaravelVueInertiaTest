<template>
<form @submit.prevent="submit" class="max-w-md mx-auto mt-8">
    <h1 class="text-3xl mx-auto">Login</h1>
<div class="mb-6">
  <label class="blocl mb-2 uppercase font-bold text-xs text-gray-700" for="email">Email:</label><br>
  <input v-model="form.email" class="border border-gray-400 p-2 w-full rounded" type="text" id="email" name="email">
  <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></div>
  <br>
  <label class="blocl mb-2 uppercase font-bold text-xs text-gray-700" for="password">Password:</label><br>
  <input v-model="form.password" class="border border-gray-400 p-2 w-full rounded" type="password" id="password" name="password"><br>
  <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1"></div>

  <br>
  <div class="flow-root">
    <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 float-left"> Submit </button>
    <Link href="register" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 float-right">Register</Link>
  </div>
</div>
</form> 

</template>
<script>
  import { Link } from  '@inertiajs/inertia-vue3';

      export default {
          components: { Link },
  };
</script>
<script setup>
import { useForm } from "@inertiajs/inertia-vue3";

let form = useForm({
    email: '',
    password: ''
});

let submit = () => {
  form.post('/login');  
};
</script>