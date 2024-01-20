<!-- EmailForm.vue -->

<template>
   <section class="w-full max-w-md mx-auto p-6">
       <div class="mt-7 bg-white  rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700 border border-indigo-300">
         <div class="p-4 sm:p-7">
             <h1 class="block text-center text-2xl font-bold text-gray-800 dark:text-white">Login to your account</h1>
             <form class="grid gap-y-4 mt-5" @submit.prevent="submitForm">
                 <div>
                   <label for="email" class="block text-sm font-bold ml-1 mb-2 dark:text-white">Email address</label>
                   <div class="relative">
                     <input type="email" id="email" v-model="email" name="email" class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" required aria-describedby="email-error">
                   </div>
                   <p class="text-xs text-gray-600 mt-2">Please include a valid email address so we can send you a magic login link</p>
                 </div>
                 <button type="submit" class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-indigo-500 text-white hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">Login</button>
             </form>
         </div>
       </div>
      </section>
</template>

<script>
export default {
   data() {
      return {
         email: '',
      };
   },
   methods: {
      submitForm() {
         // You can perform any action here, such as sending the email to a server
         console.log('Email submitted:', this.email);

         // For demonstration purposes, you can reset the form after submission
         this.email = '';

         // Assuming you want to navigate to a different route after submission
         this.$router.push('/login/success'); // Change '/success' to the desired route
      },
   },
};
</script>

