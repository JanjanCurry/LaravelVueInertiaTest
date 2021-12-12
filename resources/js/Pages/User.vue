<template>
    <Nav />

<div class="flex flex-col ml-80 mr-80">
  <h1 class="text-6xl font-normal leading-normal mt-0 mb-2 text-800">User Lists</h1>
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="user in users" :key="user.id">
              <td v-if="auth_id != user.id" class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div>
                    <div class="text-sm font-medium text-gray-900">
                      {{ user.name }}
                    </div>
                  </div>
                </div>
              </td>
              <td v-if="auth_id != user.id" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <Link :href="user.assign_url">Assign Todo</Link>
              </td>
            </tr>

            <!-- More people... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</template>


<script>
    import Nav from  '../Shared/Nav';
    import { Link } from  '@inertiajs/inertia-vue3';

    export default {
        props:{
        users: Array,
        auth_id: String
        },
        components: { Nav },
        components: { Link },

    };
</script>
    <script setup>

     import { reactive } from "vue";
     import { Inertia } from "@inertiajs/inertia";

    </script>