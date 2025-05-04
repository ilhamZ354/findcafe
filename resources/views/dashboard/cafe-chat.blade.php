<x-layout>
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg mt-6 p-4">
        <a href="/dashboard/cafe-detail"
            class="inline-flex items-center mb-4 text-brown-700 hover:text-brown-900 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <h1 class="text-3xl font-bold text-brown-800">Chat - [NamaCafe]</h1>
        </a>

        <div class="h-80 overflow-y-auto bg-gray-50 rounded-md p-4 mb-4">
            <!-- Example messages -->
            <div class="mb-2">
                <span class="inline-block bg-primary text-white px-4 py-2 rounded-lg w-fit">Hi, welcome to [NamaCafe]!</span>
            </div>
            <div class="text-right mb-2">
                <span class="inline-block bg-gray-200 text-gray-800 px-4 py-2 rounded-lg">Hi! Do you have a vegan
                    menu?</span>
            </div>
        </div>

        <form action="" method="POST" class="flex items-center">
            @csrf
            <input type="text" name="message" placeholder="Type your message..."
                class="flex-1 border rounded-l-lg px-3 py-2 focus:outline-none">
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-r-lg">Send</button>
        </form>
    </div>
</x-layout>
