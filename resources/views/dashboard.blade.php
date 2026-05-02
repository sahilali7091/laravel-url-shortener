<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>

           <div>
                 @if(auth()->user()->role === 'superadmin') 
                <a href="{{ route('add-new-company') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                    + Add Company
                </a>
                &nbsp;
                @endif
               
                @if(auth()->user()->role === 'Admin' || auth()->user()->role === 'superadmin')
                <a href="{{ route('add-new-person') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                    + Add @if(auth()->user()->role === 'superadmin') Admin @else Person @endif
                </a>
                 &nbsp;
                @endif

                 @if(auth()->user()->role === 'Admin' || auth()->user()->role === 'Member')
                <a href="{{ route('generate-url') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                    + Generate URL
                </a>
                @endif
            
           </div>
           
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
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">

            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                    Short URLs List
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full w-full divide-y divide-gray-200 dark:divide-gray-700">

                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                                #
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                                Company
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                                Long URL
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                                Short Url
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                                Created At
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                        @forelse($short_url as $key => $url)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">

                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">
                                    {{ $key + 1 }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">
                                    {{ $companies->firstWhere('id', $url->company_id)?->company_name ?? 'N/A' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-blue-600 break-all">
                                    <a href="{{ url($url->long_url) }}" target="_blank" class="hover:underline">
                                        <!-- {{ url($url->short_url) }} -->
                                        {{ \Illuminate\Support\Str::limit($url->long_url, 100, '...') }}
                                    </a>
                                    
                                </td>

                                <td class="px-6 py-4 text-sm font-semibold text-green-600">
                                    <a href="{{ url('s/' . $url->short_url) }}" target="_blank" class="hover:underline">
                                        {{ url('s/' . $url->short_url) }}
                                    </a>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">
                                    {{ $url->created_at->format('d M Y') }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No Short URLs Found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

    </div>
</div>
</x-app-layout>