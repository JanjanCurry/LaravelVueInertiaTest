<template class="align-content: center;">
<Nav />
<div class="max-w-md mx-auto">
  <h1 class="text-2xl font-normal leading-normal mt-0 mb-2 text-800">Assign To Do to for {{user_name}}</h1>
  <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="taskname">
        Task name
      </label>
      <input v-model="form.task_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="task_name" name="task_name" type="text" placeholder="Task Name">
      <input v-model="form.user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="user_id" name="user_id" type="hidden" placeholder="Task Name">
      

    </div>
    <div class="flex items-center justify-between">

    <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"> Submit </button>
    <Link href="/users" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 float-right">Back</Link>
  </div>
  </form>
 


<div class="flex flex-col">
  <div class="-my-2 sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
           <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Task
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Status
                </th>
                <th colspan="3" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Action
                </th>
              </tr>
            </thead>
            
          <tbody class="bg-white divide-y divide-gray-200">
           <tr v-for="task in tasks" :key="task.id">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div>
                    <div class="text-sm font-medium text-gray-900">
                      {{ task.task_name }}
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    {{ task.status }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <Link :href="task.edit_url">Edit</Link>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <Link :href="task.delete_url" method="POST">Delete</Link>
              </td>

              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <Link :href="task.status_url">Update Status</Link>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
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
        name: String,
        user_name: String,
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
            task_name: '',
            user_id: Inertia.page.props.user_id,

        });
        let submit = () => {
          Inertia.post('todo', form);
          form.task_name="";
        };

    </script>