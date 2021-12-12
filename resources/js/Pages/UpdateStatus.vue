<template class="align-content: center;">
    <Nav />

<div class="max-w-md mx-auto">
  <h1 class="text-4xl font-normal leading-normal mt-0 mb-2 text-800">Update Task Status</h1>
  <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="taskname">
        Status 
      </label>
      <input v-model="form.id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="id" name="id" type="hidden" placeholder="Task Name">
    <select v-model="form.status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status" >
    <option value="Starting" v-if="current_task.status === 'Starting'">Starting</option>
    <option value="Pending" v-if="current_task.status === 'Starting'">Pending</option>
    <option value="Done" v-if="current_task.status === 'Starting'">Done</option>
    <option value="Pending" v-if="current_task.status === 'Pending'" >Pending</option>
    <option value="Done" v-if="current_task.status === 'Pending'">Done</option>
    <option value="Done" v-if="current_task.status === 'Done'">Done</option>

  </select>      
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
          current_task: Array
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
            status: Inertia.page.props.current_task.status,
            id: Inertia.page.props.current_task.id
        });
        let submit = () => {
          Inertia.post('update_status', form);
          form.task_name="";
        };

    </script>