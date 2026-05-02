<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>

        </div>
    </x-slot>
   @if(session('status'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif 
    
    @if(session('error'))
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any()) 
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            {{ $errors->first('email') }}
        </div>
    @endif
    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
@endif
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-6 text-gray-800 dark:text-white">
                Add New Person
            </h2>

            <form method="POST" action="{{ route('persons.store') }}">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                        Name
                    </label>
                    <input type="text" name="name"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter Person Name" required>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                        Email
                    </label>
                    <input type="email" name="email"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter Person Email" required>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                        Company Name
                    </label>
                    <select name="company_id" id="" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Select Company</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                @if(auth()->user()->role === 'Admin')
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                        Role
                    </label>
                    <select name="role" id="" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Select Role</option>
                        <option value="Admin">Admin</option>
                        <option value="Member">Member</option>
                    </select>
                </div>
                @endif

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                    Add Person
                </button>
            </form>
        </div>

    </div>
</div>
</x-app-layout>