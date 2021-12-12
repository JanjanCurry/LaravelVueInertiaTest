<template>
   <!-- This example requires Tailwind CSS v2.0+ -->
<div class="relative bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
      <div class="flex justify-start lg:w-0 lg:flex-1">
      </div>
      <div class="-mr-2 -my-2 md:hidden">
        
      </div>
      <nav class="hidden md:flex space-x-10">
        
        <Link href='/users' class="tex-blue-500 hover:underline" :class="{'font-bold underline': $page.component=='User'}">User</Link>
        <Link href='/todo_list' class="tex-blue-500 hover:underline" :class="{'font-bold underline': $page.component=='Todo'}">Todo </Link>

      </nav>
      <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
        <Link href="/logout" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900" method="POST">Logout</Link>
      </div>
    </div>
  </div>

</div>

</template>

<script>

    import { Link } from  '@inertiajs/inertia-vue3';

    export default {
        components: { Link },
    };
</script>