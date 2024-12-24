<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- Hero -->
        <Hero
            :jobTitle="jobTitle"
            :location="location"
            :searchJobs="searchJobs"
            @update:jobTitle="jobTitle = $event"
            @update:location="location = $event"
        />

        <div class="bg-white">
            <div class="container py-5">
              
                <div v-if="jobs.length > 0" class="w-full">
                    <div
                        class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden"
                    >
                        <div class="overflow-x-auto">
                            <table
                                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                            >
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                >
                                    <tr>
                                        <th scope="col" class="px-4 py-3">
                                            Title
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Description
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Company Logo
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Company Name
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Experience
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Salary
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Location
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Skills
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Extra
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="job in jobs"
                                        :key="job.id"
                                        class="border-b dark:border-gray-700"
                                    >
                                        <th
                                            scope="row"
                                            class="px-4 py-3 font-semibold text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            {{ job.title }}
                                        </th>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            {{
                                                job.description.substring(
                                                    0,
                                                    100
                                                )
                                            }}...
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                           <img :src="'/storage/' + job.company_logo" alt="Company Logo" class="h-12 w-auto mx-auto">
                                        </td>
                                        <td>
                                            <span
                                                class="font-medium text-gray-900"
                                                >{{ job.company_name }}</span
                                            >
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ job.experience }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ job.salary }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ job.location }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div
                                                class="flex items-center flex-wrap gap-2"
                                            >
                                                <span
                                                    v-for="skill in job.skills"
                                                    :key="skill"
                                                    class="inline-block bg-gray-200 rounded-full px-2 py-0.5 text-xs font-medium text-gray-700"
                                                    >{{ skill.name }}</span
                                                >
                                            </div>
                                        </td>
                                       <td class="px-4 py-3">
    <div class="flex items-center flex-wrap gap-2">
        <span
            v-for="extra in job.extra_info"
            :key="extra"
            class="inline-block bg-amber-100 rounded-full px-2 py-0.5 text-xs font-medium text-amber-800"
        >
            {{ extra }}
        </span>
    </div>
</td>

                                       
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <p>No jobs found.</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>







<script setup lang="ts">
import { ref } from "vue";
import Hero from "@/Components/Dashboard/Hero.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const jobTitle = ref("");
const location = ref("");
const jobs = ref([]);

const searchJobs = async () => {
  console.log("Button clicked, fetching jobs..."); // Log to see if the function is called
  try {
    const response = await fetch(
      `/api/jobs/search?title=${jobTitle.value}&location=${location.value}`
    );
    const data = await response.json();
    jobs.value = data.jobs || []; // Update local jobs array
  } catch (error) {
    console.error("Error fetching jobs:", error);
  }
};
</script>
