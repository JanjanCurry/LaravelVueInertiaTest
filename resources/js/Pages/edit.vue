<template class="align-content: center;">
    <Nav />

<div class="max-w-md mx-auto">
  <h1 class="text-6xl font-normal leading-normal mt-0 mb-2 text-800">Edit User Task</h1>
  <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="taskname">
        Task Name
      </label>
      <input v-model="form.task_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="task_name" name="task_name" type="text" placeholder="Task Name">
      <input v-model="form.id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="id" name="id" type="hidden" placeholder="Task Name">
      
    </div>
    <div class="flex items-center justify-between">
  <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"> Submit </button>
  <Link v-if="is_assign === 'false'" :href="back_url" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">Back</Link>
  <Link v-if="is_assign === 'true'" :href="back_url" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">Back</Link>
  
    </div>
  </form>
 
</div>

</template>

<script>
    import Nav from  '../Shared/Nav';
    import { Link } from  '@inertiajs/inertia-vue3';

    export default {
        props:{
          name: String,
          is_assign: String,
          back_url: String,
          tasks: Array
        },
        components: { Nav },
        components: { Link },
    
    };

</script>
    export default {
        components: { Nav },
    };

    <script setup>
     import { reactive } from "vue";
     import { Inertia } from "@inertiajs/inertia";

        let form = reactive({
            task_name: Inertia.page.props.current_task.task_name,
            id: Inertia.page.props.current_task.id
        });
        let submit = () => {
          Inertia.post('update_todo', form);
          form.task_name="";
        };

    </script>